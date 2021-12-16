<?php
/* Begin Add Card in Admin Panel */
add_action('wp_insert_plugin_card', 'wp_insert_adpushup_plugin_card', 10);
function wp_insert_adpushup_plugin_card() {
	echo '<div class="plugin-card adpushup-card">';
		echo '<div class="plugin-card-top">';
			echo '<div class="plugin-card-top-header">';
				echo '<h4>AdPushup</h4>';
			echo '</div>';
			echo '<div class="plugin-card-top-content">';
				echo '<a style="display: block; margin: 0 0 10px;text-align: center;" target="_blank" href="https://www.adpushup.com/lp/wp-insert/"><img style="max-width: 100%; height: 280px;" src= "'.plugins_url('/images/adpushup-336x280-blue.png', __FILE__).'" /></a>';
			echo '</div>';
		echo '</div>';
		echo '<div class="plugin-card-bottom">';
			echo '<p>Get more advertisers to bid on your ad inventory without compromising web vitals. Get access to 30+ partners with <a href="https://www.adpushup.com/lp/wp-insert/">AdPushup</a>.</p>';
		echo '</div>';
	echo '</div>';
}
/* End Add Card in Admin Panel */
?>