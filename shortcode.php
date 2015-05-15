<?php

if(!class_exists('Client_Testimonials_Shortcode')):

class Client_Testimonials_Shortcode {

	public static function get_testimonial_new($posts_per_page = -1, $orderby = 'none'){
	
		ob_start();

		$args = array(
			'posts_per_page' => (int) $posts_per_page,
			'post_type' => 'testimonials',
			'orderby' => $orderby,
			'no_found_rows' => true
		);

		$query = new WP_Query( $args  );

		if ( $query->have_posts() ):
			while ( $query->have_posts() ) : $query->the_post();

			$testimonial = get_post_meta( get_the_ID(), '_testimonial', true );
			$client_name = ( empty( $testimonial['client_name'] ) ) ? '' : $testimonial['client_name'];
			$client_source = ( empty( $testimonial['source'] ) ) ? '' : $testimonial['source'];
			$client_link = ( empty( $testimonial['link'] ) ) ? '' : $testimonial['link'];

			?>
				<!-- SINGLE FEEDBACK -->
				<div class="single-feedback">
	                <?php if ( has_post_thumbnail() ): ?>
						<div class="client-pic">
	                		<?php the_post_thumbnail( array(64,64)); ?>
						</div>
	                <?php endif; ?>
					<div class="box">
						<p class="message">
							<?php echo get_the_content(); ?>
						</p>
					</div>
					<div class="client-info">
						<div class="client-name colored-text strong">
							<?php echo $client_name; ?>
						</div>
						<div class="company">
							<a href="<?php echo $client_link; ?>" target="_blank">
								<?php echo $client_source; ?>
							</a>
						</div>
					</div>
				</div>
				<!-- SINGLE FEEDBACK -->
			<?php
			endwhile;
		endif;wp_reset_query();

		$feedback = ob_get_clean();
		return $feedback;
	}

	public static function testimonials_slide( $items_desktop = 4, $items_tablet = 3, $items_tablet_small = 2, $items_mobile = 1, $posts_per_page = -1, $orderby = 'none'){
		ob_start();

		$id = rand(0, 99);
		?>
		<div class="row">
		    <div id="testimonials-<?php echo $id; ?>" class="owl-carousel">
		    	<?php echo self::get_testimonial_new($posts_per_page, $orderby); ?>
		    </div>
		</div>
	    <script type="text/javascript">
			jQuery(document).ready(function($) {
	  			$('#testimonials-<?php echo $id; ?>').owlCarousel({
					items : <?php echo $items_desktop; ?>,
					nav : true,
					dots: false,
					loop : true,
					autoplay: true,
					autoplayHoverPause: true,
					responsiveClass:true,
				    responsive:{
				        320:{ items:<?php echo $items_mobile; ?> }, // Mobile portrait
				        600:{ items:<?php echo $items_tablet_small; ?> }, // Small tablet portrait
				        768:{ items:<?php echo $items_tablet; ?> }, // Tablet portrait
				        979:{ items:<?php echo $items_desktop; ?> }  // Desktop
				    }
				});
			});
	    </script>
		<?php
		$feedback = ob_get_clean();
		return $feedback;
	}

	public static function testimonials_slide_shortcode( $atts, $content = null ){
		extract(shortcode_atts(array(
	                        'items_desktop' => 1,
	                        'items_tablet' => 1,
	                        'items_tablet_small' => 1,
	                        'items_mobile' => 1,
	                        'posts_per_page' => -1,
	                        'orderby' => 'none'
	                ), $atts));

		return self::testimonials_slide($items_desktop, $items_tablet, $items_tablet_small, $items_mobile, $posts_per_page, $orderby );
	}

	/**
	 * Display a testimonial
	 *
	 * @param	int $post_per_page  The number of testimonials you want to display
	 * @param	string $orderby  The order by setting  https://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
	 * @param	array $testimonial_id  The ID or IDs of the testimonial(s), comma separated
	 *
	 * @return	string  Formatted HTML
	 */
	public static function get_testimonial( $posts_per_page = 1, $orderby = 'none', $testimonial_id = null ) {
		$args = array(
			'posts_per_page' => (int) $posts_per_page,
			'post_type' => 'testimonials',
			'orderby' => $orderby,
			'no_found_rows' => true,
		);
		if ( $testimonial_id )
			$args['post__in'] = array( $testimonial_id );

		$query = new WP_Query( $args  );

		$testimonials = '';
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) : $query->the_post();
				$post_id = get_the_ID();
				$testimonial_data = get_post_meta( $post_id, '_testimonial', true );
				$client_name = ( empty( $testimonial_data['client_name'] ) ) ? '' : $testimonial_data['client_name'];
				$source = ( empty( $testimonial_data['source'] ) ) ? '' : ' - ' . $testimonial_data['source'];
				$link = ( empty( $testimonial_data['link'] ) ) ? '' : $testimonial_data['link'];
				$cite = ( $link ) ? '<a href="' . esc_url( $link ) . '" target="_blank">' . $client_name . $source . '</a>' : $client_name . $source;

				$testimonials .= '<aside class="testimonial">';
				$testimonials .= '<span class="quote">&ldquo;</span>';
				$testimonials .= '<div class="entry-content">';
				$testimonials .= '<p class="testimonial-text">' . get_the_content() . '<span></span></p>';
				$testimonials .= '<p class="testimonial-client-name"><cite>' . $cite . '</cite>';
				$testimonials .= '</div>';
				$testimonials .= '</aside>';

			endwhile;
			wp_reset_postdata();
		}

		return $testimonials;
	}

	/**
	 * Shortcode to display testimonials
	 *
	 * This functions is attached to the 'testimonial' action hook.
	 *
	 * [testimonial posts_per_page="1" orderby="none" testimonial_id=""]
	 */
	public static function testimonial_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'posts_per_page' => '1',
			'orderby' => 'none',
			'testimonial_id' => '',
		), $atts ) );

		return self::get_testimonial( $posts_per_page, $orderby, $testimonial_id );
	}

}

add_shortcode( 'testimonial', array( 'Client_Testimonials_Shortcode', 'testimonial_shortcode' ) );
add_shortcode( 'testimonials-slider', array( 'Client_Testimonials_Shortcode', 'testimonials_slide_shortcode' ) );
add_shortcode( 'client-testimonials', array( 'Client_Testimonials_Shortcode', 'testimonials_slide_shortcode' ) );
endif;