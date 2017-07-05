<!DOCTYPE html>
<html lang="<?php echo get_lang_code(get_lang()); ?>">
<head>
	<?php $this->load->view('elements/head'); ?>
	<link rel="stylesheet" href="<?php echo static_url('css/cart.css?v='.V); ?>">
	<link rel="stylesheet" href="<?php echo static_url('css/confirm_order.css?v='.V); ?>">
	<script src="<?php echo static_url('js/confirm_order.js?v='.V); ?>"></script>
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('elements/header'); ?>

		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h1><?php echo lang('confirm_order'); ?></h1>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-6">
						<?php $sum = 0; foreach($products as $p): ?>
							<div class="product clearfix">
								<div>
									<?php
										$image = $p->image;

										if(!$image) {
											$image = static_url('img/no_image.png');
										}

										else {
											$image = static_url('uploads/products/thumbs/'.$image);
										}
									?>

									<img class="thumb"
										alt="<?php echo $p->name ?>"
										src="<?php echo $image; ?>">
								</div>
								
								<div class="pad-top">
									<b class="name"><?php echo $p->name; ?></b>
								</div>
								<div class="pad-top">
									<?php echo $cart[$p->id].' x '.$p->price.' '.lang('gel'); ?>
								</div>
								<div class="text-right pad-top">
									<?php 
										$price = $cart[$p->id]*$p->price;
										$sum += $price;
										echo number_format($price, 2, '.', ' ').' '.
										lang('gel');
									?>
								</div>
							</div>
						<?php endforeach; ?>
						<div class="text-right">
							<b><?php echo lang('total').': '.number_format($sum, 2, '.', ' ').' '.
								lang('gel'); ?></b>
						</div>
						<div>
							<a class="btn btn-success disabled submit-order"><?php echo lang('order'); ?></a>
						</div>
						<br>
						<div class="text-center">
							<img alt="TBC Visa Mastercard" src="<?php echo static_url('img/tbc_bank_ecom_logo.gif'); ?>">
						</div>
					</div>
					<br><br>
					<div class="col-sm-5 col-sm-offset-1">
						<?php $this->load->view('elements/address_form'); ?>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view('elements/footer'); ?>
	</div>
</body>
</html>