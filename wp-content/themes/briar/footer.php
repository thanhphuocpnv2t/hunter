<?php
/**
 * The template for displaying the footer.
 *
 * @package Briar
 * @since 1.0
 */

?>
			<div id="map"></div>
			<footer>
				<div class="inner_sm">
					<div class="social">
						<a href="/" class="ft_lg">Hunter</a>
						<?php dynamic_sidebar('social-infomation' ); ?>
					</div>
				</div>
				<div class="copy">
					<p>Copyright &copy; <?php echo date('Y') ?> Hunter Studio. All rights reserved. Design by Thuy Pham</p>
				</div>
				<a href="#container" class="gotop">gotop</a>
			</footer>

			<?php wp_footer(); ?>
		</div>
		<?php $dir_temp = get_template_directory_uri(); ?>
		<script src="<?php echo $dir_temp; ?>/common/js/libs.js"></script>
		<script src="<?php echo $dir_temp; ?>/common/js/slick.js"></script>
		<script src="<?php echo $dir_temp; ?>/common/js/jquery.colorbox.js"></script>
		<script src="<?php echo $dir_temp; ?>/common/js/base.js"></script>
		<script src="<?php echo $dir_temp; ?>/common/js/map.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>
		<script src="<?php echo $dir_temp; ?>/common/js/responsive_watcher.js"></script>
	</body>
</html>
