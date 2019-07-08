<?php $orders = get_query_var('orders'); ?>
<li <?php foreach ($orders as $key => $value) echo 'data-'.$key.'= "'.$value.'" '; ?>>
  <?php $current_vontest = new Vontest(get_the_ID()); ?>
    <div class="<?php echo $current_vontest->is_active()?'':'closed_vontest' ?>">
      <div class="closed-text"><i class="fas fa-times-circle"></i><?php _e('Closed','autogov'); ?></div>
    	<div class ="image">
			<a href="<?php echo the_permalink();?>">
				<?php $thumb = get_the_post_thumbnail();
          if($thumb){
            echo $thumb;
          }else{
            echo '<img src="'.get_stylesheet_directory_uri().'/img/default_image_question.png" />';
          }
        ?>
			</a>
		</div>
		<div class="title">
      <?php $gname = get_the_title(); ?>
			<a href="<?php echo the_permalink();?>">
				<?php echo (strlen($gname) > 50)? substr($gname,0,50)."..." : $gname; ?>
			</a>
		</div>
	</div>
</li>
