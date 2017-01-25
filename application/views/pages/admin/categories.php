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
					<h1><?php echo lang('categories'); ?></h1>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('elements/messages'); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<h3><?php echo lang('existing_categories'); ?></h3>
					<?php if(!empty($categories)): ?>
						<table class="table table-striped">
							<?php foreach($categories as $c): ?>
								<tr>
									<td><?php echo $c->name; ?></td>
									<td class="glyph-container">
										<a href="<?php echo base_url('admin/category/'.$c->id); ?>">
											<span class="glyphicon glyphicon-edit"></span>
										</a>
									</td>
									<td class="glyph-container">
										<a href="<?php echo base_url('admin/delete/Category/'.$c->id); ?>">
											<span class="delete glyphicon glyphicon-remove"></span>
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</table>
					<?php else: ?>
						<h4><?php echo lang('nothing_found'); ?></h4>
					<?php endif; ?>
				</div>

				<div class="col-sm-6">
					<h3><?php echo lang('add_category') ?></h3>
					<form method="post">
						<?php
							$name = $this->security->get_csrf_token_name();
							$hash = $this->security->get_csrf_hash();
						?>
						<input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>">
						<div class="form-group">
							<?php echo lang('en_name', 'en_name'); ?>
							<input type="text" class="form-control"
								name="en_name"
								id="en_name"
								placeholder="<?php echo lang('en_name'); ?>"
								value="<?php echo set_value('en_name'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('ka_name', 'ka_name'); ?>
							<input type="text" class="form-control"
								name="ka_name"
								id="ka_name"
								placeholder="<?php echo lang('ka_name'); ?>"
								value="<?php echo set_value('ka_name'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('ru_name', 'ru_name'); ?>
							<input type="text" class="form-control"
								name="ru_name"
								id="ru_name"
								placeholder="<?php echo lang('ru_name'); ?>"
								value="<?php echo set_value('ru_name'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('parent', 'parent'); ?>
							<select class="form-control" name="parent" id="parent">
								<option value="0"><?php echo lang('top_level'); ?></option>
								<?php foreach($categories as $c): ?>
									<option value="<?php echo $c->id; ?>">
										<?php echo $c->name; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-default" value="<?php echo lang('add'); ?>">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>