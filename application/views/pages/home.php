<!DOCTYPE html>
<html lang="<?php echo get_lang_code(get_lang()); ?>">
<head>
	<?php $this->load->view('elements/head'); ?>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/unslider/2.0.3/css/unslider.css">
	<link rel="stylesheet" href="<?php echo static_url('css/unslider-dots.css?v='.V); ?>">
	<link rel="stylesheet" href="<?php echo static_url('css/home.css?v='.V); ?>">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/unslider/2.0.3/js/unslider-min.js"></script>
	<script src="<?php echo static_url('js/home.js?v='.V); ?>"></script>
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('elements/header'); ?>
		<?php $this->load->view('elements/banners'); ?>

		<div class="content">
			<div class="container">
				<div class="row">
					<?php foreach($pinned_links as $p): ?>
						<div class="col-sm-4">
							<a class="unstyled"
							<?php if($p->link): ?>
								href="<?php echo $p->link; ?>"
							<?php endif; ?>
							<?php if($p->blank): ?>
								target="_blank"
							<?php endif; ?>>
								<div class="pinned-link">
									<?php
										$url = static_url('uploads/pinned_links/'.$p->image);
										$desc = $p->description;

										if(mb_strlen($desc) > 150) {
											$desc = mb_substr($desc, 0, 150).'...';
										}
									?>
									<div class="image"
										style="background-image: url('<?php echo $url; ?>'); ?>"></div>
									<div class="description"><?php echo $desc; ?></div>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<?php echo $page->body; ?>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view('elements/footer'); ?>
	</div>
</body>
</html>