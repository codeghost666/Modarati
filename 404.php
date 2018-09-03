<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>
    <body class="error-page">
        <div class="wrapper">
	        <?php get_template_part('template-part/section', 'header'); ?>
            <div class="error-holder">
                <div class="error-box">
                    <div class="error-number">404</div>
                    <div class="error-text"><?php echo get_option('404_error_message_text') ? get_option('404_error_message_text') : 'Page not found'; ?></div>
                    <a href="<?php echo get_home_url(); ?>" class="error-btn">Home</a>
                </div>
            </div>
        </div>
    </body>

    <?php get_footer(); ?>
    <style>
    .footer{
      display:none;
      }</style>
