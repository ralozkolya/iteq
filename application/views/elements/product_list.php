<?php $this->load->view('elements/sidebar'); ?>

<div class="main-content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<form id="filter-form"
					class="form-inline"
					action="<?php echo current_url(); ?>">
					<?php if(empty($category)): ?>
						<input type="hidden" name="category" value="all">
					<?php else: ?>
						<input type="hidden" name="category" value="<?php echo $category; ?>">
					<?php endif; ?>
					<div class="form-group">
						<div class="input-group">
							<input class="form-control" name="search" placeholder="<?php echo lang('search'); ?>" value="<?php echo $search; ?>">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<select class="form-control" name="sort">
							<option value="<?php echo SORT_ALPHA_ASC; ?>"
								<?php if($sort === SORT_ALPHA_ASC) echo 'selected'; ?>>
								<?php echo lang('alpha_asc'); ?>
							</option>
							<option value="<?php echo SORT_ALPHA_DESC; ?>"
								<?php if($sort === SORT_ALPHA_DESC) echo 'selected'; ?>>
								<?php echo lang('alpha_desc'); ?>
							</option>
							<option value="<?php echo SORT_PRICE_ASC; ?>"
								<?php if($sort === SORT_PRICE_ASC) echo 'selected'; ?>>
								<?php echo lang('price_asc'); ?>
							</option>
							<option value="<?php echo SORT_PRICE_DESC; ?>"
								<?php if($sort === SORT_PRICE_DESC) echo 'selected'; ?>>
								<?php echo lang('price_desc'); ?>
							</option>
						</select>
					</div>
				</form>
			</div>
		</div>

		<div class="row products">
			<?php if(!empty($products)): ?>
				<?php foreach($products as $p): ?>
					<div class="col-sm-4 col-lg-3">
						<a class="unstyled" href="<?php echo locale_url('product/'.$p->id.'/'.$p->slug); ?>">
							<div class="product">
								<?php
									$image = $p->image;

									if(!$image) {
										$image = static_url('img/no_image.png');
									}

									else {
										$image = static_url('uploads/products/thumbs/'.$image);
									}
								?>
								<div class="image" style="background-image: url('<?php echo $image; ?>');"></div>
								<div class="name orange">
									<?php echo $p->name; ?>   
								</div>
								<div class="price">
									<?php echo $p->price.' '.lang('gel'); ?>   
								</div>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="col-xs-12">	
					<h3 class="text-center"><?php echo lang('no_products'); ?></h3>
				</div>
			<?php endif; ?>
		</div>

		<div class="row">
			<div class="col-xs-12 text-center">
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
	</div>
</div>