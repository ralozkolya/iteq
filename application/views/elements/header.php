<div class="header">
	<div class="container">
		<a href="<?php echo locale_url(); ?>">
			<img class="logo" alt="Logo" src="<?php echo static_url('img/logo_header.png'); ?>">
		</a>
		<button type="button" class="navbar-toggle visible-xs">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<div class="nav-container">
			<div class="profile">
				<?php if($user): ?>
					<a class="unstyled" href="<?php echo locale_url('profile'); ?>">
						<?php echo lang('profile'); ?>
					</a>
					<a class="unstyled" href="<?php echo base_url('logout'); ?>">
						<?php echo lang('logout'); ?>
					</a>
				<?php else: ?>
					<a class="unstyled" href="<?php echo locale_url('login'); ?>">
						<?php echo lang('login'); ?>
					</a>
				<?php endif; ?>
				<a class="unstyled shopping-cart" href="<?php echo locale_url('cart'); ?>">
					<span class="glyphicon glyphicon-shopping-cart"></span>
					<?php if(!empty($cart) && count($cart)): ?>
						<span class="count"><?php echo count($cart); ?></span>
					<?php endif; ?>
				</a>
			</div>
			<ul class="navigation clearfix">
				<?php foreach($navigation as $n): ?>
					<?php
						$class = 'nav-item';

						if($n->slug === $highlighted) {
							$class .= ' active';
						}

						if($n->slug === 'products' || $n->slug === 'shop') {
							$class .= ' nav-products';
						}
					?>
					<li class="<?php echo $class; ?>">
						<a class="unstyled" 
							href="<?php echo locale_url($n->slug); ?>">
							<?php echo $n->title; ?>
						</a>
						<?php if($n->slug === 'products' || $n->slug === 'shop'): ?>
							<span class="glyphicon glyphicon-chevron-down hidden-xs"></span>
							<ul class="submenu">
								<?php foreach($top_categories as $c): ?>
									<li>
										<a class="unstyled" href="<?php echo locale_url($n->slug.'?category='.$c->slug); ?>"><?php echo $c->name; ?></a>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="langs">
				<a class="unstyled" href="<?php echo lang_link(GE); ?>">ქა</a>
				<a class="unstyled" href="<?php echo lang_link(EN); ?>">EN</a>
				<a class="unstyled" href="<?php echo lang_link(RU); ?>">РУ</a>
			</div>
		</div>
	</div>
</div>