<?php
/*
 * Template Name: Brands page template
 */
?>
<?php get_header(); ?>
<link href="https://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

<body class="brands">
    <div class="wrapper">
        <?php
        get_template_part('template-part/section', 'header');
        if(have_rows('brands_page_settings')) {
            while(have_rows('brands_page_settings')) {
                the_row();

                if(get_row_layout() == 'top_section') {
                    $title = get_sub_field('title') ? get_sub_field('title', false, false) : '';
                    $text = get_sub_field('text') ? get_sub_field('text', false, false) : '';
                    $image = get_sub_field('image') ? get_sub_field('image') : '';
                    ?>
                    <div class="top-section top-section--brands" style="background-image:url(<?php echo $image; ?>)">
                        <div class="top-section__holder top-section__holder--brands">
                            <h1 class="top-section__title top-section__title--brands"><?php echo $title; ?></h1>
                            <div class="top-section__text">
                                <?php echo $text; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }

	            if(get_row_layout() == 'content') {
		            if(have_rows('content_block')) {
		                $content_counter = 1;
		                ?>
                        <div class="main">
                            <div class="decor-1">
                                <svg class="logo-svg"><use xlink:href="<?php echo TMASSETS.'/sprite.svg#logo' ?>" /></svg>
                            </div>
                            <div class="decor-2">
                                <svg class="logo-svg"><use xlink:href="<?php echo TMASSETS.'/sprite.svg#logo' ?>" /></svg>
                            </div>
                            <div class="brands-info">
                                <?php
                                while(have_rows('content_block')) {
                                    the_row();
                                    $title_content = get_sub_field('title') ? get_sub_field('title', false, false) : '';
                                    $text_content = get_sub_field('text') ? get_sub_field('text', false, false) : '';
                                    $media_content = get_sub_field('media') ? get_sub_field('media') : '';
                                    ?>
                                    <div class="brands-info__box block-<?php echo $content_counter; ?>">
                                        <div class="brands-info__text-box">
                                            <div class="brands-info__text">
                                                <h2 class="brands-info__title"><?php echo $title_content; ?></h2>
                                                <div class="brands-info__notes">
                                                    <?php echo $text_content; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="brands-info__image <?php echo $content_counter == 1 ? 'video' : ''; ?>">
                                            <img src="<?php echo $media_content; ?>" width="640" height="460" alt="<?php echo $title_content; ?>">
                                        </div>
                                    </div>
                                    <?php
                                    $content_counter++;
                                }
	                        echo "</div>";
                        }

                    echo "</div>";
	            }
            }
        }
        ?>
    <?php get_template_part('template-part/contact', 'signin-form'); ?>
    <?php get_template_part('template-part/section', 'popup'); ?>
<?php get_footer(); ?>

<script>
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 50) {
        //$(".logo").addClass("header_logo_fix");
        //$(".nav").addClass("header_hidden");
        //$(".header_contact").addClass("header_hidden");
    } else {
        //$(".logo").removeClass("header_logo_fix");
        //$(".nav").removeClass("header_hidden");
        //$(".header_contact").removeClass("header_hidden");
    }
});
</script>
