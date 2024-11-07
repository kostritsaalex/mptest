<div class="post__details">
	<?php if ( ! is_single() && is_sticky() ) : ?>
		<div class="post__sticky">
			<i class="fas fa-thumbtack"></i>
			<span><?php echo esc_html_x( 'Pinned', 'post', 'meetinghive' ); ?></span>
		</div>
	<?php elseif ( ! has_post_thumbnail() ) : ?>
		<time datetime="<?php echo esc_attr( get_the_time( 'Y-m-d' ) ); ?>" class="post__date">
			<i class="fas fa-calendar-plus"></i>
			<span><?php echo esc_html( get_the_date() ); ?></span>
		</time>
	<?php endif; ?>
	<div class="post__author">
		<i class="fas fa-user-edit"></i>
		<span><?php the_author(); ?></span>
	</div>
	<?php if ( comments_open() && ! post_password_required() ) : ?>
		<a href="<?php comments_link(); ?>" class="post__comments">
			<i class="fas fa-sms"></i>
			<span><?php comments_number(); ?></span>
		</a>
	<?php endif; ?>
</div>
