<?php get_header(); ?>
<?php if(is_user_logged_in()){

  $editing=0;
  if(isset($_GET['id']) && $_GET['id']!=''){
    if(get_post_field( 'post_author', $_GET['id'] ) == get_current_user_id() && get_post_type($_GET['id'])=='question')
      $editing=1;
    else{
      $wp_query->set_404();
      require get_template_directory().'/404.php';
      exit;
    }
  }
  ?>
	<main role="main" class="create-vontest">
	<!-- section -->
	<section>
		<!-- article -->
		<article id="pastilla-politics" <?php post_class('container-fluid cardtab'); ?>>
      <div class="row">
        <div class="col-12 cardtitle">
          <h3><?php _e('NEW VONTEST','autogov'); ?></h3>
          <span><?php _e('Create news questions','autogov'); ?></span>
        </div>
      </div>
			<div class="row tab">
					<button class="tablinks col-6 active" data-id="general"><?php _e('General','autogov'); ?></button>
					<button class="tablinks col-6" data-id="description"><?php _e('Description','autogov'); ?></button>
			</div>
			<form id="form-create-vontest">
      <div id="tab-general" class="tabcontent active">
          <div class="md-form">

            <input type="text" id="vontest_title" class="form-control" value="<?php if($editing) echo get_the_title($_GET['id']);?>" required>
            <label for="vontest_title"><?php _e('Vontest title','autogov'); ?></label>
            <i class="fa fa-question-circle tips" title="<?php _e( "Add your Vontest title", 'autogov' );?>" data-placement="left" aria-hidden="true"></i>
          </div>
          <div class="md-form">
            <textarea type="text" id="vontest_excerpt" class="md-textarea form-control" rows="3" maxlength="400" required><?php if($editing) echo get_the_excerpt($_GET['id']);?></textarea>
            <label for="vontest_excerpt"><?php _e('Short description','autogov'); ?></label>
            <i class="fa fa-question-circle tips textarea-tips" title="<?php _e( "Add your vontest short description", 'autogov' );?>" data-placement="left" aria-hidden="true"></i>
            <span><?php _e('400 char. max','autogov'); ?></span>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <div class="md-form mt-0">
                <div for="vontest_featuredimage"><?php _e('Featured image','autogov'); ?>
                <i class="fa fa-question-circle tips inline" title="<?php _e( "Image for the vontest", 'autogov' );?>" data-placement="right" aria-hidden="true"></i>
                </div>
                <div><?php if($editing) echo get_the_post_thumbnail($_GET['id'],'thumbnail');?></div>
                <input type="file" id="vontest_featuredimage" class="form-control">
                <div style="font-size: 0.75em; font-style: italic;">
                  <a href="https://ccsearch.creativecommons.org" target="_blank"><?php
                  _e('If you don\'t have image. Choose your image from CC and upload','autogov');
                  ?></a>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <div class="md-form">
                <input type="text" id="vontest_closingdate_view" class="form-control datepicker" value="<?php if($editing){
                  echo date_i18n( get_option( 'date_format' ), strtotime(get_post_meta($_GET['id'],'_date_votography',true)));
                }else{
                  echo date_i18n( get_option( 'date_format' ), strtotime(date("Y-m-d", strtotime("+1 month",time()))));
                };?>" required>
                  <label for="vontest_closingdate_view"><?php _e('Votography date','autogov'); ?></label>
                  <i class="fa fa-question-circle tips" title="<?php _e( "Your vontest closingdate date", 'autogov' );?>" data-placement="left" aria-hidden="true"></i>
                <input type="hidden" id="vontest_closingdate" value="<?php if ($editing){ echo get_post_meta($_GET['id'],'_date_votography',true); }else{ echo date("Y-m-d", strtotime("+1 month",time())); } ?>" />
                <script>
                  jQuery(document).ready(function(){

                    jQuery('input#vontest_closingdate_view').datepicker({
                    altField: "#vontest_closingdate",
                    altFormat: "yy-mm-dd",
                    minDate: "+1d",
                    defaultDate: "+1m" });

                  });
                </script>
              </div>
            </div>
          </div>
					<div class="form-row">
            <div class="form-group col-md-6">
              <div class="md-form mt-0">
                <h4>Topics <i class="fa fa-question-circle tips inline" title="<?php _e( "Add Topics at your vontest", 'autogov' );?>" data-placement="left" aria-hidden="true"></i></h4>
								<div>
									<?php $terms = get_terms( array(
									    'taxonomy' => 'topics',
									    'hide_empty' => false,
									) );
									if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){ ?>
									    <select data-placeholder="<?php _e('Seleccione topics','autogov'); ?>" id="vontest_topics" multiple="multiple">
									    <?php foreach ( $terms as $term ) { ?>
												<option value="<?php echo $term->slug ?>" <?php if( $editing && has_term( $term->name, 'topics', $_GET['id'] ) ) echo 'selected="selected"'; ?> ><?php echo $term->name ?></option>
									    <?php } ?>
									    </select>
											<script type="text/javascript">
											    jQuery(document).ready(function() {
											        $("#vontest_topics").chosen({width: "100%"})
											    });
											</script>
									<?php }else{ ?>
										<?php _e('Aun no hay topics creados.'); ?>
									<?php } ?>
								</div>
              </div>
            </div>
						<div class="form-group col-md-6">
              <div class="md-form mt-0">
                <h4>TAGS</h4>
								<div>
									<?php $terms = get_terms( array(
									    'taxonomy' => 'vontest_tag',
									    'hide_empty' => false,
									) );
									if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){ ?>
									    <select data-placeholder="<?php _e('Seleccione tags','autogov'); ?>" id="vontest_tags" multiple="multiple">
									    <?php foreach ( $terms as $term ) { ?>
												<option value="<?php echo $term->slug ?>" <?php if( $editing && has_term( $term->name, 'vontest_tag', $_GET['id'] ) ) echo 'selected="selected"'; ?> ><?php echo $term->name ?></option>
									    <?php } ?>
									    </select>
											<script type="text/javascript">
											    jQuery(document).ready(function() {
											        $("#vontest_tags").chosen({width: "100%"})
											    });
											</script>
									<?php }else{ ?>
										<input type="text" disabled="disabled" class="form-control" placehoder="" value="<?php _e('No tags yet'); ?>">
									<?php } ?>
                  <div>
                    <a style="font-size: 0.75em; font-style: italic;" href="#" onclick="$('#vontest_newtags').toggle();return false;"><?php _e('Don\'t see your perfect tag? Click here'  ); ?></a>
                    <input type="text" id="vontest_newtags" class="form-control hide" value="" placeholder="Write your tags sepparated with commas" >
                  </div>
								</div>
              </div>
            </div>
            <div class="form-group col-md-4 d-none">
              <div class="md-form">
                <h4><?php _e('RELATED RESOLUTIONS','autogov'); ?></h4>
								<div>
									<?php /*$query_related = new WP_Query( array(
									    'post_type' => 'resolution',
											'posts_per_page' => -1,
									) );
									    if($editing)
                        $currently_related_resolutions=get_post_meta( $_GET['id'], '_related_resolutions', true );
                      if ( $query_related->have_posts() ) {
                      ?>
												<select data-placeholder="<?php _e('Seleccione decisiones de otros vontest','autogov'); ?>" id="vontest_related" multiple="multiple">
  											  <?php	while ( $query_related->have_posts() ) {
  													$query_related->the_post();
                          ?>
													<option value="<?php echo get_the_ID(); ?>" <?php if( $editing && in_array(get_the_ID(),$currently_related_resolutions) ) echo 'selected="selected"'; ?>><?php the_title(); ?></option>
													<?php
												  } ?>
											  </select>
											<script type="text/javascript">
													jQuery(document).ready(function() {
															$("#vontest_related").chosen({width: "100%"})
													});
											</script>
												<?php
												wp_reset_postdata();
											} else {
												_e('Aun no hay decisiones para relacionar.');
											}*/
										?>
								</div>
              </div>
            </div>
          </div>
			</div>

			<div id="tab-description" class="tabcontent">
        <div id="accordionVontestDescription">
          <div class="row">
            <div class="col-12" id="headingWhat">
                <a class="collapsed" data-toggle="collapse" href="#collapseWhat" aria-expanded="true" aria-controls="collapseWhat">
                  <?php _e('What','autogov'); ?>
									<i class="fas fa-plus"></i>
                </a>
            </div>
            <div id="collapseWhat" class="collapse col-12" aria-labelledby="collapseWhat" data-parent="#accordionVontestDescription">
              <div class="card-body">
                <?php if($editing) wp_editor(get_post_meta($_GET['id'],'_editor_what',true),'_editor_what'); else wp_editor('','_editor_what'); ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12" id="headingHow">
                <a class="collapsed" data-toggle="collapse" href="#collapseHow" aria-expanded="false" aria-controls="collapseHow">
                  <?php _e('How','autogov'); ?>
									<i class="fas fa-plus"></i>
                </a>
            </div>
            <div id="collapseHow" class="collapse col-12" aria-labelledby="collapseHow" data-parent="#accordionVontestDescription">
              <div class="card-body">
                <?php if($editing) wp_editor(get_post_meta($_GET['id'],'_editor_how',true),'_editor_how'); else wp_editor('','_editor_how'); ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12" id="headingWhen">
                <a class="collapsed" data-toggle="collapse" href="#collapseWhen" aria-expanded="false" aria-controls="collapseWhen">
                  <?php _e('When','autogov'); ?>
									<i class="fas fa-plus"></i>
                </a>
            </div>
            <div id="collapseWhen" class="collapse col-12" aria-labelledby="collapseWhen" data-parent="#accordionVontestDescription">
              <div class="card-body">
                <?php if($editing) wp_editor(get_post_meta($_GET['id'],'_editor_when',true),'_editor_when'); else wp_editor('','_editor_when'); ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12" id="headingWhere">
                <a class="collapsed" data-toggle="collapse" href="#collapseWhere" aria-expanded="false" aria-controls="headingWhere">
                  <?php _e('Where','autogov'); ?>
									<i class="fas fa-plus"></i>
                </a>
            </div>
            <div id="collapseWhere" class="collapse col-12" aria-labelledby="collapseWhere" data-parent="#accordionVontestDescription">
              <div class="card-body">
                <?php if($editing) wp_editor(get_post_meta($_GET['id'],'_editor_where',true),'_editor_where'); else wp_editor('','_editor_where');?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12" id="headingWhy">
                <a class="collapsed" data-toggle="collapse" href="#collapseWhy" aria-expanded="false" aria-controls="headingWhy">
                  <?php _e('Why','autogov'); ?>
									<i class="fas fa-plus"></i>
                </a>
            </div>
            <div id="collapseWhy" class="collapse col-12" aria-labelledby="collapseWhy" data-parent="#accordionVontestDescription">
              <div class="card-body">
                <?php if($editing) wp_editor(get_post_meta($_GET['id'],'_editor_why',true),'_editor_why'); else wp_editor('','_editor_why'); ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12" id="headingHowmuch">
                <a class="collapsed" data-toggle="collapse" href="#collapseHowmuch" aria-expanded="false" aria-controls="headingHowmuch">
                  <?php _e('How much','autogov'); ?>
									<i class="fas fa-plus"></i>
                </a>
            </div>
            <div id="collapseHowmuch" class="collapse col-12" aria-labelledby="collapseHowmuch" data-parent="#accordionVontestDescription">
              <div class="card-body">
               <?php if($editing) wp_editor(get_post_meta($_GET['id'],'_editor_howmuch',true),'_editor_howmuch'); else wp_editor('','_editor_howmuch');  ?>
              </div>
            </div>
          </div>
        </div>
			</div>
      <div class="row buttons_create_vontest">
        <div class="col text-center">
          <?php if ($editing){ ?>
            <input type="hidden" id="vontest_id" value="<?php echo $_GET['id']; ?>">
            <button id="saveVontest" type="submit" class="button"><?php _e('SAVE CHANGES','autogov'); ?>
          <?php } else { ?>
            <button id="createVontest" type="submit" class="button"><?php _e('PUBLISH NEW VONTEST','autogov'); ?>
          <?php } ?>
        </div>
      </div>
    </form>
		</article>
		<!-- /article -->
	</section>
	<!-- /section -->
	</main>

<?php }else{ ?>
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<p><?php _e('Debe estar identificado para poder crear vontest','autogov'); ?></p>
			</div>
		</div>
	</div>
<?php } ?>
<?php get_footer(); ?>
