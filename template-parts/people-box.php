<?php $orders = get_query_var('orders'); ?>
<li <?php foreach ($orders as $key => $value) echo 'data-'.$key.'= "'.$value.'" '; ?>>
    <div>
    	<div class ="image">
			<a href="<?php bp_member_permalink() ?>"><?php bp_member_avatar( 'type=full&width=150&height=150' ); ?></a>
		</div>
		<div class="title">
      <?php $gname = bp_get_member_name(); ?>
			<a href="<?php bp_member_permalink() ?>"><?php echo (strlen($gname) > 50)? substr($gname,0,50)."..." : $gname; ?></a>
		</div>
	</div>
</li>
