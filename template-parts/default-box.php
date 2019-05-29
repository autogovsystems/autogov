<?php $orders = get_query_var('orders'); ?>
<li <?php if($orders){foreach ($orders as $key => $value) echo 'data-'.$key.'= "'.$value.'" ';} ?>>
    <div>
    	<div class ="image">
			<a href="<?php echo the_permalink();?>">
				<?php $thumb = get_the_post_thumbnail();
          if($thumb){
            echo $thumb;
          }else{
            echo '<img src="'.get_stylesheet_directory_uri().'/img/default_image.png" />';
          }
        ?>
			</a>
		</div>
		<div class="title">
			<a href="<?php echo the_permalink();?>">
				<?php echo the_title();?>
			</a>
		</div>
	</div>
</li>
