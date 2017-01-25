<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('elements/admin/head'); ?>
	<link rel="stylesheet" href="<?php echo static_url('css/admin/banners.css?v='.V); ?>">
</head>
<body>
	<?php $this->load->view('elements/admin/sidebar'); ?>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<h1><?php echo lang('banners'); ?></h1>
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
						<input type="hidden" name="id" value="<?php echo $banner->id; ?>">
						<div class="form-group">
							<?php echo lang('link', 'link'); ?>
							<input class="form-control" type="text" name="link" id="link" value="<?php echo $banner->link; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('priority_description', 'priority'); ?>
							<input class="form-control" type="number" name="priority" id="priority" value="<?php echo $banner->priority; ?>">
						</div>
						<div class="form-group">
							<input type="checkbox" name="blank" id="blank" value="1"
								<?php if($banner->blank) echo 'checked'; ?>>
							<?php echo lang('blank', 'blank'); ?>
						</div>
						<div class="form-group">
							<input class="btn btn-default" type="submit" value="<?php echo lang('change'); ?>">
							<a class="btn btn-primary" href="<?php echo base_url('admin/banners'); ?>"><?php echo lang('back'); ?></a>
						</div>
					</form>
				</div>
				<div class="col-sm-6">
					<img alt="<?php echo $banner->image; ?>" src="<?php echo static_url('uploads/banners/'.$banner->image); ?>">
				</div>
			</div>	
		</div>
	</div>
</body>
</html>