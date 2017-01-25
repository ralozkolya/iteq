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
					<h3><?php echo lang('existing_pinned_links'); ?></h3>
					<table class="table table-striped">
						<?php foreach($pinned_links as $p): ?>
							<tr>
								<td class="thumb">
									<img alt="<?php echo $p->image; ?>" src="<?php echo static_url('uploads/pinned_links/thumbs/'.$p->image); ?>">
								</td>
								<td><?php echo lang('priority').': '.$p->priority; ?></td>
								<td class="glyph-container">
									<a href="<?php echo base_url('admin/pinned_link/'.$p->id); ?>">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
								</td>
								<td class="glyph-container">
									<a href="<?php echo base_url('admin/delete/Pinned_link/'.$p->id); ?>" class="unstyled delete">
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
				<div class="col-sm-6">
					<h3><?php echo lang('add_pinned_link'); ?></h3>
					<form method="post" enctype="multipart/form-data">
						<div class="form-group">
							<?php echo lang('image_pinned', 'image'); ?>
							<input class="form-control" type="file" name="image" id="image">
						</div>
						<div class="form-group">
							<?php echo lang('en_description', 'en_description'); ?>
							<textarea
								class="form-control"
								name="en_description"
								id="en_description"><?php echo set_value('en_description'); ?></textarea>
						</div>
						<div class="form-group">
							<?php echo lang('ka_description', 'ka_description'); ?>
							<textarea
								class="form-control"
								name="ka_description"
								id="ka_description"><?php echo set_value('ka_description'); ?></textarea>
						</div>
						<div class="form-group">
							<?php echo lang('ru_description', 'ru_description'); ?>
							<textarea
								class="form-control"
								name="ru_description"
								id="ru_description"><?php echo set_value('ru_description'); ?></textarea>
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
							<input type="checkbox" name="blank" id="blank" value="1" <?php echo set_checkbox('blank', 1); ?>>
							<?php echo lang('blank', 'blank'); ?>
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