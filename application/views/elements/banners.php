<div class="slider">
	<ul>
		<?php foreach($banners as $b): ?>
			<li>
				<a
				<?php if($b->link): ?>
					href="<?php echo $b->link; ?>"
				<?php endif; ?>
				<?php if($b->blank): ?>
					target="_blank"
				<?php endif; ?>>
					<div class="slide" style="background-image: url('<?php echo static_url('uploads/banners/'.$b->image); ?>')"></div>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>