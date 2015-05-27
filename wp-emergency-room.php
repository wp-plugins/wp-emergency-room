<?php
/*
	Plugin Name: WP Emergency Room (Help & Support)
	Description: WP Emergency Room (E.R) makes it easy for any webmaster or site owner to get help from curated WordPress support experts (directly from your dashboard) - for all your WP related fixes and tasks. Having a problem with your site? Simply activate this plugin, then click the WPER HELP button (seen in the top right of your dashboard), and ask us for help. 
	Version: 1.2
	Author: WP Emergency Room
	Author URI: http://WPEmergencyRoom.com
*/

/*
  Copyright 2015  Rynaldo Stoltz | WP Emergency Room (email : queries@wpemergencyroom.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

function wper_admin_init() {
	wp_register_script('wper-tab-slide-out', plugins_url( 'js/jquery.tabSlideOut.v1.3.js', __FILE__ ));
	wp_register_style('wper-styling', plugins_url( 'css/style.css', __FILE__ ));
	wp_enqueue_script('wper-tab-slide-out');
	wp_enqueue_style('wper-styling');
}

add_action( 'admin_init', 'wper_admin_init' );

function wper_msg() {
	if(isset($_POST['wper_msg_submit'])) {
		$message .= 'Name : ' . $_POST['wper_msg_name'] . '<br />';
		$message .= 'Email : ' . $_POST['wper_msg_email'] . '<br />';
		$message .= 'Subject : ' . $_POST['wper_msg_sub'] . '<br />';
		$message .= 'Message : ' . $_POST['wper_msg_body'] . '<br />';
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
	    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	if(wp_mail ( 'queries@wpemergencyroom.com' , 'WordPress Emergency Room Support Query' , $message, $headers )) {
		?>
			<div class="updated">
				<p>Thank you for contacting us with your support request. One of our WP E.R surgeons will be in touch with you shortly. Please keep an eye on your mailbox</p>
			</div>
			<?php
		} else {
			?>
			<div class="updated">
				<p>It appears that your WP settings have blocked your support request from reaching us. Please email us directly at queries@wpemergencyroom.com so that we can assist you</p>
			</div>
			<?php
		}

	}
}

add_action( 'admin_notices', 'wper_msg' );

function wper_admin_footer() {
	
	echo '<div class="slide-out-div"><a class="handle" href="#">Content</a>
			<div class="wper-contact-form-wrap">
				<div class="contact-form-title"><u>WP EMERGENCY ROOM SUPPORT</u></div>
		<p>Having problems with your site ? Do you have a WordPress issue/error or task that you need help with ? Ask Us ! <br /><br />WP E.R gives you 24/7 access to your own personal WordPress support team for any small WordPress related fixes and tasks - directly from your dashboard !</p>
		<hr />
		<div class="contact-form-content">
			<form method="post">
				<p>Name<br /><input type="text" name="wper_msg_name" value="" /></p>
				<p>Email<br /><input type="text" name="wper_msg_email" value="" /></p>
				<p>Subject<br /><input type="text" name="wper_msg_sub" value="" /></p>
				<p>The Problem (how can we help)<br /><textarea name="wper_msg_body" rows="2" cols="40"></textarea></p>
				<p><input type="submit" name="wper_msg_submit" value="Help Me" /></p><br />
				<font color="red"><i>PLEASE NOTE : This is a paid service that is made available to your from <a href="http://wpemergencyroom.com/">WP Emergency Room</a> - Your direct lifeline to awesome support !</i></font></a>
				</form>
		</div>
			</div>
		</div>';
?>
<script>
jQuery(function(){
	jQuery('.slide-out-div').tabSlideOut({
		tabHandle: '.handle',
		pathToTabImage: '<?php echo plugins_url( 'images/wper.png', __FILE__ ); ?>',
		imageHeight: '220px',
		imageWidth: '50px',
		tabLocation: 'right',
		speed: 300,
		action: 'click',
		topPos: '28px',
		leftPos: '20px',
		fixedPosition: true
	});
});
</script>
<?php

}
add_action('admin_footer', 'wper_admin_footer');

?>