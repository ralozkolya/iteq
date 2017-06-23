<!DOCTYPE html>
<html lang="<?php echo get_lang_code(get_lang()); ?>">
<head>
	<?php $this->load->view('elements/head'); ?>

	<link rel="stylesheet" href="<?php echo static_url('css/product.css?v='.V); ?>">
	<link rel="stylesheet" href="<?php echo static_url('css/jquery.fancybox.min.css'); ?>">

	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.15/jquery.zoom.min.js"></script> -->
	<script src="<?php echo static_url('js/jquery.fancybox.min.js'); ?>"></script>
	<script src="<?php echo static_url('js/product.js?v='.V); ?>"></script>
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('elements/header'); ?>

		<div class="content">
			<div class="container main-content">
				<div class="row">
					<div class="col-sm-6">
						<div class="container-fluid">
							<div class="row">
								<?php if(!empty($images)): ?>
									<div class="col-sm-2 clearfix">
										<?php foreach($images as $i): ?>
											<div class="thumb-container">
												<img class="thumb" alt="<?php echo $i->image; ?>"
													data-large="<?php echo static_url('uploads/products/'.$i->image); ?>"
													src="<?php echo static_url('uploads/products/thumbs/'.$i->image); ?>">
											</div>
										<?php endforeach; ?>
									</div>
									<div class="col-sm-10 text-center">
										<div id="zoom">
											<a data-fancybox>
												<img alt="<?php echo $product->name; ?>">
											</a>
										</div>
									</div>
								<?php else: ?>
									<div class="col-sm-6 text-center">
										<img alt="<?php echo lang('no_image'); ?>"
											src="<?php echo static_url('img/no_image.png'); ?>">
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-6">
									<h3 class="orange"><?php echo $product->name; ?></h3>
									<?php if(!empty($product->brand)): ?>
										<br>
										<h4>
											<a class="unstyled"
												href="<?php echo locale_url('products?search='.
												urlencode($product->brand)); ?>">
												<?php echo lang('brand').': '.$product->brand; ?>
											</a>
										</h4>
									<?php endif; ?>
									<h4>
										<a class="unstyled"
											href="<?php echo locale_url('products?category='.$product->category_slug); ?>">
											<?php echo lang('category').': '.$product->category_name; ?>
										</a>
									</h4>
									<br>
									<h4>
										<?php echo lang('price').': '.$product->price.' '.lang('gel'); ?>
										&nbsp;&nbsp;<?php echo $product->price_label; ?>	
									</h4>
									<br>
									<?php if($product->for_sale && $product->in_stock): ?>
										<div>
											<?php if($product->in_stock): ?>
												<?php if(array_key_exists($product->id, $cart)): ?>
													<a
														class="btn btn-default disabled"
														href="<?php echo base_url('add_to_cart/'.$product->id); ?>">
														<?php echo lang('added'); ?>	
													</a>
												<?php else: ?>
													<div>
														<a
															class="btn btn-success"
															href="<?php echo base_url('add_to_cart/'.$product->id); ?>">
															<?php echo lang('add_to_cart'); ?>	
														</a>
													</div>
													<br>
													<div>
														<a href="#">
															<img src="<?php echo static_url('img/okey.png?v='.V); ?>" alt="Okey credit">
														</a>
													</div>
												<?php endif; ?>
											<?php else: ?>
												<span class="text-danger"><?php echo lang('out_of_stock'); ?></span>
											<?php endif; ?>
										</div>
										<br>
									<?php endif; ?>
								</div>
								<div class="col-sm-6 text-center clearfix">
									<img class="free-delivery-banner" src="<?php echo static_url('img/banner.png'); ?>" alt="Free delivery over 50 GEL">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-12">
									<?php echo $product->description; ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php if($product->video): ?>
					<div class="row text-center video-container">
						<?php echo $product->video; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php $this->load->view('elements/footer'); ?>
	</div>
</body>
</html>