<!DOCTYPE html>
<html lang="<?php echo get_lang_code(get_lang()); ?>">
<head>
	<?php $this->load->view('elements/head'); ?>

	<link rel="stylesheet" href="<?php echo static_url('css/products.css?v='.V); ?>">

	<script src="<?php echo static_url('js/products.js?v='.V); ?>"></script>
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('elements/header'); ?>

		<div class="content">
			<?php $this->load->view('elements/product_list'); ?>
		</div>

		<?php $this->load->view('elements/footer'); ?>
	</div>
</body>
</html>