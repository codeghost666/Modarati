<?php
$favourite_object = '';
$sender = '';

$block_title = '';
$block_text = '';

if(is_page_template('page-buyers.php')) {
	$favourite_objects = 'brands';
	$favourite_object = 'brand';
	$sender = 'buyers';

	$block_title = get_option('buyers_title_signup') ? get_option('buyers_title_signup') : 'Sign Up For This Report To See What\'s Trending With Your Customers';
	$block_text = get_option('buyers_text_signup') ? get_option('buyers_text_signup') : "Modarati's trend reports keep you ahead of the curve and relevant in today's ever-changing market.<br> Know what customers are looking for so you can stock your inventory with hot items they'll love.";
}

if(is_page_template('page-brands.php')) {
	$favourite_objects = 'retailers';
	$favourite_object = 'retailer';
	$sender = 'brands';

	$block_title = get_option('brands_title_signup') ? get_option('brands_title_signup') : 'Sign Up For This Report About Capitalizing on Trends';
	$block_text = get_option('brands_text_signup') ? get_option('brands_text_signup') : "The market is changing rapidly, meaning that you need to stay on top of trends to keep your buyers happy.<br> Modarati's trend reports notify you of upcoming trends, giving you time to plan ahead and design your next line to capitalize on market demand.";
}
?>
<div id="signUp" class="sing-up" style="background-image:url(<?php echo TMASSETS.'/form-bg.jpg'; ?>)">
	<div class="sing-up__title"><?php echo $block_title; ?></div>
	<div class="sing-up__sub-title"><?php echo $block_text; ?></div>
	<form class="form" action="#">
		<div class="form__top">
			<div class="form__category">
				<div class="form__opener">What Is Your Average Price Point?</div>
				<ul class="form__list" id="formlist">
					<?php
					$categories = get_categories(array('hide_empty' => false, 'orderby'      => 'name'));
					$count_cats = 1;

					if(!empty($categories)) {
						foreach($categories as $category) {

							echo '
								<li data-number="'.$count_cats.'" onclick="myFunction()">
									<input type="checkbox" value="'.$category->name.'" >
									<span data-number="'.$count_cats.'" class="form__list-text">'.$category->name.'</span>
								</li>
							';

							$count_cats++;
						}
					}
					?>
				</ul>
			</div>
			<div class="form__tag"></div>
		</div>
		<div class="form__row">
			<div class="form__col">
				<label for="name">Name*</label>
				<input id="name" name="name" class="form_info" type="text" placeholder="Type here...">
			</div>
			<div class="form__col">
				<label for="cname">Company Name*</label>
				<input id="cname" name="company_name" class="form_info" type="text" placeholder="Type here...">
			</div>
		</div>
		<div class="form__row">
			<div class="form__col">
				<label for="loc">Location*</label>
				<input id="loc" name="location" class="form_info" type="text" placeholder="Type here...">
			</div>
			<div class="form__col">
				<label for="email">Email*</label>
				<input id="email" name="email" class="form_info" type="email" placeholder="example@gmail.com">
			</div>

		</div>
		<div class="add-fields">
			<div class="add-fields__title">Your 3 Favorite <?php echo ucfirst($favourite_objects); ?></div>
			<div class="form__row">
				<div class="form__col">
					<label for="retailer1">Favorite <?php echo $favourite_object; ?> 1*</label>
					<input id="retailer1" name="retailer1" class="form_info" type="text" placeholder="Type here...">
				</div>
				<div class="form__col">
					<label for="retailer2">Favorite <?php echo $favourite_object; ?> 2*</label>
					<input id="retailer2" name="retailer2" class="form_info" type="text" placeholder="Type here...">
				</div>
			</div>
			<div class="form__row form__row--full">
				<label for="retailer3">Favorite <?php echo $favourite_object; ?> 3*</label>
				<input id="retailer3" name="retailer3" class="form_info" type="text" placeholder="Type here...">
			</div>
		</div>
		<div class="form__button">
			<input class="form__btn" type="submit" value="Submit">
		</div>
        <input type="hidden" name="sender" class="form_info" value="<?php echo $sender; ?>" style="display: none;" />
	</form>
</div>
