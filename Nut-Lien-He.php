<?php
/**
 * @package Hello_Dolly
 * @version 1.7.2
 */
/*
Plugin Name: Nut Lien He
Plugin URI: http://wordpress.org/plugins/contact-button/
Description: This plugin create a contact button
Author: Thanh
Version: 1.0
Author URI:  https://sachtienganh.kimnhungtoeic.com/
*/
add_action('wp_enqueue_scripts', 'enqueue_custom_css');


function enqueue_custom_css() {
    wp_enqueue_style('custom-css', plugin_dir_url(__FILE__) . 'Nut-Lien-He.css');
    wp_enqueue_script('Nut-Lien-He', plugin_dir_url(__FILE__) . 'Nut-Lien-He.js', array('jquery'), '1.0', true);

}


add_action('admin_menu', 'add_contact_menu');

function add_contact_menu() {
    add_menu_page(
        'Contact-Button',
        'Contact-Button',
        'manage_options',
        'contact-button',
        'thanh_contact_page',
        '',
        5
    );

    add_submenu_page(
        'contact-button',
        'Contact-Location',
        'Contact-Location',
        'manage_options',
        'contact-location',
        'thanh_contact_location'
    );

}



function thanh_contact_location(){
    if (isset($_POST["button_location"])) {
        $button_location = sanitize_text_field($_POST["button_location"]); // Lọc dữ liệu để tránh các vấn đề bảo mật
        update_option("button_location", $button_location);
    } else {
        update_option("button_location", "right");
    }
    ?>
    <h1>Cấu hình vị trí Button-Contact</h1>
    <form method="POST">
        <div>
            <input type="radio" name="button_location" value="left" id="btn-location-left" <?php echo (get_option("button_location") == "left") ? "checked" : ""; ?>>
            <label for="btn-location-left">Bên trái</label>
        </div>
        <div>
            <input type="radio" name="button_location" value="right" id="btn-location-right" <?php echo (get_option("button_location") == "right") ? "checked" : ""; ?>>
            <label for="btn-location-right">Bên phải</label>
        </div>
        <input type="submit" value="Lưu" />
    </form>

    <?php
}



function thanh_contact_page(){
    if(isset($_POST["messenger"])) {
        update_option("messenger", $_POST["messenger"]);
    } else if (isset($_POST["zalo"])) {
        update_option("zalo", $_POST["zalo"]);
    } else if (isset($_POST["so_dien_thoai"])){
        update_option("so_dien_thoai", $_POST["so_dien_thoai"]);
    }
    
    $messenger = get_option("messenger");
    $zalo = get_option("zalo");
    $so_dien_thoai = get_option("so_dien_thoai");
    
    ?>
    <h1>Cấu hình các Button-Contact</h1>
    <form method="POST">
        <div class="dad-contact">
            <div class="title-contact">
                <span class="title-contact">Cấu hình link Messenger</span>
            </div>
            <div >
                <input type="text" name="messenger" value="<?php echo $messenger ?>" placeholder="Nhập link Messenger"/>
                <input type="submit" value="Lưu" />
            </div>
        </div>
    </form>
        
    <form method="POST">
         <div class="dad-contact">
             <div class="title-contact">
                <span >Cấu hình Zalo</span>
            </div>
             <div>
                <input type="text" name="zalo" value="<?php echo $zalo ?>" placeholder="Nhập số điện thoại Zalo"/>
                <input type="submit" value="Lưu" />
            </div>
        </div>
    </form>
    <form method="POST">
        <div class="dad-contact">
            <div class="title-contact">
                <span class="title-contact">Cấu hình nút gọi</span>
            </div>
            <div>
                <input type="text" name="so_dien_thoai" value="<?php echo $so_dien_thoai ?>" placeholder="Nhập số điện thoại"/>
                <input type="submit" value="Lưu" />
            </div>
        </div>
    </form>
    
    <style>
        .dad-contact {
            margin: 20px;
            display: flex;
        }
        
        .title-contact {
            width: 170px;
        }
 
    </style>
    <?php
}
    

add_action("wp_footer", show_contact_button);

function  show_contact_button(){
    
    $button_location= get_option("button_location");
    $so_dien_thoai = get_option("so_dien_thoai");
    $messenger = get_option("messenger");
    $zalo = get_option("zalo");
    ?>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
     
		<div id="gom-all-in-one" class="<?php echo $button_location; ?>">
				<div id="fanpage-vr" class="button-contact">
					<div class="phone-vr">
						<div class="phone-vr-circle-fill"></div>
						<div class="phone-vr-img-circle">
							<a target="_blank" href="<?php echo $messenger; ?>">				
								<img alt="Fanpage" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/be/Facebook_Messenger_logo_2020.svg/1200px-Facebook_Messenger_logo_2020.svg.png">
							</a>
						</div>
					</div>
				</div>
				<div id="zalo-vr" class="button-contact">
					<div class="phone-vr">
						<div class="phone-vr-circle-fill"></div>
						<div class="phone-vr-img-circle">
							<a target="_blank" href="https://zalo.me/<?php echo $zalo; ?>">				
								<img alt="Zalo" src="https://sachtienganh.kimnhungtoeic.com/wp-content/plugins/button-contact-vr/img/zalo.png">
							</a>
						</div>
					</div>
				</div>
				<div id="phone-vr" class="button-contact">
					<div class="phone-vr">
						<div class="phone-vr-circle-fill"></div>
						<div class="phone-vr-img-circle">
							<div class="phone-vr-img-circle">
                                <span  class="alo-ph-text">Hotline: <?php echo $so_dien_thoai; ?></span>
                                <a href="tel:<?php echo $so_dien_thoai; ?>">                
                                    <img alt="Phone" src="https://sachtienganh.kimnhungtoeic.com/wp-content/plugins/button-contact-vr/img/phone.png">
                                </a>
                            </div>

                        </div>
						</div>
				</div>
				<div id="go-to-top-vr" class="button-contact">
					<button id="goToTop"><i class="fa fa-arrow-up"></i></button>
				</div>
			</div>

    <?php
}
