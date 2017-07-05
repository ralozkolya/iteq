<!DOCTYPE html>
<html lang="<?php echo get_lang_code(get_lang()); ?>">
<head>
	<?php $this->load->view('elements/head'); ?>
	<link rel="stylesheet" href="<?php echo static_url('css/credit.css?v='.V); ?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.10.2/validator.min.js"></script>
	<script src="<?php echo static_url('js/credit.js?v='.V); ?>"></script>
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('elements/header'); ?>

		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="clearfix">
							<img class="thumb" src="<?php echo static_url('uploads/products/thumbs/'.$images[0]->image); ?>" alt="<?php echo $product->name; ?>">
							<h3><?php echo $product->name; ?></h3>
							<h4 class="orange"><?php echo $product->price . ' ' . lang('gel'); ?></h4>
						</div>
						<br>
						<form action="<?php echo locale_url('confirm_credit') ?>" method="post">
							<input type="hidden" name="address">
							<input type="hidden" name="product" value="<?php echo $product->id; ?>">
							<div class="form-group">
								<input type="submit" class="btn btn-success disabled submit-button" value="<?php echo lang('continue'); ?>">
							</div>
						</form>
					</div>
					<div class="col-sm-4">
						<?php $this->load->view('elements/address_form'); ?>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view('elements/footer'); ?>
	</div>
</body>
</html>