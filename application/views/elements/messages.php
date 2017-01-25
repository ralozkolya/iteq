<?php
	if(empty($success_message)) {
		$success_message = $this->session->flashdata('success_message');
	}

	if(empty($error_message)) {
		$error_message = $this->session->flashdata('error_message');
	}
?>

<?php if($success_message || $error_message): ?>
	<?php if($success_message): ?>
		<div class="alert alert-success"><?php echo $success_message; ?></div>
	<?php endif; ?>
	<?php if($error_message): ?>
		<div class="alert alert-danger"><?php echo $error_message; ?></div>
	<?php endif; ?>
<?php endif; ?>