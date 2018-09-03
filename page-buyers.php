<?php
/*git
 * Template Name: Buyers page template
 */
?>
<?php get_header(); ?>
<link href="https://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

<body>
    <div class="wrapper">
        <?php get_template_part('template-part/section', 'header'); ?>
        <div class="main">
            <div class="decor-1">
                <svg class="logo-svg"><use xlink:href="<?php echo TMASSETS.'/sprite.svg#logo' ?>"/></svg>
            </div>
            <div class="buyers">
                <?php
                if(have_rows('buyers_page_settings')) {
                    while(have_rows('buyers_page_settings')) {
                        the_row();

                        if(get_row_layout() == 'first_section') {
                            $title = get_sub_field('title') ? get_sub_field('title', false, false) : '';
                            $text = get_sub_field('text') ? get_sub_field('text', false, false) : '';
                            ?>
                            <h1 class="buyers__title"><?php echo $title; ?></h1>
                            <div class="buyers__text">
	                            <?php echo $text; ?>
                            </div>
                            <?php
                        }

                        if(get_row_layout() == 'second_section') {
                            $title = get_sub_field('title') ? get_sub_field('title', false, false) : '';
                            $text = get_sub_field('text') ? get_sub_field('text', false, false) : '';
                            $image = get_sub_field('image') ? get_sub_field('image') : '';
                            ?>
<div class="brands-info__box block-1">
     <div class="brands-info__text-box">
          <div class="brands-info__text">
               <h2 class="brands-info__title">A Picture Is Worth A Thousand Words. A Video Is Worth A Million</h2>
                   <div class="buyers__info-text">
                        <p>Our multidimensional experience reveals how a piece truly fits and feels - so you can stop guessing, and start knowing how something will fit your target market.</p>                                                
                   </div>
          </div>
     </div>
     <div class="brands-info__image video">
          <img src="https://modarati.com/wp-content/uploads/2018/01/forvideo2.jpg" width="640" height="460" alt="Tailored Videos for Tailored Clothing ">
     </div>
</div>
<br><br>
                            <div class="buyers__info">
                                <div class="buyers__info-image">
                                    <img src="<?php echo $image; ?>" width="560" height="641" alt="image">
                                </div>
                                <div class="buyers__info-text-box">
                                    <h2 class="buyers__info-text-title"><?php echo $title; ?></h2>
                                    <div class="buyers__info-text">
	                                    <?php echo $text; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                        if(get_row_layout() == 'third_section') {
                            $title = !empty(get_sub_field('title')) ? get_sub_field('title', false, false) : '';
                            $subtitle = !empty(get_sub_field('subtitle')) ? get_sub_field('subtitle', false, false) : '';
                            ?>
                            <div class="smart">
                                <h2 class="smart__title"><?php echo $title; ?></h2>
                                <div class="smart__notes"><?php echo $subtitle; ?></div>
                                <div class="smart__list">
                                    <?php
                                        if(have_rows('columns')) {
                                            while(have_rows('columns')) {
                                                the_row();
                                                $title_column = get_sub_field('title') ? get_sub_field('title', false, false) : '';
                                                $text_column = get_sub_field('text') ? get_sub_field('text', false, false) : '';
                                                ?>
                                                <div class="smart__box">
                                                    <div class="smart__box-title"><?php echo $title_column; ?></div>
                                                    <div class="smart__text">
                                                        <?php echo $text_column; ?>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        if(get_row_layout() == 'fourth_section') {
                            $title = get_sub_field('title') ? get_sub_field('title', false, false) : '';
                            $text = get_sub_field('text') ? get_sub_field('text', false, false) : '';
                            ?>
                            <div class="welcome">
                                <div class="welcome__box">
                                    <div class="welcome__title"><?php echo $title; ?></div>
                                    <div class="welcome__text"><?php echo $text; ?></div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
            ?>
        </div>
    </div>
    <?php get_template_part('template-part/contact', 'signin-form'); ?>

        <?php get_template_part('template-part/section', 'popupb'); ?>
</div>
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
