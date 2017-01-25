<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo $title; ?></title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- general.css -->
<link rel="stylesheet" href="<?php echo static_url('css/fonts.css?v='.V); ?>">
<link rel="stylesheet" href="<?php echo static_url('css/admin/general.css?v='.V); ?>">

<!-- Favicon -->
<link rel="icon" type="image/png" href="<?php echo static_url('img/favicon.png'); ?>">

<!-- jQuery 1.12.2 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<!-- CKeditor -->
<script src="<?php echo static_url('ckeditor/ckeditor.js'); ?>"></script>
<script src="<?php echo static_url('ckeditor/adapters/jquery.js'); ?>"></script>


<script>
	var lang = {
		areYouSure: '<?php echo lang('are_you_sure'); ?>',
	};

	var url = {
		baseUrl: '<?php echo base_url(); ?>',
		localeUrl: '<?php echo locale_url(); ?>',
		staticUrl: '<?php echo static_url(); ?>',
	};
</script>

<!-- general.js -->
<script src="<?php echo static_url('js/admin/general.js?v='.V); ?>"></script>