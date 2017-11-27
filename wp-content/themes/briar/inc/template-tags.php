<?php
/**
 * Custom template tags for this theme.
 *
 * @package Briar
 * @since 1.0
 */

if ( ! function_exists( 'briar_header' ) ) :
	/**
	 * Display title and tagline or logo.
	 *
	 * @since 1.0
	 */
	function briar_header() {
		$briar_header = get_theme_mod( 'briar_header', 'title' );

		$briar_header_logo_default = get_template_directory_uri() . '/img/themejack.png';
		$briar_header_logo = get_theme_mod( 'briar_header_logo' );
		if ( empty( $briar_header_logo ) ) {
			$briar_header_logo = $briar_header_logo_default;
		}

		if ( 'title' === $briar_header || is_customize_preview() ) : ?>
			<h1 class="header__logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo-link btn--transition btn--logo site-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></h1>
		<?php endif; ?>
		<?php if ( 'logo' === $briar_header || is_customize_preview() ) : ?>
			<h1 class="header__logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo-link site-logo">
					<img class="header-logo__image" src="<?php echo esc_url( $briar_header_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
					<?php if ( is_customize_preview() ) : ?>
					<img class="header-logo__image default" src="<?php echo esc_url( $briar_header_logo_default ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" style="display: none" />
					<?php endif; ?>
				</a>
			</h1>
		<?php
		endif;
	}
endif;

if ( ! function_exists( 'briar_get_social_icons' ) ) :
	/**
	 * Get social icons.
	 *
	 * @since 1.0
	 */
	function briar_get_social_icons() {
		return get_theme_mod( 'briar_footer_social_buttons', array(
			array( 'social' => 'facebook', 'url' => '#', 'css_class' => 'facebook' ),
			array( 'social' => 'twitter', 'url' => '#', 'css_class' => 'twitter' ),
			array( 'social' => 'linkedin', 'url' => '#', 'css_class' => 'linkedin' ),
		) );
	}
endif;

if ( ! function_exists( 'briar_social_icons' ) ) :
	/**
	 * Display social icons.
	 *
	 * @since 1.0
	 * @param array $briar_footer_social_buttons Footer social buttons.
	 */
	function briar_social_icons( $briar_footer_social_buttons = false ) {
		if ( false === $briar_footer_social_buttons ) {
			$briar_footer_social_buttons = briar_get_social_icons();
		}

		if ( ! empty( $briar_footer_social_buttons ) ) :
			$social_buttons_default_titles = array(
				'facebook' => __( 'Facebook', 'briar' ),
				'twitter' => __( 'Twitter', 'briar' ),
				'linkedin' => __( 'LinkedIn', 'briar' ),
				'dribbble' => __( 'Dribbble', 'briar' ),
				'flickr' => __( 'Flickr', 'briar' ),
				'github' => __( 'GitHub', 'briar' ),
				'googleplus' => __( 'Google+', 'briar' ),
				'instagram' => __( 'Instagram', 'briar' ),
				'pinterest' => __( 'Pinterest', 'briar' ),
				'stumbleupon' => __( 'StumbleUpon', 'briar' ),
				'skype' => __( 'Skype', 'briar' ),
				'tumblr' => __( 'Tumblr', 'briar' ),
				'vimeo' => __( 'Vimeo', 'briar' ),
				'behance' => __( 'Behance', 'briar' ),
			);
			$fa_classes = array(
				'googleplus' => 'fa-google-plus',
				'vimeo' => 'fa-vimeo-square',
			)
		?>
		<ul class="social-nav">
			<?php
			foreach ( $briar_footer_social_buttons as $social_button ) :
				if ( isset( $social_button['css_class'] ) && isset( $social_button['url'] ) && isset( $social_button['social'] ) ) :
			?>
			<li class="<?php echo esc_attr( $social_button['css_class'] . '-ico social-nav__item btn--transition' ); ?>">
				<a class="social-nav__link" href="<?php echo esc_url( $social_button['url'] ); ?>" title="<?php echo esc_attr( isset( $social_buttons_default_titles[ $social_button['social'] ] ) ? $social_buttons_default_titles[ $social_button['social'] ] : $social_button['social'] ); ?>" target="_blank">
					<i class="fa <?php if ( isset( $fa_classes[ strtolower( $social_button['social'] ) ] ) ) : echo esc_attr( $fa_classes[ strtolower( $social_button['social'] ) ] ); else : ?><?php echo esc_attr( 'fa-' . $social_button['css_class'] ); ?><?php endif; ?>"></i>
				</a>
			</li>
			<?php
				endif;
			endforeach;
		?>
		</ul>
		<?php
		endif;
	}
endif;

