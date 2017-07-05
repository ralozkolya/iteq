<?php if(!empty($addresses)): ?>
	<div class="form-group">
		<?php echo lang('choose_address', 'choose_address'); ?>
		<select class="form-control"
			name="choose_address"
			id="choose_address">
			<?php foreach($addresses as $a): ?>
				<option value="<?php echo $a->id; ?>">
					<?php echo $a->address.', '.$a->zip_code.', '.$a->city; ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>
	<br>
<?php endif; ?>
<h3><?php echo lang('add_address'); ?></h3>
<div>
	<?php $this->load->view('elements/messages'); ?>
</div>
<?php $this->load->view('elements/add_address'); ?>
