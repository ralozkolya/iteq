<form method="post" action="<?php echo base_url('add_address'); ?>">
	<?php
		$name = $this->security->get_csrf_token_name();
		$hash = $this->security->get_csrf_hash();
	?>
	<input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>">
	<div class="form-group">
		<?php echo lang('address', 'address'); ?>
		<input class="form-control" type="text" name="address" id="address">
	</div>
	<div class="form-group">
		<?php echo lang('city', 'city'); ?>
		<input class="form-control" type="text" name="city" id="city">
	</div>
	<div class="form-group">
		<?php echo lang('zip_code', 'zip_code'); ?>
		<input class="form-control" type="text" name="zip_code" id="zip_code">
	</div>
	<div class="form-group">
		<input class="btn btn-default" type="submit" value="<?php echo lang('add'); ?>">
	</div>
</form>