if ( ! function_exists( 'briar_pagination' ) ) :
	/**
	 * Display pagination with previous and next arrows.
	 *
	 * @since 1.0
	 */
	function briar_pagination() {
		global $wp_query, $post;

		if ( is_single() ) {
			wp_link_pages( array(
				'before' => '<ul class="pagination">',
				'after' => '</ul>',
				'separator' => '',
			) );
			return;
		}

		// Don't print empty markup if Jetpack infinite scroll is activated.
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) : ?>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<a class="btn--more-posts btn--transition" id="infinite-handle" href="javascript:void(null)" data-text="<?php esc_attr_e( 'Load more blog posts', 'briar' ); ?>" data-loading="<?php esc_attr_e( 'Loading...', 'briar' ); ?>"><?php esc_html_e( 'Load more blog posts', 'briar' ); ?></a>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<div>
		<?php
			return;
		endif;

		// Don't print empty markup in archives if there's only one page.
		if ( 2 > $wp_query->max_num_pages ) {
			return;
		}
		?>
		<div class="post-list-nav">
			<div class="post-list-nav__prev">
				<?php next_posts_link( __( 'Older posts', 'briar' ), $wp_query->max_num_pages ); ?>
			</div>
			<div class="post-list-nav__next">
				<?php previous_posts_link( __( 'Newer posts', 'briar' ) ); ?>
			</div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'briar_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since 1.0
	 */
	function briar_posted_on() {
		?>
		<p>
			<?php
			/* translators: %1$s is a post link and %2$s is a post date */
			echo sprintf( esc_html_x( '%2$s on %1$s', 'post date', 'briar' ), sprintf( '<time datetime="%1$s">%2$s</time>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() ) ), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>' );
			?>
		</p>
		<?php
	}
	endif;

if ( ! function_exists( 'briar_share_buttons' ) ) :
	/**
	 * Display share buttons.
	 *
	 * @param array $classes Optional, additional classes.
	 * @since 1.0
	 */
	function briar_share_buttons( $classes = array() ) {
		global $post;

		$briar_share_buttons_on = get_theme_mod( 'briar_share_buttons_on', true );
		$briar_share_buttons_via = get_theme_mod( 'briar_share_buttons_via', 'slicejack' );
		$briar_share_buttons = get_theme_mod( 'briar_share_buttons', array( 'twitter', 'facebook', 'googleplus', 'pinterest', 'linkedin' ) );
		$briar_share_buttons_home_on = get_theme_mod( 'briar_share_buttons_home_on', true );
		$briar_share_buttons_archive_on = get_theme_mod( 'briar_share_buttons_archive_on', true );
		$briar_share_buttons_search_on = get_theme_mod( 'briar_share_buttons_search_on', true );
		$briar_share_buttons_single_top_on = get_theme_mod( 'briar_share_buttons_single_top_on', true );
		$briar_share_buttons_single_bottom_on = get_theme_mod( 'briar_share_buttons_single_bottom_on', true );

		if ( ( empty( $post->ID ) || empty( $briar_share_buttons_on ) || empty( $briar_share_buttons ) || ( is_home() && ! $briar_share_buttons_home_on ) || ( is_archive() && ! $briar_share_buttons_archive_on ) || ( is_search() && ! $briar_share_buttons_search_on ) || ( is_single() && ( ( in_array( 'blog-post-share-links-top', $classes ) && ! $briar_share_buttons_single_top_on ) || ( in_array( 'blog-post-share-links-bottom', $classes ) && ! $briar_share_buttons_single_bottom_on ) ) ) ) && ! is_customize_preview() ) {
			return;
		}

		wp_enqueue_script( 'briar-sharrre' );

		array_unshift( $classes, 'briar-share-buttons' );

		$share_url = get_permalink( $post->ID );
		$share_text = get_the_title( $post );
		$share_media = has_post_thumbnail( $post->ID ) ? wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) : '';
		$share_via = '';
		if ( ! empty( $briar_share_buttons_via ) ) {
			$share_via = $briar_share_buttons_via;
		}

		$share_buttons = array(
			'twitter' => __( 'Tweet', 'briar' ),
			'facebook' => __( 'Like', 'briar' ),
			'googleplus' => __( '+1', 'briar' ),
			'pinterest' => __( 'Pin it', 'briar' ),
			'linkedin' => __( 'Share on LinkedIn', 'briar' ),
			'digg' => __( 'Digg it!', 'briar' ),
			'delicious' => __( 'Share on Delicious', 'briar' ),
			'stumbleupon' => __( 'Stumble', 'briar' ),
		);

		$sharrre_url = get_template_directory_uri() . '/inc/sharrre.php';

		if ( is_customize_preview() ) {
			$briar_share_buttons = array();
		}

		?>
		<div class="<?php echo esc_attr( join( ' ', $classes ) ); ?>" data-url="<?php echo esc_url( $share_url ); ?>" data-text="<?php echo esc_attr( $share_text ); ?>" data-media="<?php echo esc_url( $share_media ); ?>" data-urlcurl="<?php echo esc_url( $sharrre_url ); ?>" data-via="<?php echo esc_attr( $share_via ); ?>">
		<?php foreach ( $briar_share_buttons as $network ) :
			if ( isset( $share_buttons[ $network ] ) ) : ?>
			<div class="briar-share-button" data-network="<?php echo esc_attr( $network ); ?>" data-title="<?php echo esc_attr( $share_buttons[ $network ] ); ?>"><a class="box" href="javascript:void(null)"><div class="share-icon"></div><div class="count" href="javascript:void(null)">-</div></a></div>
			<?php endif;
		endforeach; ?>
		</div>
		<?php
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @since 1.0
 *
 * @return bool
 */
function briar_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'briar_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'briar_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so briar_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so briar_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in briar_categorized_blog.
 */
function briar_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'briar_categories' );
}
add_action( 'edit_category', 'briar_category_transient_flusher' );
add_action( 'save_post',     'briar_category_transient_flusher' );

