<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('elements/admin/head'); ?>
	<link rel="stylesheet" href="<?php echo static_url('css/admin/product.css?v='.V); ?>">
	<script src="<?php echo static_url('js/admin/products.js?v='.V); ?>"></script>
</head>
<body>
	<?php $this->load->view('elements/admin/sidebar'); ?>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<h1><?php echo $product->name; ?></h1>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<?php $this->load->view('elements/messages'); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<h3><?php echo lang('edit_product'); ?></h3>
					<form method="post">
						<?php
							$name = $this->security->get_csrf_token_name();
							$hash = $this->security->get_csrf_hash();
						?>
						<input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>">
						<input type="hidden" name="id" value="<?php echo $product->id; ?>">
						<div class="form-group">
							<?php echo lang('en_name', 'en_name'); ?>
							<input class="form-control" type="text" name="en_name" id="en_name" value="<?php echo $product->en_name; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('ka_name', 'ka_name'); ?>
							<input class="form-control" type="text" name="ka_name" id="ka_name" value="<?php echo $product->ka_name; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('ru_name', 'ru_name'); ?>
							<input class="form-control" type="text" name="ru_name" id="ru_name" value="<?php echo $product->ru_name; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('en_description', 'en_description'); ?>
							<textarea class="form-control cke" name="en_description" id="en_description"><?php echo $product->en_description; ?></textarea>
						</div>
						<div class="form-group">
							<?php echo lang('ka_description', 'ka_description'); ?>
							<textarea class="form-control cke" name="ka_description" id="ka_description"><?php echo $product->ka_description; ?></textarea>
						</div>
						<div class="form-group">
							<?php echo lang('ru_description', 'ru_description'); ?>
							<textarea class="form-control cke" name="ru_description" id="ru_description"><?php echo $product->ru_description; ?></textarea>
						</div>
						<div class="form-group">
							<?php echo lang('brand', 'brand'); ?>
							<input class="form-control" type="text" name="brand" id="brand" value="<?php echo $product->brand; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('category', 'category'); ?>
							<select class="form-control" name="category" id="category">
								<option value=""><?php echo lang('none'); ?></option>
								<?php $category = $product->category; ?>
								<?php var_dump($category); ?>
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
							<input class="form-control" type="number" step="0.01" name="price" id="price" value="<?php echo $product->price; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('en_price_label', 'en_price_label'); ?>
							<input class="form-control" type="text" 								name="en_price_label" id="en_price_label"
								value="<?php echo $product->price_label; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('ka_price_label', 'ka_price_label'); ?>
							<input class="form-control" type="text" 								name="ka_price_label" id="ka_price_label"
								value="<?php echo $product->ka_price_label; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('ru_price_label', 'ru_price_label'); ?>
							<input class="form-control" type="text"
								name="ru_price_label" id="ru_price_label"
								value="<?php echo $product->ru_price_label; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('in_stock', 'in_stock'); ?>
							<input class="form-control" type="number" name="in_stock" id="in_stock" value="<?php echo $product->in_stock; ?>">
						</div>
						<div class="form-group">
							<?php echo lang('video', 'video'); ?>
							<textarea name="video" id="video" class="form-control"><?php echo $product->video; ?></textarea>
						</div>
						<div class="form-group">
							<input type="checkbox" name="for_sale" id="for_sale" value="1" <?php if($product->for_sale) echo 'checked'; ?>>
							<?php echo lang('for_sale', 'for_sale'); ?>
						</div>
						<div class="form-group">
							<input class="btn btn-default" type="submit" value="<?php echo lang('change'); ?>">
							<a href="<?php echo base_url('admin/products'); ?>" class="btn btn-primary"><?php echo lang('back'); ?></a>
						</div>
					</form>
				</div>
				<div class="col-sm-6">
					<h3><?php echo lang('gallery'); ?></h3>
					<form action="<?php echo base_url('admin/upload_images'); ?>" method="post" enctype="multipart/form-data">
						<?php
							$name = $this->security->get_csrf_token_name();
							$hash = $this->security->get_csrf_hash();
						?>
						<input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>">
						<input type="hidden" name="product" value="<?php echo $product->id; ?>">
						<div class="form-group">
							<?php echo lang('upload_recommended', 'image'); ?>
							<input class="form-control" type="file" name="images[]" id="image" multiple required>
						</div>
						<div class="form-group">
							<input class="btn btn-default" type="submit" value="<?php echo lang('upload'); ?>">
						</div>
					</form>
					<br>
					<?php foreach($gallery as $g): ?>
						<div class="thumb">
							<img alt="<?php echo $g->image; ?>" src="<?php echo static_url('uploads/products/thumbs/'.$g->image); ?>">
							<a href="<?php echo base_url('admin/delete/Gallery/'.$g->id); ?>" class="unstyled delete">
								<span class="glyphicon glyphicon-remove"></span>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>	
		</div>
	</div>
</body>
</html>