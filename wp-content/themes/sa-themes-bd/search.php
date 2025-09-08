<?php get_header(); ?>
<div class="main-block">
	<?php echo do_shortcode('[custom_breadcrumbs]'); ?>
	<section class="search-block">
		<div class="search-content">
			<h1 class="title">検索結果： <?php echo get_search_query(); ?></h1>
			<?php if (have_posts()) { ?>
				<?php while (have_posts()) {
					the_post(); ?>
					<a href="<?php echo get_permalink(); ?>"><h2 style="font-size: 20px;"><?php echo get_the_title(); ?></h2></a>
					<hr>
				<?php }
			} else { ?>
				<p>リクエストに一致するものは見つかりませんでした。</p>
			<?php } ?>
		</div>
	</section>
</div>
<?php get_footer(); ?>