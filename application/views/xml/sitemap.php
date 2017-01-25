<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc><?php echo base_url(); ?></loc> 
		<priority>1.0</priority>
	</url>
	<url>
		<loc><?php echo base_url('ka-GE'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('en-US'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('ru-RU'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('ka-GE/home'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('en-US/home'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('ru-RU/home'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('ka-GE/products'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('en-US/products'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('ru-RU/products'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('ka-GE/shop'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('en-US/shop'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('ru-RU/shop'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('ka-GE/brands'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('en-US/brands'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('ru-RU/brands'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('ka-GE/about_us'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('en-US/about_us'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('ru-RU/about_us'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('ka-GE/contact'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('en-US/contact'); ?></loc> 
		<priority>0.5</priority>
	</url>
	<url>
		<loc><?php echo base_url('ru-RU/contact'); ?></loc> 
		<priority>0.5</priority>
	</url>

	<?php foreach($products as $p): ?>
		<url>
			<loc><?php echo base_url('ka-GE/product/'.$p->id.'/'.$p->slug); ?></loc>
			<priority>0.5</priority>
		</url>
		<url>
			<loc><?php echo base_url('en-US/product/'.$p->id.'/'.$p->slug); ?></loc>
			<priority>0.5</priority>
		</url>
		<url>
			<loc><?php echo base_url('ru-RU/product/'.$p->id.'/'.$p->slug); ?></loc>
			<priority>0.5</priority>
		</url>
	<?php endforeach; ?>

</urlset>