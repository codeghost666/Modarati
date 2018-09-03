<?php
/*
 * TEXT IN HEADER
 */
?>

<header class="header">

	<strong class="logo"><a href="<?php echo get_home_url(); ?>">Modarati</a></strong>
    <?php if(is_page_template('page-home.php')) {
			?>
			<h1 class="slogan"><?php echo get_option('text_header') ? get_option('text_header') : 'Connecting Wholesale Brands + Retail Buyers'; ?></h1>
			<?php
		} ?>
	<nav class="nav">
		<?php
		echo wp_nav_menu( array(
			'theme_location'  => 'header-nav',
			'menu'            => '',
			'container'       => '',
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,
			'walker'          => '',
		));
		?>
	</nav>
<?php if(is_page_template('page-buyers.php')) { ?>
     <div class="header_contact"><a href="#signUp" class="btn btn-outline-warning" style="text-decoration:none;">
Free Report
     </a></div>
<?php } else if(is_page_template('page-brands.php')) {?>
     <div class="header_contact"><a href="#signUp" class="btn btn-outline-warning" style="text-decoration:none;">
Free Report
     </a></div>
<?php } ?>
    <div class="menu-icon">
        <span id="bar-1" class="line"></span>
        <span id="bar-2" class="line"></span>
        <span id="bar-3" class="line"></span>
    </div>
</header>
