<div class="popup">
	<div class="overlay"></div>
	<div class="video-box">
		<div class="close"></div>
 		<video loop="" controls="">
<!--			<source src="<?php echo TMURL.'/assets/videos/video.webm'; ?>" type="video/webm">-->
			<source src="<?php echo TMURL.'/assets/videos/buyers.mp4'; ?>" type="video/mp4">
		</video> 
<!-- 		<iframe width="1000" height="715" src="https://www.youtube.com/embed/fCE3V94529k?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
	</div>
</div>
<div class="popup-thanks">
	<div class="popup-thanks__overlay"></div>
	<div class="popup-thanks__box">
		<div class="popup-thanks__close"><svg><use xlink:href="<?php echo TMASSETS.'/sprite.svg#close'; ?>"/></svg></div>
		<svg class="popup-thanks__decor"><use xlink:href="<?php echo TMASSETS.'/sprite.svg#letter'; ?>"/></svg>
		<div class="popup-thanks__title"><?php echo 'THANK YOU!'; ?></div>
		<div class="popup-thanks__notes"><?php echo 'Please check your email for your free report'; ?></div>
	</div>
</div>