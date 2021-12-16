<?php

use Smartsupp\Auth\Api;


/**
 * Smartsupp Live Chat.
 *
 * @package   Smartsupp_Admin
 * @author    Smartsupp <vladimir@smartsupp.com>
 * @license   GPL-2.0+
 * @link      http://www.smartsupp.com
 * @copyright 2014 smartsupp.com
 */
class Smartsupp_Admin
{

	const OPTION_NAME = 'smartsupp';

	/**
	 * @var $this
	 */
	protected static $instance = NULL;


	private function __construct()
	{
		$plugin = Smartsupp::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		add_action('admin_menu', array($this, 'addMenuItems'));
		add_action('admin_init', array($this, 'performAction'));

		$plugin_basename = plugin_basename(plugin_dir_path(realpath(dirname(__FILE__))) . $this->plugin_slug . '.php');
		add_filter('plugin_action_links_' . $plugin_basename, function ($links) use ($plugin) {
			array_unshift($links, '<a href="options-general.php?page=' . ($plugin->get_plugin_slug()) . '">Settings</a>');
			return $links;
		});
	}

	public static function get_instance()
	{
		if (NULL == self::$instance) {
			self::$instance = new self;
		}
		return self::$instance;
	}


	public static function install()
	{
		global $wp_version;

		$checks = array(
			'Your Wordpress version is not compatible with Smartsupp plugin which requires at least version 3.0. Please update your Wordpress or insert Smartsupp chat code into your website manually (you will find the chat code in the email we have sent you upon registration)' => version_compare($wp_version, '3.0', '<'),
			'This plugin requires at least PHP version 5.3.2, your version: ' . PHP_VERSION . '. Please ask your hosting company to bring your PHP version up to date.' => version_compare(PHP_VERSION, '5.3.2', '<'),
			'This plugin requires PHP extension \'curl\' installed and enbaled.' => !function_exists('curl_init'),
			'This plugin requires PHP extension \'json\' installed and enbaled.' => !function_exists('json_decode'),
		);

		foreach ($checks as $message => $disable) {
			if ($disable) {
				deactivate_plugins(basename(__FILE__));
				wp_die($message);
			}
		}

		update_option(self::OPTION_NAME, array(
			'active' => FALSE,
			'chat-id' => NULL,
			'email' => NULL,
			'optional-code' => NULL,
		));
	}


	public function addMenuItems()
	{
		add_options_page(
			__('Smartsupp Live Chat - Settings', 'smartsupp-live-chat'),
			__('Smartsupp Live Chat', 'smartsupp-live-chat'),
			'manage_options',
			$this->plugin_slug,
			array($this, 'renderAdminPage')
		);

		add_menu_page(
			__('Smartsupp Live Chat - Settings', 'smartsupp-live-chat'),
			__('Smartsupp', 'smartsupp-live-chat'),
			'manage_options',
			$this->plugin_slug,
			array($this, 'renderAdminPage'),
			plugins_url('images/icon-20x20.png', dirname(__FILE__))
		);

	}


	public function performAction()
	{
		if (!isset($_GET['ssaction'])) {
			return;
		}

		$formAction = $message = $email = $marketingConsent = $termsConsent = NULL;
		$action = (string) $_GET['ssaction'];
		switch ($action) {
			case 'login':
			case 'register':
				$formAction = $action;
				$api = new Api;
				$data = array(
					'email' => $_POST['email'],
					'password' => $_POST['password'],
					'consentTerms' => 1,
					'consentMarketing' => 1,
                    'platform' => 'WP ' . get_bloginfo('version'),
				);
				try {
					$response = $formAction === 'login' ? $api->login($data) : $api->create($data + array('partnerKey' => 'k717wrqdi5'));

					if (isset($response['error'])) {
						$message = $response['message'];
						$email = $_POST['email'];
					} else {
						$this->activate($response['account']['key'], $_POST['email']);
					}
				} catch (Exception $e) {
					$message = $e->getMessage();
					$email = $_POST['email'];
					$marketingConsent = 1;
                    $termsConsent = 1;
				}
				break;
			case 'update':
				$message = 'Custom code was updated.';
				$this->updateOptions(array(
					'optional-code' => strip_tags($_POST['code']),
				));
				break;
			case 'disable':
				$this->deactivate();
				break;
			default:
				$message = 'Invalid action';
				break;
		}
		$this->renderAdminPage($message, $formAction, $email, $marketingConsent, $termsConsent);
		exit;
	}


