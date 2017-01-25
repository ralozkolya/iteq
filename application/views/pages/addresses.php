<!DOCTYPE html>
<html lang="<?php echo get_lang_code(get_lang()); ?>">
<head>
	<?php $this->load->view('elements/head'); ?>
	<link rel="stylesheet" href="<?php echo static_url('css/profile.css?v='.V); ?>">
	<link rel="stylesheet" href="<?php echo static_url('css/addresses.css?v='.V); ?>">
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
				<br><br>
				<div class="row">
					<div class="col-sm-6">
						<?php if(!empty($addresses)): ?>
							<?php foreach($addresses as $a): ?>
								<div class="address">
									<b><?php echo $a->address.', '.$a->zip_code.', '.$a->city; ?></b>
									<div class="pull-right">
										<a class="unstyled" href="<?php echo base_url('profile/delete_address/'.$a->id); ?>">
											<span class="glyphicon glyphicon-remove delete"></span>
										</a>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<h4><?php echo lang('no_addresses'); ?></h4>
						<?php endif; ?>
					</div>
					<div class="col-sm-6">
						<hr class="visible-xs">
						<?php $this->load->view('elements/add_address'); ?>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view('elements/footer'); ?>
	</div>
</body>
</html>