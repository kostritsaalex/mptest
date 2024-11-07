<article <?php post_class( 'post--archive' ); ?>>
	<div class="post__summary">
		<?php if ( has_post_thumbnail() ) : ?>
			<header class="post__header">
				<div class="post__image">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'ht_landscape_small' ); ?></a>
					<?php get_template_part( 'templates/post/post-date' ); ?>
				</div>
			</header>
		<?php endif; ?>
		<div class="post__content">
			<?php
			if ( get_the_title() ) :
				?>
				<h4 class="post__title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h4>
				<?php
			endif;

			get_template_part( 'templates/post/post-details' );
			?>
		</div>
	</div>
	<footer class="post__footer">
		<?php get_template_part( 'templates/post/post-categories' ); ?>
		<a href="<?php the_permalink(); ?>" class="post__readmore"><i class="fas fa-arrow-right"></i></a>
	</footer>
</article>
