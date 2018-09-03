<?php
/*
 * Template Name: Home page template
 */
?>
<?php get_header(); ?>
<body class="home">
	<div class="wrapper">
        <?php
        get_template_part('template-part/section', 'header');
        if(have_rows('home_page_settings')) {
            while(have_rows('home_page_settings')) {
                the_row();
                    if(get_row_layout() == 'top_section') {
                    $title = get_sub_field('title', false, false);
                    $subtitle = get_sub_field('subtitle', false, false);
                    $desc = get_sub_field('description', false, false);
                    $image = get_sub_field('image');

                    ?>
                        <div class="top-section" style="background-image:url(<?php echo $image ? $image : ''; ?>)">
                            <div class="top-section__holder">
                                <div class="top-section__title"><?php echo $title ? $title : ''; ?></div>
                                <div class="top-section__sub-title"><?php echo $subtitle ? $subtitle : ''; ?></div>
                                <div class="top-section__text">
                                    <?php echo !empty($desc) ? $desc : ''; ?>
                                </div>
                            </div>
                        </div>
                    <?php
                }

                if(get_row_layout() == 'content') {
                    $title = get_sub_field('title', false, false);
                    $subtitle = get_sub_field('subtitle', false, false);
                    $desc = get_sub_field('description', false, false);
                    $image = get_sub_field('image');
                    $page_link = get_sub_field('page_link');
                    ?>
                    <div class="category">
                        <div class="category__info">
                            <div class="category__text-decor">
                                <svg class="logo-svg"><use xlink:href="<?php echo TMASSETS.'/sprite.svg#logo' ?>"/></svg>
                            </div>
                            <div class="category__text">
                                <div class="category__title">
                                    <a href="<?php echo !empty($page_link) ? $page_link : ''; ?>"><?php echo !empty($title) ? $title : ''; ?></a>
                                </div>
                                <div class="category__notes">
                                    <?php echo !empty($subtitle) ? $subtitle : ''; ?>
                                </div>
                                <ul class="category__list">
                                    <?php echo !empty($desc) ? $desc : ''; ?>
                                </ul>
                                <a href="<?php echo !empty($page_link) ? $page_link : ''; ?>" class="more">Learn more</a>
                            </div>
                        </div>
                        <div class="category__image">
                            <a href="<?php echo !empty($page_link) ? $page_link : ''; ?>">
                                <img src="<?php echo !empty($image) ? $image : ''; ?>" width="960" height="980" alt="<?php echo !empty($title) ? $title : ''; ?>">
                            </a>
                        </div>
                    </div>
                    <?php
                }

                if(get_row_layout() == 'bottom_section') {
                    $title = get_sub_field('title', false, false);
                    $subtitle = get_sub_field('subtitle', false, false);
                    ?>
                    <div class="intro-box">
                        <h2 class="intro-box__title"><?php echo !empty($title) ? $title : ''; ?></h2>
                        <div class="intro-box__sub-title"><?php echo !empty($subtitle) ? $subtitle : ''; ?></div>
                    </div>
                    <?php
                }
            }
        }
    ?>

<?php get_footer(); ?>

<script>
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 300) {
        $(".slogan").addClass("header_hidden");
        $(".nav").addClass("header_hidden");
    } else {
        $(".slogan").removeClass("header_hidden");
        $(".nav").removeClass("header_hidden");
    }
});
</script>
