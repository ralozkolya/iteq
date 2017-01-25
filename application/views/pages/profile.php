<!DOCTYPE html>
<html lang="<?php echo get_lang_code(get_lang()); ?>">
<head>
	<?php $this->load->view('elements/head'); ?>
	<link rel="stylesheet" href="<?php echo static_url('css/profile.css?v='.V); ?>">
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('elements/header'); ?>

		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h1><?php echo lang('profile'); ?></h1>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-xs-12">
						<?php $this->load->view('elements/messages'); ?>
					</div>
				</div>
				<div class="row">
					<?php $this->load->view('elements/profile_menu'); ?>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-6">
						<form method="post">
							<?php
								$name = $this->security->get_csrf_token_name();
								$hash = $this->security->get_csrf_hash();
							?>
							<input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>">
							<div class="form-group">
								<?php echo lang('first_name', 'first_name'); ?>
								<input class="form-control" name="first_name"
									id="first_name" value="<?php echo $user->first_name; ?>">
							</div>
							<div class="form-group">
								<?php echo lang('last_name', 'last_name'); ?>
								<input class="form-control" name="last_name"
									id="last_name" value="<?php echo $user->last_name; ?>">
							</div>
							<div class="form-group">
								<?php echo lang('personal_number', 'personal_number'); ?>
								<input class="form-control" name="personal_number"
									id="personal_number" value="<?php echo $user->personal_number; ?>">
							</div>
							<div class="form-group">
								<?php echo lang('email', 'email'); ?>
								<input class="form-control" name="email"
									id="email" value="<?php echo $user->email; ?>">
							</div>
							<div class="form-group">
								<?php echo lang('phone', 'phone'); ?>
								<input class="form-control" name="phone"
									id="phone" value="<?php echo $user->phone; ?>">
							</div>
							<div class="form-group">
								<input class="btn btn-default" type="submit" value="<?php echo lang('change'); ?>">
							</div>
						</form>
					</div>
					<div class="col-sm-6">
						<form method="post"
							action="<?php echo base_url('profile/change_password'); ?>">
							<div class="form-group">
								<?php echo lang('password', 'password'); ?>
								<input class="form-control" type="password" name="password" id="password" placeholder="<?php echo lang('password'); ?>">
							</div>
							<div class="form-group">
								<?php echo lang('repeat_password', 'repeat_password'); ?>
								<input class="form-control" type="password" name="repeat_password" id="repeat_password" placeholder="<?php echo lang('repeat_password'); ?>">
							</div>
							<div class="form-group">
								<input class="btn btn-default" type="submit" value="<?php echo lang('change'); ?>">
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