/**
 * Display an optional post thumbnail or specific post format header.
 *
 * @since 1.0
 */
function briar_post_thumbnail() {
	if ( post_password_required() || is_attachment() ) {
		return;
	}

	if ( ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) : ?>
	<div class="hero-subheader__img">
		<?php the_post_thumbnail( 'briar-single-full-width' ); ?>
	</div><!-- /.single featured img -->
	<div class="hero-subheader__overlay" style="background-color: rgba(58, 58, 58, 0.3);"></div><!-- /.overlay -->
	<?php else :
		$thumbnail_id = get_post_thumbnail_id( get_the_id() );
		$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'briar-blog-post-image' );
	?>
	<div class="col-sm-4">
		<a href="<?php the_permalink(); ?>"><div class="post-item__img" style="<?php echo esc_attr( 'background-image: url(' . $thumbnail[0] . ');' ); ?>"></div></a>
	</div><!-- /.col -->
	<?php endif;
}

/**
 * If mbstring extension is not loaded then we use preg_replace function.
 *
 * @param string $pattern Search pattern.
 * @param string $replacement Replacement.
 * @param string $string String.
 * @return string
 */
function briar_mb_ereg_replace( $pattern, $replacement, $string ) {
	if ( extension_loaded( 'mbstring' ) ) {
		return mb_ereg_replace( $pattern, $replacement, $string );
	}

	return preg_replace( $pattern, $replacement, $string );
}

/**
 * If mbstring extension is not loaded then we use strlen function.
 *
 * @param string $string String.
 * @return integer
 */
function briar_mb_strlen( $string ) {
	if ( extension_loaded( 'mbstring' ) ) {
		return mb_strlen( $string );
	}

	return strlen( $string );
}

/**
 * If mbstring extension is not loaded then use we substr function.
 *
 * @param string $string String.
 * @param integer $start Substring start.
 * @param integer $length Substring length.
 * @return string
 */
function briar_mb_substr( $string, $start, $length ) {
	if ( extension_loaded( 'mbstring' ) ) {
		return mb_substr( $string, $start, $length );
	}

	return substr( $string, $start, $length );
}

/**
 * Display a post content
 *
 * @since 1.0
 */
function briar_post_content() {
	if ( has_post_thumbnail() && ! is_singular() ) {
		global $allowedposttags;
		$main_classes = briar_main_class( false );

		$content = '';
		if ( is_search() || is_archive() || ( has_excerpt() && ! is_singular() ) ) {
			$content = get_the_excerpt();
		} else {
			$content = strip_tags( get_the_content() );
		}

		$read_more = false;
		$content = trim( briar_mb_ereg_replace( '\s+', ' ', $content ) );

		$max_chars = 130;
		if ( in_array( 'col-md-12', $main_classes ) ) {
			$max_chars = 280;
		}

		if ( briar_mb_strlen( $content ) > $max_chars ) {
			$read_more = true;
			$content = briar_mb_substr( $content, 0, $max_chars ) . '...';
		}

		echo wp_kses( apply_filters( 'the_content', $content ), $allowedposttags );

		if ( $read_more ) {
			printf( '<p><a href="%2$s" class="post-item__btn btn--transition">%1$s</a></p>', sprintf( esc_html__( 'Read more%s', 'briar' ), '<span class="screen-reader-text"> ' . get_the_title() . '</span>' ), esc_url( get_permalink() ) );
		}
	} else {
		if ( ( has_excerpt() && ! is_singular() ) || ( 'audio' !== get_post_format() && 'video' !== get_post_format() && ( is_search() || is_archive() ) ) ) :
			the_excerpt();
			printf( '<p><a href="%2$s" class="post-item__btn btn--transition">%1$s</a></p>', sprintf( esc_html__( 'Read more%s', 'briar' ), '<span class="screen-reader-text"> ' . get_the_title() . '</span>' ), esc_url( get_permalink() ) );
		else :
			the_content( sprintf( __( 'Read more%s', 'briar' ), '<span class="screen-reader-text"> ' . get_the_title() . '</span>' ) );
		endif;
	}
}

/**
 * Parse chat content
 *
 * @param string $content Post content.
 * @since 1.0
 */
function briar_parse_chat_content( $content ) {
	return preg_replace( '/([a-z0-9 ]*)(\:)/mi', '<span class="username">$1</span>', $content );
}
