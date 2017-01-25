<ul class="sidebar">
	<?php foreach($categories as $c): ?>
		<li <?php if($category === $c->slug) echo 'class="active"'; ?>>
			<?php
				$class = "unstyled category-link";

				if($category === $c->slug) {
					$class .= ' active';
				}
			?>
			<a class="<?php echo $class; ?>"
				data-slug="<?php echo $c->slug; ?>"
				href="<?php echo locale_url('products?category='.$c->slug); ?>">
					<?php echo $c->name; ?>
			</a>
			<?php if(!empty($c->sub)): ?>
				<ul class="subcategories">
					<?php foreach($c->sub as $s): ?>
						<li>
							<?php
								$class = 'unstyled subcategory-link';

								if($category === $s->slug) {
									$class .= ' active';
								}
							?>
							<a class="<?php echo $class; ?>"
								href="<?php echo locale_url('products?category='.$s->slug); ?>"
								data-slug="<?php echo $s->slug; ?>">
								<em>• <?php echo $s->name; ?></em>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
</ul>