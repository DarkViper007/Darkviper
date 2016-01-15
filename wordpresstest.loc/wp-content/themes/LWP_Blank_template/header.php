<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>

	<!-- wrapper -->
	<div class="wrapper">
		<header class="header" role="banner">
			<div id="navigation"  class="nav-container">

				<!-- nav -->
				<nav class="nav" role="navigation">
					<div class="logo"><a><img src='https://www.formula1.com/etc/designs/fom-website/images/f1_logo.svg'></a></div>
					<?php
					
					 lwp_nav(); ?>
					 <div class="acess">
					 	<div class="premium-unexpanded">
						<p class="premium-title">F1®Access </p>

					<div class="signed-out">
					<a href="#" class="sign-in">Sign in</a>
					 or 
					<a href="#" target="_self">Learn more</a>
					</div>
					 </div>
				</nav>
				<!-- /nav -->
			</div>

		</header>
		<div class="carousel">
				<div class="maincontainer">
					<?php
					global $lwp;

					$custom_theme_slides = $lwp['opt-slides'];
					foreach ($custom_theme_slides as $key => $slider_data): ?>
					
						<div class='slide' style=" background-image:url(<?= $slider_data['image'];?>); height:820px;">
							
							<div class="text_box">
								<?php if(!empty($slider_data['url'])){ ?>
								<h2 class="urlinfo"><?= $slider_data['url'];?></h2>
								<?php	} ; ?>
								<h1 class="slideinfo"><?= $slider_data['description'];?></h1>
								<div class="buttoninfo"><?= $slider_data['title'];?></div>
							</div>
							
							
						</div>
					
					<?php endforeach;

						?>
				</div>

			</div>				