	public function renderAdminPage($message = NULL, $formAction = NULL, $email = NULL, $marketingConsent = NULL, $termsConsent = NULL)
	{
        $this->render('views/admin.php', array(
			'domain' => $this->plugin_slug,
			'customers' => $this->getCustomers(),
			'features' => $this->getFeatures(),
			'options' => $this->getOptions(),
			'message' => (string) $message,
			'formAction' => $formAction,
			'email' => $email,
			'marketingConsent' => $marketingConsent,
            'termsConsent' => $termsConsent,
		));
	}


	private function render($template, $vars = array())
	{
		call_user_func_array(function () use ($template, $vars) {
			extract($vars);
			include $template;
		}, array());
	}

	private function getFeatures()
	{
		$pluginUrl = $this->getPluginUrl();
		return
		'<section class="features">' .
			'<div class="features__container">' .
				'<div class="features__item">' .
					'<span class="features__header">' .
						__('MULTICHANNEL', 'smartsupp-live-chat', 'smartsupp-live-chat') .
					'</span>' .
					'<img src="' . $pluginUrl . '/images/multichannel-fb.png">' .
					'<h2 class="features__item-title">' .
						__('Respond to customers\' chats and emails from one place', 'smartsupp-live-chat') .
					'</h2>' .
				'</div>' .
				'<div class="features__item">' .
					'<span class="features__header">' .
						__('CHAT BOT', 'smartsupp-live-chat', 'smartsupp-live-chat') .
					'</span>' .
					'<img src="' . $pluginUrl . '/images/chatbot.png">' .
					'<h2 class="features__item-title">' .
						__('Engage your visitors with automated chat bot', 'smartsupp-live-chat') .
					'</h2>' .
				'</div>' .
				'<div class="features__item">' .
					'<span class="features__header">' .
						__('MOBILE APP', 'smartsupp-live-chat', 'smartsupp-live-chat') .
					'</span>' .
					'<img src="' . $pluginUrl . '/images/mobile.png">' .
					'<h2 class="features__item-title">' .
						__('Chat with customers on the go with app for iOS & Android', 'smartsupp-live-chat') .
					'</h2>' .
				'</div>' .
			'</div>' .
			'<div class="features__all">' .
				'<a href="https://smartsupp.com" target="_blank" class="btn btn--link btn--arrow">' .
					__('Explore All Features on our website', 'smartsupp-live-chat') .
				'</a>' .
			'</div>' .
		'</section>';
	}

	private function getCustomers()
	{
		$pluginUrl = $this->getPluginUrl();
		return
		'<section class="clients">' .
			'<div class="clients__container">' .
				'<div class="clients__pretitle">' .
					__('POPULAR CHAT SOLUTION OF EUROPEAN WEBSHOPS AND WEBSITES', 'smartsupp-live-chat') .
				'</div>' .
				'<h2 class="clients__title">' .
					__('Join the 338 445 companies and freelancers relying on Smartsupp', 'smartsupp-live-chat') .
				'</h2>' .
				'<div class="clients__logos">' .
					'<img src="' . $pluginUrl . '/images/insportline.png" alt="insportline" />' .
					'<img src="' . $pluginUrl . '/images/redfox.png" alt="redfox" />' .
					'<img src="' . $pluginUrl . '/images/motorgarten.png" alt="motorgarten" />' .
					'<img src="' . $pluginUrl . '/images/travelking.png" alt="travelking" />' .
			'</div>' .
		'</section>';
	}


	private function activate($chatId, $email)
	{
		$this->updateOptions(array(
			'active' => TRUE,
			'chat-id' => (string) $chatId,
			'email' => (string) $email,
		));
	}


	private function deactivate()
	{
		$this->updateOptions(array(
			'active' => FALSE,
			'chat-id' => NULL,
			'email' => NULL
		));
	}


	private function updateOptions(array $options)
	{
		$current = $this->getOptions();
		foreach ($options as $key => $option) {
			$current[$key] = $option;
		}
		update_option(self::OPTION_NAME, $current);
	}


	/**
	 * @return array
	 */
	private function getOptions()
	{
		return get_option(self::OPTION_NAME);
	}


	/**
	 * @return string
	 */
	private function getPluginUrl()
	{
		return plugins_url('', __DIR__);
	}


	/**
	 * @internal This method is intended just for static analysis of translations
	 */
	private function getMessages()
	{
		return array(
			__('Email does not exist', 'smartsupp-live-chat'),
			__('Invalid password', 'smartsupp-live-chat'),
			__('Email is required', 'smartsupp-live-chat'),
			__('Email already exists', 'smartsupp-live-chat'),
			__('Password is too short. Minimal length is 6 characters.', 'smartsupp-live-chat'),
			__('Custom code was updated.', 'smartsupp-live-chat'),
			__('Invalid action', 'smartsupp-live-chat'),
		);
	}

}
