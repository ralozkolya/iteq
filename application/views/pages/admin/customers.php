<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('elements/admin/head'); ?>
	<link rel="stylesheet" href="<?php echo static_url('css/admin/customers.css?v='.V); ?>">
	<script src="<?php echo static_url('js/admin/customers.js?v='.V); ?>"></script>
</head>
<body>
	<?php $this->load->view('elements/admin/sidebar'); ?>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<h1><?php echo lang('customers'); ?></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('elements/messages'); ?>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-xs-12">
					<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 table-responsive">
					<table class="table table-striped">
						<tr>
							<th><?php echo lang('first_name'); ?></th>
							<th><?php echo lang('last_name'); ?></th>
							<th><?php echo lang('personal_number'); ?></th>
							<th><?php echo lang('email'); ?></th>
							<th><?php echo lang('phone'); ?></th>
							<th><?php echo lang('registered'); ?></th>
						</tr>
						<?php foreach($customers as $c): ?>
							<tr class="clickable" data-href="<?php echo base_url('admin/customer/'.$c->id); ?>">
								<td><?php echo $c->first_name; ?></td>
								<td><?php echo $c->last_name; ?></td>
								<td><?php echo $c->personal_number; ?></td>
								<td><?php echo $c->email; ?></td>
								<td><?php echo $c->phone; ?></td>
								<td><?php
									$date = date('H:i d-M-Y', strtotime($c->modified));
									echo $date;
								?></td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>