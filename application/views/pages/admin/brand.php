<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('elements/admin/head'); ?>
	<link rel="stylesheet" href="<?php echo static_url('css/admin/pinned_links.css?v='.V); ?>">
</head>
<body>
	<?php $this->load->view('elements/admin/sidebar'); ?>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<h1><?php echo $brand->name; ?></h1>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('elements/messages'); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<form method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $brand->id; ?>">
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
								value="<?php echo $brand->en_name; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('ka_name', 'ka_name'); ?>
							<input
								class="form-control"
								name="ka_name"
								id="ka_name"
								value="<?php echo $brand->ka_name; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('ru_name', 'ru_name'); ?>
							<input
								class="form-control"
								name="ru_name"
								id="ru_name"
								value="<?php echo $brand->ru_name; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('link', 'link'); ?>
							<input class="form-control" type="text" name="link" id="link" value="<?php echo $brand->link; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('priority_description', 'priority'); ?>
							<input class="form-control" type="number" name="priority" id="priority" value="<?php echo $brand->priority; ?>">
						</div>
						<div class="form-group">
							<input class="btn btn-default" type="submit" value="<?php echo lang('change'); ?>">
							<a class="btn btn-primary" href="<?php echo base_url('admin/pinned_links'); ?>"><?php echo lang('back'); ?></a>
						</div>
					</form>
				</div>
				<div class="col-sm-6">
					<img alt="<?php $brand->image; ?>" src="<?php echo static_url('uploads/brands/'.$brand->image); ?>">
				</div>
			</div>	
		</div>
	</div>
</body>
</html>