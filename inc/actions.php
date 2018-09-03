<?php
add_action('wp_enqueue_scripts', 'tm_enqueue_scripts');
add_action('get_footer', 'tm_enqueue_style');
add_action('admin_enqueue_scripts', 'tm_admin_enqueue_scripts');
add_action('init', 'tm_nav_menu');
add_action('wp_ajax_tm_signin_ajax', 'tm_signin_ajax');
add_action('wp_ajax_nopriv_tm_signin_ajax', 'tm_signin_ajax');
add_action('wp_ajax_tm_delete_post', 'tm_delete_post');
add_action('admin_menu', 'tm_admin_menu');
add_action('wp_ajax_tm_send_email', 'tm_send_email');
add_action('wp_ajax_nopriv_tm_send_email', 'tm_send_email');
add_action('init', 'tm_disable_wp_emojicons');
add_action('acf/init', 'tm_acf_init');

add_filter('nav_menu_css_class','tm_classes_on_li', 1, 2);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/modarati/PHPMailer/src/PHPMailer.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/modarati/PHPMailer/src/Exception.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/modarati/PHPMailer/src/SMTP.php');
//include("../mail/PHPMailerAutoload.php");

if(isset($_POST['export_to_xls'])) {
    $fun_suffix = $_POST['action'];
	$fun_name = 'tm_show_clients_'.$fun_suffix;
	$fun_name('xls_export');
}

if(isset($_POST['export_to_csv'])) {
	$fun_suffix = $_POST['action'];
	$fun_name = 'tm_show_clients_'.$fun_suffix;
	$fun_name('csv_export');
}

function tm_acf_init() {
	if( function_exists('acf_add_options_page') ) {
		$option_page = acf_add_options_page(array(
			'page_title' 	=> __('Theme Settings', 'my_text_domain'),
			'menu_title' 	=> __('Theme Settings', 'my_text_domain'),
			'menu_slug' 	=> 'theme-settings',
		));
	}
}

function tm_disable_wp_emojicons() {
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}

function tm_enqueue_scripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
	wp_enqueue_script( 'jquery' );

	wp_register_script( 'modarati_main_js', TMURL.'/assets/js/app.js', array('jquery'), '', true);
	wp_enqueue_script( 'modarati_main_js');

	if(is_page_template('page-brands.php') || is_page_template('page-buyers.php')) {
		wp_register_script('modarati_contacts', TMURL.'/assets/js/modarati_contacts.js', array('modarati_main_js'), '', true);
		wp_localize_script('modarati_contacts', 'url', array('ajaxurl' => admin_url( 'admin-ajax.php' )));
		wp_enqueue_script('modarati_contacts');
	}

	if(is_page_template('page-contacts.php')) {
		wp_register_script('modarati_contact_form', TMURL.'/assets/js/modarati_contact_form.js', array('modarati_main_js'), '', true);
		wp_localize_script('modarati_contact_form', 'url', array('ajaxurl' => admin_url( 'admin-ajax.php' )));
		wp_enqueue_script('modarati_contact_form');
	}
}

function tm_enqueue_style() {
	wp_enqueue_style( 'modarati_main_css', TMURL.'/assets/css/index.css', false );
	wp_enqueue_style( 'modarati_fonts', 'https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Poppins:300,400,500', false );
}

function tm_admin_enqueue_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'datatables_js', TMURL.'/assets/js/jquery.dataTables.min.js', array('jquery'));
	wp_enqueue_style( 'datatables_css', TMURL.'/assets/css/jquery.dataTables.min.css', false );

	wp_register_script('modarati_admin', TMURL.'/assets/js/modarati_admin.js', array('datatables_js'));
	wp_localize_script('modarati_admin', 'url', array('ajaxurl' => admin_url( 'admin-ajax.php' )));
	wp_enqueue_script('modarati_admin');
}

function tm_nav_menu() {
	register_nav_menus(
		array(
			'header-nav' => __( 'Header Menu' ),
			'footer-nav' => __( 'Footer Menu' ),
			'social-links' => __( 'Social links' )
		)
	);
}

