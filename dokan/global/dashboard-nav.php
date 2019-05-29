<?php get_template_part('/template-parts/menu-myaccount'); ?>

<?php
$home_url = home_url();
$active_class = ' class="active"';
?>

<div class="dokan-dash-sidebar">
    <?php echo dokan_dashboard_nav( $active_menu ); ?>
</div>
