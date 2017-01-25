<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('elements/admin/head'); ?>
	<script src="<?php echo static_url('js/admin/pages.js?v='.V); ?>"></script>
</head>
<body>
	<?php $this->load->view('elements/admin/sidebar'); ?>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<h1><?php echo lang('pages'); ?></h1>
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
					<?php echo lang('choose_page', 'choose_page'); ?>
					<select class="form-control" id="choose_page">
						<option></option>
						<?php foreach($pages as $p): ?>
							<option value="<?php echo $p->id; ?>"><?php echo $p->title; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>
	</div>
</body>
</html>