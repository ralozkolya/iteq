<!DOCTYPE html>
<html lang="<?php echo get_lang_code(get_lang()); ?>">
<head>
	<?php $this->load->view('elements/head'); ?>
	<link rel="stylesheet" href="<?php echo static_url('css/cart.css?v='.V); ?>">
	<script src="<?php echo static_url('js/cart.js?v='.V); ?>"></script>
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('elements/header'); ?>
		<div class="content">
			<div class="container main-container">
				<?php $this->load->view('elements/messages'); ?>
				<?php if(!empty($products)): ?>
					<?php $sum = 0; foreach($products as $p): ?>
						<?php $sum += $p->price * $cart[$p->id]; ?>
						<div class="row item">
							<div class="col-sm-2">
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
							<div class="col-sm-3 high"><?php echo $p->name; ?></div>
							<div class="col-sm-4 high">
								<?php echo lang('amount').': '; ?>
								<input
									class="form-control amount"
									type="number"
									min="1"
									name="<?php echo $p->id; ?>"
									value="<?php echo $cart[$p->id]; ?>">
							</div>
							<div class="col-sm-2 high text-right">
								<b class="price"><?php echo $p->price.' '.lang('gel'); ?></b>
							</div>
							<div class="col-sm-1 high text-right">
								<a class="btn btn-danger" href="<?php echo base_url('delete_from_cart/'.$p->id); ?>">
									<span class="glyphicon glyphicon-remove"></span>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
					<div class="row">
						<div class="col-sm-2 col-sm-offset-9 text-right">
							<b class="price"><?php echo lang('total').': '.number_format($sum, 2, '.', ' ').' '.lang('gel'); ?></b>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-6 text-left">
							<a class="btn btn-default" href="<?php echo base_url('clear_cart'); ?>">
								<?php echo lang('clear'); ?>
							</a>
						</div>
						<div class="col-xs-6 text-right">
							<a href="<?php echo locale_url('confirm_order'); ?>" class="btn btn-success"><?php echo lang('continue'); ?></a>
						</div>
					</div>
				<?php else: ?>
					<h3 class="text-center"><?php echo lang('empty_cart'); ?></h3>
				<?php endif; ?>
			</div>
		</div>

		<?php $this->load->view('elements/footer'); ?>
	</div>
</body>
</html>