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
			<a href="<?php echo the_permalink();?>">
				<?php echo the_title();?>
			</a>
		</div>
	</div>
</li>
