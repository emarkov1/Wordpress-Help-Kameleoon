<?php
	$showReverseText = mise_options('_onepage_reverse_slider', '1');
	$showScrollDown = mise_options('_onepage_scrolldown_slider', '1');
	$sliderSectionID = mise_options('_onepage_id_slider', 'slider');
	$slideImage = array();
	$slideText = array();
	$slideSubText = array();
	for( $number = 1; $number < MISE_VALUE_FOR_SLIDER; $number++ ){
		$slideImage["$number"] = mise_options('_onepage_image_'.$number.'_slider', '');
		$slideText["$number"] = mise_options('_onepage_text_'.$number.'_slider', '');
		$slideSubText["$number"] = mise_options('_onepage_subtext_'.$number.'_slider', '');
	}
?>
<section class="mise_slider <?php echo $showReverseText ? 'reverse' : 'classic' ?>" id="<?php echo esc_attr($sliderSectionID); ?>">
	<div class="flexslider">
	  <ul class="slides">
		<?php for( $number = 1; $number < MISE_VALUE_FOR_SLIDER; $number++ ) : ?>
			<?php if ($slideImage["$number"]) : ?>
				<li>
					<div class="flexImage" style="background-image: url(<?php echo esc_url($slideImage["$number"]); ?>);">
					</div>
					<div class="flexText">
						<div class="inside">
							<?php if ($slideText["$number"] || is_customize_preview()) : ?>
							<h2><?php echo esc_html($slideText["$number"]); ?></h2>
							<?php endif; ?>
							<?php if ($slideSubText["$number"] || is_customize_preview()) : ?>
							<span><?php echo esc_html($slideSubText["$number"]); ?></span>
							<?php endif; ?>
						</div>
					</div>
				</li>
			<?php endif; ?>
		<?php endfor; ?>
	  </ul>
	  <?php if ($showScrollDown) : ?>
		<div class="scrollDown"><span class="mouse-wheel"></span></div>
	<?php endif; ?>
	</div>
</section>