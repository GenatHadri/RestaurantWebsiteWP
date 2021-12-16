<?php
function wp_insert_form_accordion_tabs_adcode($control, $identifier, $location) {
	echo '<h3>Ad Code</h3>';
	echo '<div>';
		$abtestingMode = get_option('wp_insert_abtesting_mode');
		
		$control->add_control(array('type' => 'textarea', 'style' => 'height: 220px;', 'optionName' => 'primary_ad_code'));	
		if($location == 'inpostads') {
			$control->set_HTML($control->HTML.'<p>Get more advertisers to bid on your ad inventory without compromising web vitals. Get access to 30+ partners with <a href="https://www.adpushup.com/lp/wp-insert/">AdPushup</a>.</p>');
		}
		$control->create_section('Ad Code (Primary Network)');
		echo $control->HTML;
		$control->clear_controls();
		
		$control->add_control(array('type' => 'textarea', 'style' => 'height: 220px;', 'optionName' => 'secondary_ad_code'));
		$control->create_section('Ad Code (Secondary Network)');
		if($abtestingMode != '2' && $abtestingMode != '3') {	
			$control->set_HTML('<div style="display: none;">'.$control->HTML.'</div>');
		}
		echo $control->HTML;
		$control->clear_controls();
		
		$control->add_control(array('type' => 'textarea', 'style' => 'height: 220px;', 'optionName' => 'tertiary_ad_code'));
		$control->create_section('Ad Code (Tertiary Network)');
		if($abtestingMode != '3') {	
			$control->set_HTML('<div style="display: none;">'.$control->HTML.'</div>');
		}
		echo $control->HTML;
		$control->clear_controls();
	echo '</div>';
	return $control;
}
?>