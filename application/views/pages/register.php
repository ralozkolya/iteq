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
						<form id="register-form" class="register-form" method="post">
							<?php
								$name = $this->security->get_csrf_token_name();
								$hash = $this->security->get_csrf_hash();
							?>
							<input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>">
							<div class="form-group">
								<?php echo lang('first_name', 'first_name'); ?>
								<input class="form-control" type="text"
									name="first_name" id="first_name"
									placeholder="<?php echo lang('first_name'); ?>"
									value="<?php echo set_value('first_name'); ?>"
									autofocus required>
							</div>
							<div class="form-group">
								<?php echo lang('last_name', 'last_name'); ?>
								<input class="form-control" type="text"
									name="last_name" id="last_name"
									placeholder="<?php echo lang('last_name'); ?>"
									value="<?php echo set_value('last_name'); ?>"
									required>
							</div>
							<div class="form-group">
								<?php echo lang('personal_number', 'personal_number'); ?>
								<input class="form-control" type="text"
									name="personal_number" id="personal_number"
									placeholder="<?php echo lang('personal_number'); ?>"
									value="<?php echo set_value('personal_number'); ?>"
									required>
							</div>
							<div class="form-group">
								<?php echo lang('email', 'email'); ?>
								<input class="form-control" type="text"
									name="email" id="email"
									placeholder="<?php echo lang('email'); ?>"
									value="<?php echo set_value('email'); ?>"
									required>
							</div>
							<div class="form-group">
								<?php echo lang('phone', 'phone'); ?>
								<input class="form-control" type="text"
									name="phone" id="phone"
									placeholder="<?php echo lang('phone'); ?>"
									value="<?php echo set_value('phone'); ?>"
									required>
							</div>
							<div class="form-group">
								<?php echo lang('password', 'password'); ?>
								<input class="form-control" type="password"
									name="password" id="password"
									placeholder="<?php echo lang('password'); ?>"
									required>
							</div>
							<div class="form-group">
								<?php echo lang('repeat_password', 'repeat_password'); ?></label>
								<input class="form-control" type="password"
									name="repeat_password" id="repeat_password"
									placeholder="<?php echo lang('repeat_password'); ?>"
									required>
							</div>
							<div class="form-group text-center">
								<input class="btn btn-default" type="submit" value="<?php echo lang('register'); ?>">
							</div>
							<div class="text-center">
								<a href="<?php echo locale_url('login'); ?>"><?php echo lang('login'); ?></a>
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