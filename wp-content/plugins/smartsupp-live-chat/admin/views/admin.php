<?php

$pluginUrl = plugins_url('', dirname(__DIR__));

echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700">' .
	'<link rel="stylesheet" property="stylesheet" type="text/css" href="' . $pluginUrl . '/assets/style.css" />';

?><div class="wrap" id="content">
	<?php if ($options['active']) { ?>
		<div class="alert alert-warning gift">
			<img src="<?= $pluginUrl ?>/images/gift.svg">
			<span>
				<?= __('Give us review on Wordpress.org and get 10€. <a href="https://www.smartsupp.com/help/give-us-review-wordpress-org/" target="_blank">Read more</a>', 'smartsupp-live-chat'); ?>
			</span>
		</div>
		<div class="active">
			<header class="header">
				<img src="<?= $pluginUrl ?>/images/logo.png" alt="smartsupp logo" class="header__logo" />
				<nav class="hide--up-md">
					<div class="header-user">
						<img src="<?= $pluginUrl ?>/images/avatar-grey.png" alt="" class="header-user__avatar">
						<span class="header-user__email">
							<?= isset($options['email']) ? $options['email'] : '' ?>
						</span>
						<a href="javascript: void(0);" class="js-action-disable btn btn--sm btn-center">
							<?= __('Deactivate Chat', 'smartsupp-live-chat') ?>
						</a>
					</div>
				</nav>
				<div class="navbar-toggle">
					<div class="line"></div>
					<div class="line"></div>
					<div class="line"></div>
				</div>
			</header>

			<main class="main main--all-set" role="main">
				<div class="main__left">
					<div class="main-all-set">
						<h1 class="main-all-set__h1">
							<?= __('All set and running', 'smartsupp-live-chat') ?>
						</h1>
						<p class="main-all-set__text">
							<?= __('Congratulations! Smartsupp live chat is already visible on your website.', 'smartsupp-live-chat') ?>
						</p>
						<a href="https://dashboard.smartsupp.com?utm_source=Wordpress&utm_medium=integration&utm_campaign=link" target="_blank" class="btn btn--primary btn--arrow">
							<?= __('Chat with your visitors', 'smartsupp-live-chat') ?>
						</a>
						<p class="main-all-set__bottom-text">
							<?= __('or <a href="https://app.smartsupp.com/app/settings/chatbox/text?utm_source=Wordpress&utm_medium=integration&utm_campaign=link" target="_blank">Set up</a> chat box design first', 'smartsupp-live-chat') ?>
						</p>
					</div>
				</div>
				<div class="main__right">
					<img src="<?= $pluginUrl ?>/images/all-done.png">
				</div>
			</main>

			<section class="advanced">
				<div class="advanced__header collapse<?php if (!$options['optional-code']) { ?> closed<?php } ?>">
					<span class="advanced__caret"></span> <?= __('Advanced settings', 'smartsupp-live-chat') ?>
				</div>
				<div class="advanced__content"<?php if (!$options['optional-code']) { ?> style="display: none;"<?php } ?>>
					<p class="advanced__text">
						<?= __('Don\'t put the chat code here! This box is for (optional) advanced customizations via <a href="https://developers.smartsupp.com?utm_source=Wordpress&utm_medium=integration&utm_campaign=link" target="_blank">Smartsupp API</a>', 'smartsupp-live-chat') ?>
					</p>
					<form action="" method="post" id="settingsForm" class="js-code-form" autocomplete="off">
						<textarea name="code" id="textAreaSettings" class="input input--area" cols="30" rows="10"><?= stripcslashes($options['optional-code']); ?></textarea>
						<div class="advanced__bottom">
							<button type="submit" name="_submit" class="btn btn--sm">
								<?= __('Save changes', 'smartsupp-live-chat') ?>
							</button>

							<div class="saved">
								<?php if ($message) { ?>
									<img src="<?= $pluginUrl ?>/images/all-changes-saved.png" class="saved__img">
									<p class="saved__text">
										<?= __($message, 'smartsupp-live-chat') ?>
									</p>
								<?php } ?>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
	<?php } else { ?>
		<div class="">
			<header class="header">
				<img src="<?= $pluginUrl ?>/images/logo.png" alt="smartsupp logo" class="header__logo" />
				<nav class="hide--up-md">
					<div class="header-user">
						<span class="header-user__email" data-toggle-form data-multitext data-register="<?= __('Already have an account?', 'smartsupp-live-chat') ?>" data-login="<?= __('Not a Smartsupp user yet?', 'smartsupp-live-chat') ?>">
							<?= __($formAction === 'login' ? 'Not a Smartsupp user yet?' : 'Already have an account?', 'smartsupp-live-chat') ?>
						</span>
						<a href="javascript: void(0);" class="btn btn--sm" data-toggle-form data-multitext data-register="<?= __('Log in', 'smartsupp-live-chat') ?>" data-login="<?= __('Create a free account', 'smartsupp-live-chat') ?>">
							<?= __($formAction === 'login' ? 'Create a free account' : 'Log in', 'smartsupp-live-chat') ?>
						</a>
					</div>
				</nav>
				<a href="javascript: void(0);" class="navbar-toggle">
					<div class="line"></div>
					<div class="line"></div>
					<div class="line"></div>
				</a>
			</header>

			<main class="main" role="main" id="connect">
				<div class="main__left">
					<div class="main-form">
						<h1 class="main-form__h1" data-multitext data-login="<?= __('Log in', 'smartsupp-live-chat') ?>" data-register="<?= __('Create a free account', 'smartsupp-live-chat') ?>">
							<?= $formAction === 'login' ? __('Log in', 'smartsupp-live-chat') : __('Create a free account', 'smartsupp-live-chat') ?>
						</h1>
						<p class="main-form__top-text<?= $formAction ? (' js-' . $formAction . '-form') : '' ?>" data-toggle-class>
							<?= __('Start personal conversation with your visitors today.', 'smartsupp-live-chat') ?>
						</p>
						<form action="" method="post" id="signUpForm" class="form-horizontal<?= $formAction ? (' js-' . $formAction . '-form') : ' js-register-form' ?>" data-toggle-class autocomplete="off">
							<div class="alerts">
								<?php if ($message) { ?>
									<div class="alert alert-danger js-clear">
										<?= __($message, 'smartsupp-live-chat') ?>
									</div>
								<?php } ?>
							</div>
							<input type="email" class="input" placeholder="<?= __('Email:', 'smartsupp-live-chat') ?>" name="email" id="frm-signUp-form-email" required="" value="<?= isset($email) ? $email : '' ?>">
							<input type="password" class="input" placeholder="<?= __('Password:', 'smartsupp-live-chat') ?>" name="password" autocomplete="off" id="frm-signUp-form-password" required="">
							<div class="loader"></div>
							<button type="submit" name="_submit" class="btn btn--primary btn--arrow btn--all-width" data-multitext data-login="<?= __('Log in', 'smartsupp-live-chat') ?>" data-register="<?= __('Create a free account', 'smartsupp-live-chat') ?>">
								<?= $formAction === 'login' ? __('Log in', 'smartsupp-live-chat') : __('Create a free account', 'smartsupp-live-chat') ?>
							</button>
							<p class="main-form__bottom-text<?= $formAction ? (' js-' . $formAction . '-form') : ' js-register-form' ?>" data-toggle-class>
								<span class="js-login">
									<?= __('<a href="https://app.smartsupp.com/app/sign/reset" target="_blank">I forgot my password</a>', 'smartsupp-live-chat') ?>
								</span>
								<span class="js-register">
									<?= __('By signing up, you agree with <a href="https://www.smartsupp.com/terms" target="_blank">Terms</a> and <a href="https://www.smartsupp.com/dpa" target="_blank">DPA</a>', 'smartsupp-live-chat') ?>
								</span>
							</p>
						</form>
					</div>
				</div>

				<div class="main__right">
					<img src="<?= $pluginUrl ?>/images/tablet-screen.png">
				</div>

			</main>

			<?= $features ?>
			<?= $customers ?>

		</div>
	<?php } ?>

</div>

<?php echo '<script src="' . $pluginUrl . '/assets/script.js" />'; ?>
