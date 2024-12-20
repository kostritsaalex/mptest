<?php
$prev_post = get_previous_post();
$next_post = get_next_post();

if ( $prev_post || $next_post ) :
	?>
	<div class="post-navbar">
		<div class="row">
			<div class="post-navbar__start col-sm-6 col-xs-12">
				<?php if ( $prev_post ) : ?><div class="post-navbar__link"><h6><a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>"><i class="fas fa-arrow-left"></i><span><?php echo esc_html( get_the_title( $prev_post ) ); ?></span></a></h6></div><?php endif; ?>
			</div>
			<div class="post-navbar__end col-sm-6 col-xs-12">
				<?php if ( $next_post ) : ?><div class="post-navbar__link"><h6><a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>"><span><?php echo esc_html( get_the_title( $next_post ) ); ?></span><i class="fas fa-arrow-right"></i></a></h6></div><?php endif; ?>
			</div>
		</div>
	</div>
	<?php
endif;
