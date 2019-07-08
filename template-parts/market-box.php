<li>
    <div>
    	<div class ="market-image">
			<a href="<?php echo the_permalink();?>">
        <?php $thumb = get_the_post_thumbnail($post->ID, array(200,200));
          if($thumb){
            echo $thumb;
          }else{
            echo '<img src="'.get_stylesheet_directory_uri().'/img/default_image_product.png" />';
          }
        ?>
			</a>
		</div>
		<div class="market-title">
      <?php $gname = get_the_title(); ?>
			<a href="<?php echo the_permalink();?>">
				<?php echo (strlen($gname) > 50)? substr($gname,0,50)."..." : $gname; ?>
			</a>
		</div>
	</div>
</li>
