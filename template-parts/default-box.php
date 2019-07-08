<?php $orders = get_query_var('orders'); ?>
<li <?php if($orders){foreach ($orders as $key => $value) echo 'data-'.$key.'= "'.$value.'" ';} ?>>
    <div>
    	<div class ="image">
			<a href="<?php echo the_permalink();?>">
				<?php $thumb = get_the_post_thumbnail();
          if($thumb){
            echo $thumb;
          }else{
            echo '<img src="'.get_stylesheet_directory_uri().'/img/default_image_'.get_post_type().'.png" />';
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
