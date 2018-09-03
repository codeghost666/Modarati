		<footer class="footer">
			<div class="copy"><?php echo get_option('text_footer') ? get_option('text_footer') : '&copy; Modarati 2018, All rights reserved';?></div>
			<nav class="nav">
				<?php
				echo wp_nav_menu( array(
					'theme_location'  => 'footer-nav',
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
				) );
				?>
			</nav>
			<ul class="social">
				<li class="facebook"><a target="_blank" href="<?php echo !empty(get_option('facebook_link')) ? get_option('facebook_link') : '#'; ?>"><svg><use xlink:href="<?php echo TMASSETS.'/sprite.svg#facebook'; ?>"/></svg></a></li>
				<li class="instagram"><a target="_blank" href="<?php echo !empty(get_option('instagram_link')) ? get_option('instagram_link') : '#'; ?>"><svg><use xlink:href="<?php echo TMASSETS.'/sprite.svg#instagram'; ?>"/></svg></a></li>
				<li class="linkedin"><a target="_blank" href="<?php echo !empty(get_option('linkedin_link')) ? get_option('linkedin_link') : '#'; ?>"><svg><use xlink:href="<?php echo TMASSETS.'/sprite.svg#linkedin'; ?>"/></svg></a></li>
				<li class="twitter"><a target="_blank" href="<?php echo !empty(get_option('twitter_link')) ? get_option('twitter_link') : '#'; ?>"><svg><use xlink:href="<?php echo TMASSETS.'/sprite.svg#twitter'; ?>"/></svg></a></li>
			</ul>
		</footer>
	</div>
        <!-- W3TC-include-css -->
        <!-- W3TC-include-js-head -->
<?php wp_footer(); ?>

</body>