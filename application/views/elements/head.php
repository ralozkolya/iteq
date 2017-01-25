<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo $title; ?></title>

<!-- FACEBOOK OG TAGS -->
<meta property="og:url" content="<?php echo current_url(); ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="Iteq.ge">
<meta property="og:description" content="Iteq.ge website">
<meta property="og:image" content="<?php echo static_url('img/logo_fb.png'); ?>">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- general.css -->
<link rel="stylesheet" href="<?php echo static_url('css/fonts.css?v='.V); ?>">
<link rel="stylesheet" href="<?php echo static_url('css/general.css?v='.V); ?>">

<!-- Favicon -->
<link rel="icon" type="image/png" href="<?php echo static_url('img/favicon.png'); ?>">

<!-- jQuery 1.12.2 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


<script>
	var lang = {
		areYouSure: '<?php echo lang('are_you_sure'); ?>',
		sent: '<?php echo lang('sent'); ?>',
	};

	var url = {
		baseUrl: '<?php echo base_url(); ?>',
		localeUrl: '<?php echo locale_url(); ?>',
		staticUrl: '<?php echo static_url(); ?>',
	};
</script>

<!-- general.js -->
<script src="<?php echo static_url('js/general.js?v='.V); ?>"></script>