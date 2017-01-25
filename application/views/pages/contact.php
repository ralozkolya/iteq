<!DOCTYPE html>
<html lang="<?php echo get_lang_code(get_lang()); ?>">
<head>
	<?php $this->load->view('elements/head'); ?>
	<link rel="stylesheet" href="<?php echo static_url('css/contact.css?v='.V); ?>">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.10.2/validator.min.js"></script>
	<script src="<?php echo static_url('js/contact.js?v='.V); ?>"></script>
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('elements/header'); ?>

		<div class="content">
			<div class="map">
				<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJXcA_AFIMREARH0A9y4qg0q8&key=AIzaSyAF3z4Gkut40hFvyOjGdh2r9jtSHUyHk7s" allowfullscreen></iframe>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2">
						<div class="main-container container-fluid">
							<div class="row">
								<div class="col-sm-6">
									<?php $this->load->view('elements/contact_form'); ?>
								</div>
								<div class="col-sm-6">
									<?php echo $page->body; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view('elements/footer'); ?>
	</div>
</body>
</html>