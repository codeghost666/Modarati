<div class="sing-up sing-up--contacts" style="background-image:url(<?php echo TMASSETS.'/form-bg-2.jpg'; ?>)">
	<div class="sing-up__title"><?php echo get_option('title_contactus') ? get_option('title_contactus') : 'Send us a message'; ?></div>
	<div class="sing-up__sub-title"><?php echo get_option('text_contactus') ? get_option('text_contactus') : ''; ?></div>
	<form class="form" action="#">
		<div class="form__row">
			<div class="form__col">
				<label for="name">Name*</label>
				<input id="name" name="name" type="text" class="form_info" placeholder="Type here...">
			</div>
			<div class="form__col">
				<label for="email">Email*</label>
				<input id="email" name="email" type="email" class="form_info" placeholder="Type here...">
			</div>
		</div>
		<div class="form__row form__row--full">
			<label for="area">Your Question*</label>
			<textarea placeholder="Type here..." name="sender_question" class="form_info" id="area" cols="30" rows="10"></textarea>
		</div>
		<div class="form__button">
			<input class="form__btn" type="submit" value="Submit">
		</div>
	</form>
</div>
