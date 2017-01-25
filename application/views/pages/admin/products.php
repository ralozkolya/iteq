<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('elements/admin/head'); ?>
	<script src="<?php echo static_url('js/admin/products.js?v='.V); ?>"></script>
</head>
<body>
	<?php $this->load->view('elements/admin/sidebar'); ?>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<h1><?php echo lang('products'); ?></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('elements/messages'); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<h3><?php echo lang('existing_products'); ?></h3>
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

				<div class="col-sm-6">
					<h3><?php echo lang('add_product'); ?></h3>
					<form method="post" enctype="multipart/form-data">
						<?php
							$name = $this->security->get_csrf_token_name();
							$hash = $this->security->get_csrf_hash();
						?>
						<input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>">
						<div class="form-group">
							<?php echo lang('en_name', 'en_name'); ?>
							<input class="form-control" type="text" name="en_name" id="en_name" value="<?php echo set_value('en_name'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('ka_name', 'ka_name'); ?>
							<input class="form-control" type="text" name="ka_name" id="ka_name" value="<?php echo set_value('ka_name'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('ru_name', 'ru_name'); ?>
							<input class="form-control" type="text" name="ru_name" id="ru_name" value="<?php echo set_value('ru_name'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('en_description', 'en_description'); ?>
							<textarea class="form-control cke" name="en_description" id="en_description"><?php echo set_value('en_description'); ?></textarea>
						</div>
						<div class="form-group">
							<?php echo lang('ka_description', 'ka_description'); ?>
							<textarea class="form-control cke" name="ka_description" id="ka_description"><?php echo set_value('ka_description'); ?></textarea>
						</div>
						<div class="form-group">
							<?php echo lang('ru_description', 'ru_description'); ?>
							<textarea class="form-control cke" name="ru_description" id="ru_description"><?php echo set_value('ru_description'); ?></textarea>
						</div>
						<div class="form-group">
							<?php echo lang('brand', 'brand'); ?>
							<input class="form-control" type="text" name="brand" id="brand" value="<?php echo set_value('brand'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('images', 'image'); ?>
							<input class="form-control" type="file" name="images[]" id="image" multiple>
						</div>
						<div class="form-group">
							<?php echo lang('category', 'category'); ?>
							<select class="form-control" name="category" id="category">
								<option value=""><?php echo lang('none'); ?></option>
								<?php $category = set_value('category'); ?>
								<?php foreach($categories as $c): ?>
									<?php if($category !== $c->id): ?>
										<option value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
									<?php else: ?>
										<option value="<?php echo $c->id; ?>" selected><?php echo $c->name; ?></option>
									<?php endif; ?>
									<?php if($c->sub): ?>
										<?php foreach($c->sub as $s): ?>
											<?php if($category !== $s->id): ?>
												<option value="<?php echo $s->id; ?>">-- <?php echo $s->name; ?></option>
											<?php else: ?>
												<option value="<?php echo $s->id; ?>" selected>-- <?php echo $s->name; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<?php echo lang('price', 'price'); ?>
							<input class="form-control" type="number" step="0.01" name="price" id="price" value="<?php echo set_value('price'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('en_price_label', 'en_price_label'); ?>
							<input class="form-control" type="text" 								name="en_price_label" id="en_price_label"
								value="<?php echo set_value('en_price_label'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('ka_price_label', 'ka_price_label'); ?>
							<input class="form-control" type="text" 								name="ka_price_label" id="ka_price_label"
								value="<?php echo set_value('ka_price_label'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('ru_price_label', 'ru_price_label'); ?>
							<input class="form-control" type="text"
								name="ru_price_label" id="ru_price_label"
								value="<?php echo set_value('ru_price_label'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('in_stock', 'in_stock'); ?>
							<input class="form-control" type="number" name="in_stock" id="in_stock" value="<?php echo set_value('in_stock'); ?>">
						</div>
						<div class="form-group">
							<?php echo lang('video', 'video'); ?>
							<textarea name="video" id="video" class="form-control"><?php echo set_value('video'); ?></textarea>
						</div>
						<div class="form-group">
							<input type="checkbox" name="for_sale" id="for_sale" value="1" <?php if(set_value("for_sale")) echo 'checked' ?>>
							<?php echo lang('for_sale', 'for_sale'); ?>
						</div>
						<div class="form-group">
							<input class="btn btn-default" type="submit" value="<?php echo lang('add'); ?>">
						</div>
					</form>
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