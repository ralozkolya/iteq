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
					<h1><?php echo lang('orders'); ?></h1>
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
							<th><?php echo lang('name'); ?></th>
							<th><?php echo lang('address'); ?></th>
							<th><?php echo lang('description'); ?></th>
							<th><?php echo lang('date'); ?></th>
							<th><?php echo lang('sum'); ?></th>
							<th><?php echo lang('status'); ?></th>
						</tr>
						<?php foreach($orders as $o): ?>
							<?php
								switch($o->status) {
									case PENDING:
										$status = lang('pending');
										$class = '';
										break;

									case COMPLETED:
										$status = lang('completed');
										$class = 'text-success bg-success';
										break;

									default:
										$status = lang('unexpected_error');
										$class = 'text-danger bg-danger';
								}
							?>
							<tr>
								<td>
									<a href="<?php echo base_url('admin/customer/'.$o->id); ?>">
										<?php echo $o->first_name.' '.$o->last_name; ?>
									</a>
								</td>
								<td><?php echo $o->address; ?></td>
								<td><?php echo $o->description; ?></td>
								<td><?php
									$date = date('H:i d-M-Y', strtotime($o->modified));
									echo $date;
								?></td>
								<td><?php echo $o->amount.' '.lang('gel'); ?></td>
								<td class="<?php echo $class; ?>"><?php echo $status; ?></td>
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