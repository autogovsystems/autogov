<?php
/* Clase Vontest para obtener relacionados desde objeto */
class Vontest {

  public $id;
  public $answers;
  public $meta;
  public $answer_ids;
  public $vontest;

  function __construct($id){
    $this->id = $id;
    $this->vontest = get_post($id);
    $this->get_metas();
    $this->get_answers();
    $this->get_answer_ids();
  }

  function is_active(){
    $date_end = $this->meta['_date_votography'][0];
    return (time() < strtotime($date_end))?true:false;
  }

  function get_answers(){
    $args = array(
    	'post_type' => 'answer',
      'posts_per_page' => -1,
      'meta_query' => array(
    		array(
    			'key'     => '_question_parent',
    			'value'   => $this->id,
    			'compare' => '=',
    		),
    	),
    );
    $this->answers = new WP_Query( $args );
  }

  function get_answer_ids(){
    $args = array(
      'post_type' => 'answer',
      'posts_per_page' => -1,
      'meta_query' => array(
        array(
          'key'     => '_question_parent',
          'value'   => $this->id,
          'compare' => '=',
          'fields' => 'ids'
        ),
      ),
    );

    $result_query = new WP_Query( $args );
    $this->answer_ids = wp_list_pluck( $result_query->posts, 'ID' );
  }

  function get_metas(){
    $this->meta = get_post_meta($this->id);
  }

  function get_resolutions($draft = false){
    $args = array(
      'post_type' => 'resolution',
      'posts_per_page' => -1,
      'meta_query' => array(
        'relation' => 'AND',
        array(
          'key'     => '_question_parent',
          'value'   => $this->id,
          'compare' => '=',
          'type'    => 'NUMERIC'
        )
      ),
    );
    if($draft){
      $args['post_status'] = array( 'pending', 'draft', 'future', 'publish' );
    }
    $this->resolutions = new WP_Query( $args );
  }
  function check_current_votography(){
    $votographies = $this->meta['_votographies'][0];
    if($votographies){
      foreach(unserialize($votographies) as $v){
        if($this->meta['_date_votography'][0] == $v['_date_votography']){
          return true;
        }
      }
    }
    return false;
  }

  function check_current_resolution(){
    $args = array(
      'post_type' => 'resolution',
      'posts_per_page' => 1,
      'meta_query' => array(
        'relation' => 'AND',
        array(
          'key'     => '_question_parent',
          'value'   => $this->id,
          'compare' => '=',
          'type'    => 'NUMERIC'
        ),
        array(
          'key'     => '_date_votography',
          'value'   => $this->meta['_date_votography'][0],
          'compare' => '='
        )
      ),
    );
    $result_query = new WP_Query( $args );
    if($result_query->have_posts()){
      return true;
    }
    return false;
  }

  function create_resolution(){
    if(!$this->check_current_votography() && !$this->is_active()){
      $answer_most_voted = [];
      $answer_votes = [];
      $emails = '';
      $votes_for_most = 0;
      if($this->answers->posts){
        foreach($this->answers->posts as $ans){
          $this_votes = get_total_answer_points($ans->ID);
          $emails .= get_users_voted_on_answer($ans->ID);
          $answer_votes[$ans->ID] = $this_votes;
          if( $this_votes > $votes_for_most ){
            $votes_for_most = $this_votes;
            $answer_most_voted = array($ans->ID);
            $resolution_case = get_post_meta($ans->ID,'_resolution_case',true);
          }elseif($this_votes == $votes_for_most && $this_votes > 0){
            if(!empty($answer_most_voted)){
              $answer_most_voted[] = $ans->ID;
            }
          }
        }
      }
      do_action('creating_votography',$ans->ID);

      $result = count_users();
      $metas = array(
          '_question_parent' => $this->id,
          '_date_votography' => $this->meta['_date_votography'][0],
          '_users_voted' => count(explode(',',$emails)),
          '_quorum_votography' => (count(explode(',',$emails))-1)/$result['total_users'],
          '_answers_on_votography' => $this->answers->posts,
          '_answers_voted' => $answer_votes
      );
      $new_good_resolution = TRUE;

      $votographies = get_post_meta($this->id,'_votographies',TRUE);
      if(is_array($votographies)){
        $votographies[] = $metas;
      }else{
        $votographies = array($metas);
      }

      update_post_meta($this->id,'_votographies',$votographies);
      if(sizeof($answer_most_voted)!==1){
          $email_admin = get_option('admin_email');
          $email_author = get_the_author_meta('user_email',$this->vontest->post_author);
          $to = array($email_admin,$email_author);
          $subject = __('Se produjo un error al crear la resolución del vontest ', 'autogov').$this->id;
          $message = '<p>'.__('El error puede deberse a que no hay votos aplicados a las answers de ese vontest o que hay dos propuestas que tienen los mismos votos', 'autogov').'</p>';
          $message .= '<p><a href="'.get_edit_post_link($this->id).'">'.__('Ver vontest en conflicto','autogov').'</a></p>';
          $email = WP_Mail::init()
            ->to($to)
            ->subject(__('Se produjo un error al crear la resolución del vontest ', 'autogov').$this->id)
            ->template(get_template_directory() .'/emails/resolution_error.php', [
                'vontest_permalink' => get_edit_post_link($this->id),
                'vontest_id' => $this->id
            ])
            ->send();
          $resolution_case = __('No se ha podido realizar la resolución porque no han habido votos o varias opciones han quedado igualadas', 'autogov');
          $new_good_resolution = FALSE;
      }
      $post = array(
          'post_title'    => 'Res. '.$this->id.'-'.$this->meta['_date_votography'][0],
          'post_content'  => $resolution_case,
          'post_status'   => 'draft',
          'post_type'     => 'resolution',
          'meta_input'    => $metas,
      );
      $new_post_id = wp_insert_post($post);

        if(sizeof(explode(',',$emails))>0 && $new_good_resolution){
          $email = WP_Mail::init()
            ->to('noreply@autogov.systems')
            ->bcc($emails)
            ->subject('New votography for a closed vontest')
            ->template(get_template_directory() .'/emails/resolution_created.php', [
                'resolution_permalink' => get_permalink($this->id),
                'resolution_name' => 'Res. '.$this->id.'-'.$this->meta['_date_votography'][0]
            ])
            ->send();
        }

    }
  }

}
