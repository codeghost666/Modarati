<?php
/*
 * Template Name: Contacts page template
 */
?>
<?php get_header(); ?>
<body>
    <div class="wrapper">
	    <?php get_template_part('template-part/section', 'header'); ?>
        <div class="contacts">
            <div class="contacts__title"><?php the_title(); ?></div>
            <div class="contacts__box">
                <div class="contacts__info">
                    <div class="contacts__info-box">
                        <?php
                            if(have_rows('contacts_page_settings')) {
                                while(have_rows('contacts_page_settings')) {
                                    the_row();
	                                if(get_row_layout() == 'contacts') {
		                                $title = get_sub_field('title') ? get_sub_field('title', false, false) : '';
		                                $text = get_sub_field('text') ? get_sub_field('text', false, false) : '';
		                                ?>
                                        <div class="contacts__info-title"><?php echo $title; ?></div>
                                        <div class="contacts__info-text"><?php echo $text; ?></div>
                                        <ul class="contacts-list">
                                            <?php
                                            if(have_rows('contact_info')) {
                                                while(have_rows('contact_info')) {
                                                    the_row();
                                                    $info_title = get_sub_field('title') ? get_sub_field('title', false, false) : '';
                                                    $info_text = get_sub_field('text') ? get_sub_field('text', false, false) : '';

                                                    $email = is_email($info_text) ? 'href="mailto:'.$info_text.'"' : '';
                                                    ?>
                                                    <li>
                                                        <div class="contacts-list__title"><?php echo $info_title; ?></div>
                                                        <a class="contacts-list__email" <?php echo $email; ?> ><?php echo $info_text; ?></a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                        <?php
	                                }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
	    <?php get_template_part('template-part/contact', 'form'); ?>
	    <?php get_template_part('template-part/section', 'popup'); ?>
<?php get_footer(); ?>

<script>
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 50) {
        //$(".logo").addClass("header_logo_fix");
        //$(".nav").addClass("header_hidden");
    } else {
        //$(".logo").removeClass("header_logo_fix");
        //$(".nav").removeClass("header_hidden");
    }
});
</script>