function tm_signin_ajax() {
	$post = $_POST;

	$response = [
		'success' => true,
		'error_message' => []
	];

	if(isset($post) && !empty($post)) {
		unset($post['action']);

		foreach($post as $key => &$value) {
		    if(is_array($value)) {
		        continue;
            }

			$value = esc_attr(sanitize_text_field($value));
        }

		$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
		if(preg_match($regex, $post['phone'])) {
			$response['success'] = false;
			$response['error_message'][] = 'Invalid phone number!';
		}

		if(!is_email($post['email'])) {
			$response['success'] = false;
			$response['error_message'][] = 'Invalid email!';
		}

		if($response['success']) {
			$new_post = array(
				'post_title'    => $post['name'],
				'post_status'   => 'publish',
				'post_type' => 'clients_'.$post['sender']
			);

      $sender = $post['sender'];

			unset($post['sender']);

			$pid = wp_insert_post($new_post);

			if(!isset($post['options'])) {
				$post['options'] = [];
            }

			if(!update_post_meta($pid, 'client_info', $post)) {
				$response['success'] = false;
				$response['error_message'][] = 'Can not update post meta...';
			}

      $email_options = get_field($sender.'_email_settings', 'option');
      // print_r($email_options);wp_die();
      
      if($sender == 'buyers'){
           $attachpath = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/2018/02/Free-Report-Retail-Buyers.pdf';}
      else{
           $attachpath = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/2018/02/Free-Report-Wholesale.pdf';}


      if($email_options) {
        $admins_email = get_option('tm_admin_email') ? get_option('tm_admin_email') : get_bloginfo('admin_email');
        $subject =  $email_options['email_subject'] ? $email_options['email_subject'] : 'Modarati  -  Wholesale Fashion Buying Made Simple';
    	$message =  $email_options['email_message'] ? $email_options['email_message'] : '';
        $headers = "MIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\n";
        $attachment = $email_options['email_file'] ? $email_options['email_file'] : '';
        
        
        		$mail = new PHPMailer(true);
			$mail->IsSMTP();
			$mail->Host = "a2plcpnl0936.prod.iad2.secureserver.net";	
			$mail->SMTPAuth = true;			
			$mail->Username   = 'contact@modarati.com';
			$mail->Password   = '1qa2ws3ed!QA@WS#ED';
			$mail->Port = 25;
			$mail->SMTPSecure = false;			
			$mail->SMTPDebug = 0;
			
			$mail->SetFrom('jennifer@modarati.com', 'Modarati');
			$mail->AddAddress($post['email'], 'You');
			
			//Contents
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $message;
			
			$mail->addAttachment($attachpath);
			
			
		        if ($mail->send()) {
                           $response['success'] = true;
                        } else {
                           $response['success'] = false;
    			   $response['error_message'][] = 'Can not send email!';
                        }

//    		if(wp_mail($admins_email, $subject, $message.' '.$attachment, $headers, $attachment)) {
//    			$response['success'] = true;
//    		}else{
//    			$response['success'] = false;
//    			$response['error_message'][] = 'Can not send email!';
//    		}
      } else {
        $response['success'] = false;
    		$response['error_message'][] = 'No email data!';
      }
		}
	} else {
		$response['success'] = false;
		$response['error_message'][] = 'Empty incoming data!';
	}

	header('Content-Type: application/json');
	echo json_encode($response);
	wp_die();
}

function tm_delete_post() {
	$post = $_POST;

	$response = [
		'success' => true,
		'error_message' => []
	];

	if(isset($post) && !empty($post)) {
        $post_id = (int) $post['post_id'];

		if(delete_post_meta($post_id, 'client_info')) {
		    if(wp_delete_post($post_id)) {
			    $response['success'] = true;
            } else {
			    $response['success'] = false;
			    $response['error_message'][] = 'Can not delete post...';
            }
        } else {
			$response['success'] = false;
			$response['error_message'][] = 'Can not delete post meta...';
        }
    } else {
		$response['success'] = false;
		$response['error_message'][] = 'Empty data!';
    }

	header('Content-Type: application/json');
	echo json_encode($response);
	wp_die();
}

function tm_classes_on_li($classes, $item) {
	if(in_array('current-menu-item', $item->classes)) {
		$classes[] = 'active';
	}
	return $classes;
}

function tm_admin_menu() {
	add_menu_page( 'Clients Buyers List', 'Clients Buyers List', 'manage_options','clients_buyers_list', 'tm_show_clients_buyers', 'dashicons-universal-access-alt',3 );
	add_menu_page( 'Clients Brands List', 'Clients Brands List', 'manage_options','clients_brands_list', 'tm_show_clients_brands',  'dashicons-universal-access-alt',4 );
}

function tm_show_clients_buyers($action = '') {
	echo '<h1>Buyers List</h1>';

	$clients_buyers = get_posts(
		array(
			'post_type' => 'clients_buyers',
			'post_status' => 'publish',
            'numberposts' => -1,
		)
	);

	if(!empty($clients_buyers)) {
		$clients_buyers_meta = [];

		foreach($clients_buyers as $client_buyer) {
			$clients_buyers_meta[$client_buyer->ID] = get_post_meta($client_buyer->ID, 'client_info', true);
		}

		$client_type = 'buyers';
		tm_echo_clients_tables($clients_buyers_meta, $client_type, $action);
	} else {
		echo '<h3>No clients...</h3>';
	}
}

function tm_show_clients_brands($action = '') {
	echo '<h1>Brands List</h1>';

	$clients_brands = get_posts(
		array(
			'post_type' => 'clients_brands',
			'post_status' => 'publish',
			'numberposts' => -1,
		)
	);

	if(!empty($clients_brands)) {
		$clients_brands_meta = [];

		foreach($clients_brands as $client_brand) {
			$clients_brands_meta[$client_brand->ID] = get_post_meta($client_brand->ID, 'client_info', true);
		}

		$client_type = 'brands';
		tm_echo_clients_tables($clients_brands_meta, $client_type, $action);
	} else {
		echo '<h3>No clients...</h3>';
	}
}

function tm_echo_clients_tables($arr, $client_type, $action) {
	if(empty($arr)) {
		return;
	}

	$header_footer_row = '
        <th>#</th>
        <th>Name</th>
        <th>Company Name</th>
        <th>Location</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Website</th>
        <th>Retailer #1</th>
        <th>Retailer #2</th>
        <th>Retailer #3</th>
        <th>Options</th>
        <th>Delete</th>
	';

	$table_header = '
        <style type="text/css">
            #adminmenuwrap{position:fixed!important;}
        </style>
        <table id="clients_brands">
		    <thead>
		    <tr>'.$header_footer_row.'</tr>
		    </thead>
		    <tbody>
	';

	$table_content = '';
	$counter = 1;

	foreach($arr as $key => $value) {
	    $options = '';

	    if(is_array($value["options"]) && !empty($value["options"])) {
		    $options = implode(', ', $value["options"]);
        } else {
	        if(empty($value["options"])) {
		        $options = 'No options';
            } else {
		        $options = $value["options"];
            }
        }

		$table_content .= '
            <tr>
                <td>'.$counter.'</td>
                <td>'.$value["name"].'</td>
                <td>'.$value["company_name"].'</td>
                <td>'.$value["location"].'</td>
                <td>'.$value["phone"].'</td>
                <td>'.$value["email"].'</td>
                <td>'.$value["site"].'</td>
                <td>'.$value["retailer1"].'</td>
                <td>'.$value["retailer2"].'</td>
                <td>'.$value["retailer3"].'</td>
                <td>'.$options.'</td>
                <td><a style="cursor: pointer;" data-id="'.$key.'" class="delete_item">&#10005;</a></td>
            </tr>
        ';

		$counter++;
	}

	$table_footer = '
        </tbody>
        <tfoot>
        <tr>'.$header_footer_row.'</tr>
        </tfoot>
        </table>
    ';

	if(isset($action) && $action == 'xls_export') {
	    $file_name = 'clients_'.$client_type.'_'.date('m_d_Y').'.xls';
		ob_clean();
		header('Content-Type: application/xls');
		header('Content-Disposition: attachment; filename='.$file_name.'');

		$header_footer_row = '
            <th>#</th>
            <th>Name</th>
            <th>Company Name</th>
            <th>Location</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Website</th>
            <th>Retailer #1</th>
            <th>Retailer #2</th>
            <th>Retailer #3</th>
            <th>Options</th>
        ';

		$table_header = '
            <table id="clients_brands">
                <thead>
                <tr>'.$header_footer_row.'</tr>
                </thead>
                <tbody>
        ';

		$table_content = '';
		$counter = 1;

		foreach($arr as $key => $value) {
			$options = '';

			if(is_array($value["options"]) && !empty($value["options"])) {
				$options = implode(', ', $value["options"]);
			} else {
				if(empty($value["options"])) {
					$options = 'No options';
				} else {
					$options = $value["options"];
				}
			}

			$table_content .= '
                <tr>
                    <td>'.$counter.'</td>
                    <td>'.$value["name"].'</td>
                    <td>'.$value["company_name"].'</td>
                    <td>'.$value["location"].'</td>
                    <td>'.$value["phone"].'</td>
                    <td>'.$value["email"].'</td>
                    <td>'.$value["site"].'</td>
                    <td>'.$value["retailer1"].'</td>
                    <td>'.$value["retailer2"].'</td>
                    <td>'.$value["retailer3"].'</td>
                    <td>'.$options.'</td>
                </tr>
            ';

			$counter++;
		}

		$table_footer = '
            </tbody>
            <tfoot>
            <tr>'.$header_footer_row.'</tr>
            </tfoot>
            </table>
        ';

		echo '<h1>'.ucfirst($client_type).' List</h1>'.$table_header.$table_content.$table_footer;
		exit;
	} elseif(isset($action) && $action == 'csv_export') {
		$file_name = 'clients_'.$client_type.'_'.date('m_d_Y').'.csv';
		ob_clean();

		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename='.$file_name.'');
		$output_csv = fopen("php://output", 'w');

		$flag = false;

		foreach ($arr as $fields => $field) {
			if(!$flag) {
				echo str_replace('_', ' ', implode("\t", array_keys($field)) . "\n");
				$flag = true;
			}

		    $options = $field['options'];
		    unset($field['options']);

			if(is_array($options)) {
				$field['options'] = implode(', ', $options);
            }

			fputcsv($output_csv, $field);
		}

		fclose($output_csv);
		exit;
	} else {
		echo $table_header.$table_content.$table_footer;

		?>
        <div style="float: left;margin-right: 10px;">
            <form action="" method="POST">
                <input type="hidden" name="action" value="<?php echo $client_type; ?>">
                <button type="submit" name="export_to_xls">Export data to EXCEL</button>
            </form>
        </div>
        <div>
            <form action="" method="POST">
                <input type="hidden" name="action" value="<?php echo $client_type; ?>">
                <button type="submit" name="export_to_csv">Export data to CSV</button>
            </form>
        </div>
		<?php
    }
}

function tm_send_email() {
	$user_data = $_POST;

	$user_name = esc_attr(sanitize_user($user_data['name']));
	$user_question = esc_attr(sanitize_text_field($user_data['sender_question']));
  $user_email = esc_attr(sanitize_text_field($user_data['email']));

	$response = [
		'success' => true,
		'error_messages' => []
	];

	if(empty($user_name) || empty($user_email) || empty($user_question)) {
		$response['error_messages'][] = 'Some fields are empty!';
		$response['success'] = false;

		header('Content-Type: application/json');
		echo json_encode($response);
		wp_die();
	}

	if($response['success']) {
		$subject = $user_name . ' -- ' . $user_email;

		$message = "
            <b>Hello Admin!<br/>Here is one more request:</b><br/>
            Name: ". $user_name . "<br/>
            Email: ". $user_email . "<br/>
            Question: " . $user_question . "<br/>
        ";

		$headers = "MIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\n";

		$admins_email = get_option('tm_admin_email') ? get_option('tm_admin_email') : get_bloginfo('admin_email');

		if(wp_mail($admins_email, $subject, $message, $headers)) {
			$response['success'] = true;
		}else{
			$response['success'] = false;
			$response['error_messages'][] = 'Can not send email!';
		}
	}else{
		$response['success'] = false;
		$response['error_messages'][] = 'Something wrong';
	}

	header('Content-Type: application/json');
	echo json_encode($response);
	wp_die();
}

function cptui_register_my_cpts() {

	/**
	 * Post Type: Clients Buyers.
	 */

	$labels = array(
		"name" => __( "Clients Buyers", "" ),
		"singular_name" => __( "Client Buyer", "" ),
		"menu_name" => __( "Clients Buyers", "" ),
		"all_items" => __( "All clients", "" ),
		"add_new" => __( "Add new client", "" ),
	);

	$args = array(
		"label" => __( "Clients Buyers", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "clients_buyers", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "clients_buyers", $args );

	/**
	 * Post Type: Clients Brands.
	 */

	$labels = array(
		"name" => __( "Clients Brands", "" ),
		"singular_name" => __( "Client Brand", "" ),
		"menu_name" => __( "Clients Brands", "" ),
	);

	$args = array(
		"label" => __( "Clients Brands", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "clients_brands", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "clients_brands", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
