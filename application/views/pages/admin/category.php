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
					<h1><?php echo $category->name; ?></h1>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('elements/messages'); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<div>
						<h3><?php echo lang('edit_category'); ?></h3>
						<form method="post">
							<?php
								$name = $this->security->get_csrf_token_name();
								$hash = $this->security->get_csrf_hash();
							?>
							<input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>">
							<input type="hidden" name="id" value="<?php echo $category->id; ?>">

							<div class="form-group">
								<?php echo lang('en_name', 'en_name'); ?>
								<input class="form-control" type="text"
									name="en_name" id="en_name"
									placeholder="<?php echo lang('en_name'); ?>"
									value="<?php echo $category->en_name; ?>">
							</div>

							<div class="form-group">
								<?php echo lang('ka_name', 'ka_name'); ?>
								<input class="form-control" type="text"
									name="ka_name" id="ka_name"
									placeholder="<?php echo lang('ka_name'); ?>"
									value="<?php echo $category->ka_name; ?>">
							</div>

							<div class="form-group">
								<?php echo lang('ru_name', 'ru_name'); ?>
								<input class="form-control" type="text"
									name="ru_name" id="ru_name"
									placeholder="<?php echo lang('ru_name'); ?>"
									value="<?php echo $category->ru_name; ?>">
							</div>
							<div class="form-group">
								<div class="form-group">
									<input type="submit" class="btn btn-default" value="<?php echo lang('change'); ?>">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="col-sm-6">
					<?php if($category->parent === '0'): ?>
						<div>
							<h3><?php echo lang('existing_subcategories'); ?></h3>
							<?php if(!empty($subcategories)): ?>
								<table class="table table-striped">
									<?php foreach($subcategories as $c): ?>
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
					<?php endif; ?>
					<br>
					<div>
						<h3><?php echo lang('products'); ?></h3>
						<?php if(!empty($products)): ?>
							<table class="table table-striped">
								<?php foreach($products as $p): ?>
									<tr>
										<td><?php echo $p->name; ?></td>
										<td class="glyph-container">
											<a href="<?php echo base_url('admin/product/'.$p->id); ?>">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
										</td>
										<td class="glyph-container">
											<a href="<?php echo base_url('admin/delete/Product/'.$p->id); ?>">
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
				</div>

				<?php if($category->parent === '0'): ?>
					<div class="col-sm-6">
						<br>
						<div>
							<h3><?php echo lang('add_subcategory') ?></h3>
							<form method="post">
								<?php
									$name = $this->security->get_csrf_token_name();
									$hash = $this->security->get_csrf_hash();
								?>
								<input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>">
								<input type="hidden" name="parent" value="<?php echo $category->id; ?>">
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
									<input type="submit" class="btn btn-default" value="<?php echo lang('add'); ?>">
								</div>
							</form>
						<?php endif; ?>
					</div>
				</div>

			</div>	
		</div>
	</div>
</body>
</html>