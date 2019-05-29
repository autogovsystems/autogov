<li>	
    <div>
    	<div class ="market-image">
			<a href="<?php echo the_permalink();?>">
				<?php echo get_the_post_thumbnail($wc_query->post->ID, array(200,200)); ?>
			</a>
		</div>
		<div class="market-title">
			<a href="<?php echo the_permalink();?>">
				<?php echo the_title();?>
			</a>
		</div>
	</div>
</li>
