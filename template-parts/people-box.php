<?php $orders = get_query_var('orders'); ?>
<li <?php foreach ($orders as $key => $value) echo 'data-'.$key.'= "'.$value.'" '; ?>>
    <div>
    	<div class ="image">
			<a href="<?php bp_member_permalink() ?>"><?php bp_member_avatar( 'type=full&width=150&height=150' ); ?></a>
		</div>
		<div class="title">
			<a href="<?php bp_member_permalink() ?>"><?php bp_member_name(); ?></a>
		</div>
	</div>
</li>