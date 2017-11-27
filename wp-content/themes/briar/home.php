<?php
/**
 * The home/blog template file.
 *
 * @package Briar
 * @since 1.0
 */

global $allowedposttags;

get_header();
?>
<?php $dir_temp = get_template_directory_uri(); ?>
	<div id="contents" class="contents">
		<div class="section slider" id="main">
			<div class="section slider" id="main">
				<ul class="section_content element banner_list" id="banner_list">
				<?php
				$args = array(
					'post_type' => 'slider-header',
					'orderby' => 'ID',
					'order'   => 'ASC',
				);
				$slider_query = new WP_Query($args);
				if(count($slider_query->posts) > 0) {
					foreach ($slider_query->posts as $key => $post) { ?>
						<li>
							<img src="<?php echo get_post_meta($post->ID, 'wpcf-slider-header-image', true); ?>" class="resimg" alt="thumb">
							<?php if($key == 0){ ?>
							<figure><img src="<?php echo $dir_temp; ?>/images/caption1_pc.png" class="resimg" alt="thumb"></figure>
							<?php } ?>
						</li>
					<?php }
				}?>
				</ul>
			</div>
		</div>
		<main class="main">
			<section class="section about_us">
				<div class="inner_sm">
					<div class="section_content element translateup" id="about_us">
						<?php dynamic_sidebar('about-us'); ?>
					</div>
				</div>
			</section>
			<section class="section project">
				<div class="element translatedown section_content" id="project">
					<h3 class="ttl">New<span>project</span><a href="<?php echo home_url( '/exteriors' ); ?>" class="see_more">see more</a></h3>
					<div class="element translatedown pro_gallery" id="pro_gallery">
						<?php
						$args = array(
							'post_type' => 'project-in-home-page',
							'orderby' => 'ID',
							'order'   => 'ASC',
						);
						$project_query = new WP_Query($args);
						if(count($project_query->posts) > 0){
							foreach ($project_query->posts as $key=>$post) {
								if ($key < 8) { ?>
								<figure>
									<a href="<?php echo get_post_meta($post->ID, 'wpcf-image', true); ?>" class="img-path">
										<img src="<?php echo get_post_meta($post->ID, 'wpcf-image-thumb', true); ?>" alt="<?php echo $post->post_title; ?>">
										<div>
											<h3><?php echo $post->post_title; ?></h3>
											<figure><img src="<?php echo $dir_temp; ?>/common/images/gl_hv.png" alt="<?php echo $post->post_title; ?>"></figure>
										</div>
									</a>
								</figure>
								<?php
								}
							}
						}
						?>
					</div>
				</div>
			</section>
			<section class="section staff">
				<div class="inner_sm">
					<div class="section_content" id="staff">
						<h3 class="ttl element translateup">our <span>team</span></h3>
						<div class="list_staff">
							<ul class="list_staff_item">
								<?php
								$args = array(
									'post_type' => 'team-member',
									'orderby' => 'ID',
									'order'   => 'ASC',
								);
								$member_query = new WP_Query($args);
								if(count($member_query->posts) > 0){
									foreach ($member_query->posts as $post){?>
										<li>
											<figure><img src="<?php echo get_post_meta($post->ID, 'wpcf-avatar-member', true); ?>" alt="<?php echo $post->post_title; ?>"></figure>
											<div>
												<h3><?php echo $post->post_title; ?></h3>
												<p><?php echo get_post_meta($post->ID, 'wpcf-position', true); ?></p>
											</div>
										</li>
									<?php }
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<section class="section welcome">
				<div class="inner_sm">
					<div class="section_content element translatedown">
						<h3>Hunter 3D Visualizations</h3>
						<?php dynamic_sidebar( 'visualizations' ); ?>
					</div>
				</div>
			</section>
			<section class="section contact">
				<div class="inner_sm">
					<div class="section_content element translateup" id="contact">
						<h3 class="ttl">Let's <span>get in touch</span></h3>
						<div class="cont_contents ">
							<?php dynamic_sidebar( 'contact-infomation' ); ?>
							<div class="cont_right">
								<?php echo do_shortcode( '[contact-form-7 id="17" title="Contact Form"]'); ?>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>
	</div>

<?php get_footer();
