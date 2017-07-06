<!DOCTYPE html>
<html lang="<?php echo get_lang_code(get_lang()); ?>">
<head>
	<?php $this->load->view('elements/head'); ?>
	<link rel="stylesheet" href="<?php echo static_url('css/credit.css?v='.V); ?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.10.2/validator.min.js"></script>
	<script>
		var price = <?php echo $product->price; ?>;
		var months = 6;
		var participation = 0;
	</script>
	<script src="<?php echo static_url('js/credit.js?v='.V); ?>"></script>
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('elements/header'); ?>

		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<?php $this->load->view('elements/address_form'); ?>
					</div>
					<div class="col-sm-4">
						<div class="clearfix">
							<img class="thumb" src="<?php echo static_url('uploads/products/thumbs/'.$images[0]->image); ?>" alt="<?php echo $product->name; ?>">
							<h3><?php echo $product->name; ?></h3>
							<h4 class="orange"><?php echo $product->price . ' ' . lang('gel'); ?></h4>
						</div>
						<br>
						<form action="<?php echo locale_url('confirm_credit') ?>" method="post">
							<input id="address-hidden" type="hidden" name="address">
							<input type="hidden" name="product" value="<?php echo $product->id; ?>">
							<div class="form-group">
								<input type="submit" class="btn btn-success disabled submit-button" value="<?php echo lang('continue'); ?>">
							</div>
						</form>
					</div>
					<div class="col-sm-4">
						<h3><?php echo lang('calculator'); ?></h3>
						<br>
						<form id="calculator-form">
							<div class="form-group">
								<label for="period"><?php echo lang('period'); ?></label>
								<div class="input-group">
									<input id="period" class="form-control" type="text" value="6">
									<span class="input-group-addon"><?php echo lang('months'); ?></span>
								</div>
							</div>
							<div class="form-group">
								<label for="participation"><?php echo lang('participation'); ?></label>
								<div class="input-group">
									<input id="participation" class="form-control" type="text" value="0.00">
									<span class="input-group-addon"><?php echo lang('gel'); ?></span>
								</div>
							</div>
							<div class="form-group">
								<label for="amount"><?php echo lang('money_amount'); ?></label>
								<div class="input-group">
									<input id="amount" class="form-control" type="text" value="<?php echo $product->price; ?>" disabled>
									<span class="input-group-addon"><?php echo lang('gel'); ?></span>
								</div>
							</div>
							<div class="form-group">
								<label for="percent"><?php echo lang('percent'); ?></label>
								<?php $percent = $product->price > 500 ? 3 : 5; ?>
								<div class="input-group">
									<input id="percent" class="form-control" type="text" value="<?php echo $percent; ?>" disabled>
									<span class="input-group-addon">%</span>
								</div>
							</div>
							<div class="form-group">
								<label for="per_month"><?php echo lang('per_month'); ?></label>
								<?php
									$total = $product->price + $product->price * ($percent / 100);
									$total = number_format($total, 2, '.', '');
									$per_month = number_format($total / 6, 2, '.', '');
								?>
								<div class="input-group">
									<input id="per_month" class="form-control" type="text" value="<?php echo $per_month; ?>" disabled>
									<span class="input-group-addon"><?php echo lang('gel'); ?></span>
								</div>
							</div>
							<div class="form-group">
								<label for="total"><?php echo lang('total'); ?></label>
								<div class="input-group">
									<input id="total" class="form-control" type="text" value="<?php echo $total; ?>" disabled>
									<span class="input-group-addon"><?php echo lang('gel'); ?></span>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view('elements/footer'); ?>
	</div>
</body>
</html>