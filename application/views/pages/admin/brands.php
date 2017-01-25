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
					<h1><?php echo lang('brands'); ?></h1>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('elements/messages'); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<h3><?php echo lang('existing_brands'); ?></h3>
					<table class="table table-striped">
						<?php foreach($brands as $b): ?>
							<tr>
								<td><?php echo $b->name; ?></td>
								<td><?php echo lang('priority').': '.$b->priority; ?></td>
								<td class="glyph-container">
									<a href="<?php echo base_url('admin/brand/'.$b->id); ?>">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
								</td>
								<td class="glyph-container">
									<a href="<?php echo base_url('admin/delete/Brand/'.$b->id); ?>" class="unstyled delete">
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
				<div class="col-sm-6">
					<h3><?php echo lang('add_brand'); ?></h3>
					<form method="post" enctype="multipart/form-data">
						<div class="form-group">
							<?php echo lang('image_pinned', 'image'); ?>
							<input class="form-control" type="file" name="image" id="image">
						</div>
						<div class="form-group">
							<?php echo lang('en_name', 'en_name'); ?>
							<input
								class="form-control"
								name="en_name"
								id="en_name"
								value="<?php echo set_value('en_name'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('ka_name', 'ka_name'); ?>
							<input
								class="form-control"
								name="ka_name"
								id="ka_name"
								value="<?php echo set_value('ka_name'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('ru_name', 'ru_name'); ?>
							<input
								class="form-control"
								name="ru_name"
								id="ru_name"
								value="<?php echo set_value('ru_name'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('link', 'link'); ?>
							<input class="form-control" type="text" name="link" id="link" value="<?php echo set_value('link'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('priority_description', 'priority'); ?>
							<input class="form-control" type="number" name="priority" id="priority" value="<?php echo $priority; ?>">
						</div>
						<div class="form-group">
							<input class="btn btn-default" type="submit" value="<?php echo lang('add'); ?>">
						</div>
					</form>
				</div>
			</div>	
		</div>
	</div>
</body>
</html>