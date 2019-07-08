<?php $orders = get_query_var('orders'); ?>
<li <?php foreach ($orders as $key => $value) echo 'data-'.$key.'= "'.$value.'" '; ?>>
    <div>
    	<div class ="image">
			<a href="<?php the_permalink() ?>">
        <?php
        $group_id = get_post_meta(get_the_id(),'_bbp_group_ids',true);
        $avatar = bp_core_fetch_avatar( array(
            'item_id' => $group_id[0],
            'avatar_dir' => 'group-avatars',
            'object' => 'group',
            'type' => 'full',
            'width' => 150,
            'height' => 150,
        ) );
        $image = bp_get_group_avatar('type=full&width=150&height=150');
        if($avatar){
          echo $avatar;
        }else{
          echo '<img src="'.get_stylesheet_directory_uri().'/img/default_image_groups.png" />';
        } ?>
      </a>
		</div>
		<div class="title">
      <?php $gname = get_the_title(); ?>
			<a href="<?php the_permalink() ?>"><?php echo (strlen($gname) > 50)? substr($gname,0,50)."..." : $gname; ?></a>
		</div>
	</div>
</li>
