<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('elements/admin/head'); ?>
	
</head>
<body>
	<?php $this->load->view('elements/admin/sidebar'); ?>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<h1><?php echo lang('user'); ?></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('elements/messages'); ?>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<form method="post">
						<div class="form-group">
							<?php echo lang('password', 'password'); ?>
							<input class="form-control" type="password" name="password" id="password">
						</div>
						<div class="form-group">
							<?php echo lang('repeat_password', 'repeat_password'); ?>
							<input class="form-control" type="password" name="repeat_password" id="repeat_password">
						</div>
						<div class="form-group">
							<input class="btn btn-default" type="submit" value="<?php echo lang('change') ?>">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>