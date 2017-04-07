<!DOCTYPE html>
<html lang="<?php echo get_lang_code(get_lang()); ?>">
<head>
	<?php $this->load->view('elements/head'); ?>
	<link rel="stylesheet" href="<?php echo static_url('css/contact.css?v='.V); ?>">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.10.2/validator.min.js"></script>
	<script src="<?php echo static_url('js/contact.js?v='.V); ?>"></script>
</head>
<body>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div class="wrapper">
		<?php $this->load->view('elements/header'); ?>

		<div class="content">
			<div class="map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d744.8921479921365!2d44.82706223554175!3d41.68665962867556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7a39577e45c03c61!2sITEQ+GEORGIA!5e0!3m2!1sen!2sge!4v1491573368232" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
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
							<div class="row">
								<div class="col-xs-12 text-center">
									<div class="fb-page" data-href="https://www.facebook.com/Iteqgeorgia" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Iteqgeorgia" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Iteqgeorgia">Iteq Georgia • აიტეკ ჯორჯია</a></blockquote></div>
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