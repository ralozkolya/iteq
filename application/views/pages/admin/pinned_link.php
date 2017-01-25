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
					<h1><?php echo lang('pinned_links'); ?></h1>
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
						<input type="hidden" name="id" value="<?php echo $pinned_link->id; ?>">
						<div class="form-group">
							<?php echo lang('image_pinned', 'image'); ?>
							<input class="form-control" type="file" name="image" id="image">
						</div>
						<div class="form-group">
							<?php echo lang('en_description', 'en_description'); ?>
							<textarea
								class="form-control"
								name="en_description"
								id="en_description"><?php echo $pinned_link->en_description; ?></textarea>
						</div>
						<div class="form-group">
							<?php echo lang('ka_description', 'ka_description'); ?>
							<textarea
								class="form-control"
								name="ka_description"
								id="ka_description"><?php echo $pinned_link->ka_description; ?></textarea>
						</div>
						<div class="form-group">
							<?php echo lang('ru_description', 'ru_description'); ?>
							<textarea
								class="form-control"
								name="ru_description"
								id="ru_description"><?php echo $pinned_link->ru_description; ?></textarea>
						</div>
						<div class="form-group">
							<?php echo lang('link', 'link'); ?>
							<input class="form-control" type="text" name="link" id="link" value="<?php echo $pinned_link->link; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('priority_description', 'priority'); ?>
							<input class="form-control" type="number" name="priority" id="priority" value="<?php echo $pinned_link->priority; ?>">
						</div>
						<div class="form-group">
							<input type="checkbox" name="blank" id="blank" value="1" <?php if($pinned_link->blank) echo 'checked'; ?>>
							<?php echo lang('blank', 'blank'); ?>
						</div>
						<div class="form-group">
							<input class="btn btn-default" type="submit" value="<?php echo lang('change'); ?>">
							<a class="btn btn-primary" href="<?php echo base_url('admin/pinned_links'); ?>"><?php echo lang('back'); ?></a>
						</div>
					</form>
				</div>
				<div class="col-sm-6">
					<img alt="<?php $pinned_link->image; ?>" src="<?php echo static_url('uploads/pinned_links/'.$pinned_link->image); ?>">
				</div>
			</div>	
		</div>
	</div>
</body>
</html>