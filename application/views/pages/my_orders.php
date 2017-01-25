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
					<div class="col-xs-12 table-responsive">
						<?php if(!empty($orders)): ?>
							<table class="table table-stripped">
								<tr>
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
						<?php else: ?>
							<h3><?php echo lang('no_orders'); ?></h3>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view('elements/footer'); ?>
	</div>
</body>
</html>