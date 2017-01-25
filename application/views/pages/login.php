<!DOCTYPE html>
<html lang="<?php echo get_lang_code(get_lang()); ?>">
<head>
	<?php $this->load->view('elements/head'); ?>

	<link rel="stylesheet" href="<?php echo static_url('css/register.css?v='.V); ?>">
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('elements/header'); ?>

		<div class="content">
			<div class="container">

				<div class="row">
					<div class="col-xs-12">
						<?php $this->load->view('elements/messages'); ?>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<form id="login-form" class="register-form" method="post">
							<?php
								$name = $this->security->get_csrf_token_name();
								$hash = $this->security->get_csrf_hash();
							?>
							<input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>">
							<div class="form-group">
								<input class="form-control" type="text" name="email"
									placeholder="<?php echo lang('email'); ?>"
									autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" type="password" name="password"
									placeholder="<?php echo lang('password'); ?>">
							</div>
							<div>
								<a href="<?php echo locale_url('recover_password'); ?>"><?php echo lang('forgot_password'); ?></a>
							</div>
							<div class="form-group text-center">
								<input class="btn btn-default" type="submit" value="<?php echo lang('login'); ?>">
							</div>
							<div class="text-center">
								<a href="<?php echo locale_url('register'); ?>"><?php echo lang('register'); ?></a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view('elements/footer'); ?>
	</div>
</body>
</html>