<div class="col-sm-4 text-center">
	<?php
		$class = 'unstyled profile-link';

		if($prof_highlighted === 'details') {
			$class .= ' active';
		}
	?>
	<a class="<?php echo $class; ?>"
		href="<?php echo locale_url('profile'); ?>"><?php echo lang('personal_details'); ?></a>
</div>
<div class="col-sm-4 text-center">
	<?php
		$class = 'unstyled profile-link';

		if($prof_highlighted === 'orders') {
			$class .= ' active';
		}
	?>
	<a class="<?php echo $class; ?>"
		href="<?php echo locale_url('profile/orders'); ?>"><?php echo lang('my_orders'); ?></a>
</div>
<div class="col-sm-4 text-center">
	<?php
		$class = 'unstyled profile-link';

		if($prof_highlighted === 'addresses') {
			$class .= ' active';
		}
	?>
	<a class="<?php echo $class; ?>"
		href="<?php echo locale_url('profile/addresses'); ?>"><?php echo lang('addresses'); ?></a>
</div>