<!DOCTYPE html>
<html lang="<?php echo get_lang_code(get_lang()); ?>">
<head>
	<?php $this->load->view('elements/head'); ?>

	<link rel="stylesheet" href="<?php echo static_url('css/brands.css?v='.V); ?>">
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('elements/header'); ?>

		<div class="content">
			<div class="container">
				<div class="row">
					<?php if(!empty($brands)): ?>
						<?php $i = 0; foreach($brands as $b): ?>
							<?php
								$image = $b->image;

								if(!$image) {
									$image = static_url('img/no_image.png');
								}

								else {
									$image = static_url('uploads/brands/thumbs/'.$image);
								}
							?>
							<div class="col-sm-3">
								<?php if($b->link): ?>
									<a class="unstyled" href="<?php echo $b->link; ?>" target="_blank">
										<div class="brand">
											<div class="image"
												style="background-image: url('<?php echo $image; ?>');"></div>
											<div class="name"><?php echo $b->name; ?></div>
										</div>
									</a>
								<?php else: ?>
									<div class="brand">
										<div class="image"
											style="background-image: url('<?php echo $image; ?>');"></div>
										<div class="name"><?php echo $b->name; ?></div>
									</div>
								<?php endif;?>
							</div>
							<?php $i++; if($i % 4 === 0) { ?>
								<div class="clearfix"></div>
							<?php } ?>
						<?php endforeach; ?>
					<?php else: ?>
						<h3 class="text-center"><?php echo lang('no_brands'); ?></h3>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<?php $this->load->view('elements/footer'); ?>
	</div>
</body>
</html>