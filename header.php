<head>
	<meta charset="UTF-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="<?php echo get_bloginfo('description'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
        <?php
				$page_title = '';

				if(is_page_template('page-home.php')) {
					$page_title = get_bloginfo('name');
				} elseif(is_404()) {
					$page_title = get_bloginfo('name').' | Page not found';
				} else {
					$page_title = get_bloginfo('name').' | '.get_the_title();
				}

        echo $page_title;
        ?>
    </title>
	<link rel="shortcut icon" href="<?php echo get_site_icon_url(); ?>" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="16x16 32x32" href="<?php echo TMASSETS.'/favicon-32x32.png'; ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo TMASSETS.'/android-icon-192x192.png'; ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo TMASSETS.'/apple-icon-180x180.png'; ?>">
<script id="_agile_min_js" async type="text/javascript" src="https://modarati.agilecrm.com/stats/min/agile-min.js"> </script>
<script type="text/javascript" >
var Agile_API = Agile_API || {}; Agile_API.on_after_load = function(){
_agile.set_account('r4fjhod3a7vdtm4t43ifl6nj7a', 'modarati');
_agile.track_page_view();
_agile_execute_web_rules();};
</script>
<Script>
function myFunction() {
    var x = document.getElementById("formlist");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114404399-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-114404399-1');
</script>
	<?php wp_head(); ?>
</head>
