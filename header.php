<?php redirect_public_community(); ?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        /*conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });*/
        </script>

	</head>
	<body <?php body_class(); ?>>

		<!-- wrapper -->
		<div class="wrapper">

			<!-- header -->
			<header class="header clear" role="banner">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 text-center">
							<!-- logo -->
							<div class="logo-autogov">
								<a href="https://autogov.systems" target="_blank">
									AUTOGOV
								</a>
							</div>
							<!-- /logo -->
						</div>
					</div>
					<div class="row align-items-center">
						<div class="col-3">
							<div class="logo">
								<a href="<?php echo home_url(); ?>">
								<?php $logo = get_option('logo_comunidad');
								if($logo){
									echo '<img src="'.$logo.'" alt="Logo" class="logo-img">';
								}else{
									echo '<img src="'.get_template_directory_uri().'/img/default-logo-community.png" alt="Logo" class="logo-img">';
								}
								 ?>
							 	</a>
							</div>
						</div>
						<div class="col-9 text-right">
							<div class="nav-menu">
								<?php get_template_part('menu'); ?>
							</div>
						</div>
					</div>
				</div>
			</header>
			<!-- /header -->
