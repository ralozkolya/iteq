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
					<h1><?php echo $customer->first_name.' '.$customer->last_name; ?></h1>
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
					<p>
						<b><?php echo lang('email'); ?></b>:
						<?php echo $customer->email; ?>
					</p>
					<p>
						<b><?php echo lang('phone'); ?></b>:
						<?php echo $customer->phone; ?>		
					</p>
					<p>
						<b><?php echo lang('personal_number'); ?></b>:
						<?php echo $customer->personal_number; ?>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<h3><?php echo lang('addresses'); ?></h3>
					<?php if(!empty($addresses)): ?>
						<?php foreach($addresses as $a): ?>
							<p><?php echo $a->address.', '.$a->city.', '.$a->zip_code; ?></p>
						<?php endforeach; ?>
					<?php else: ?>
						<h4><?php echo lang('nothing_found'); ?></h4>
					<?php endif; ?>
				</div>
				<div class="col-sm-6">
					<h3><?php echo lang('orders'); ?></h3>
					<?php if(!empty($addresses)): ?>
						<table class="table table-striped">
							<tr>
								<th><?php echo lang('description'); ?></th>
								<th class="text-right"><?php echo lang('sum'); ?></th>
							</tr>
							<?php foreach($orders as $o): ?>
								<tr>
									<td><?php echo $o->description; ?></td>
									<td class="text-right"><?php echo $o->amount.' '.lang('gel'); ?></td>
								</tr>
							<?php endforeach; ?>
						</table>
					<?php else: ?>
						<h4><?php echo lang('nothing_found'); ?></h4>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>