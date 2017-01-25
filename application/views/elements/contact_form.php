<?php
	$name = $this->security->get_csrf_token_name();
	$hash = $this->security->get_csrf_hash();
?>
<form class="contact-form" method="post" data-toggle="validator" action="<?php echo base_url('send_message'); ?>">
	<input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>">
	<div class="form-group">
		<input
			data-error="<?php echo lang('field_required'); ?>"
			class="input"
			type="text"
			name="name"
			placeholder="<?php echo lang('name'); ?>"
			value="<?php echo set_value('name'); ?>"
			required>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<input
			data-error="<?php echo lang('invalid_email'); ?>"
			class="input"
			type="email"
			name="email"
			placeholder="<?php echo lang('email') ?>"
			value="<?php echo set_value('email'); ?>"
			required>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<textarea
			data-error="<?php echo lang('field_required'); ?>"
			class="input"
			name="message"
			placeholder="<?php echo lang('message'); ?>"
			value="<?php echo lang('message'); ?>"
			required></textarea>
		<div class="help-block with-errors"></div>
	</div>
	<div class="text-right">
		<input class="btn btn-warning submit-button" type="submit" value="<?php echo lang('send'); ?>">
	</div>
</form>