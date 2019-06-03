<?php $orders = get_query_var('orders'); ?>
<li <?php foreach ($orders as $key => $value) echo 'data-'.$key.'= "'.$value.'" '; ?>>
    <div>
    	<div class ="image">
			<a href="<?php bp_group_permalink() ?>">
        <?php $image = bp_get_group_avatar('type=full&width=150&height=150');
        if($image){
          echo $image;
        }else{
          echo '<img src="'.get_stylesheet_directory_uri().'/img/default_image_groups.png" />';
        } ?>
      </a>
		</div>
		<div class="title">
			<a href="<?php bp_group_permalink() ?>"><?php bp_group_name(); ?></a>
		</div>
	</div>
</li>
