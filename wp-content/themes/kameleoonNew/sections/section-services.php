<?php $showServices = mise_options('_onepage_section_services', ''); ?>
<?php if ($showServices == 1) : ?>
	<?php
		$servicesSectionID = mise_options('_onepage_id_services', 'services');
		$servicesTitle = mise_options('_onepage_title_services', __('Services', 'mise'));
		$servicesSubTitle = mise_options('_onepage_subtitle_services', __('What We Offer', 'mise'));
		$servicesPhrase = mise_options('_onepage_phrase_services', '');
		$servicesTextarea = mise_options('_onepage_textarea_services', '');
		$servicesImage = mise_options('_onepage_servimage_services');
		$textLenght = mise_options('_onepage_lenght_services', '30');
		$customMore = mise_options('_excerpt_more', '&hellip;');
		$singleServiceBox = array();
		$singleServiceFont = array();
		for( $number = 1; $number < MISE_VALUE_FOR_SERVICES; $number++ ){
			$singleServiceBox["$number"] = mise_options('_onepage_choosepage_'.$number.'_services', '');
			$singleServiceFont["$number"] = mise_options('_onepage_fontawesome_'.$number.'_services', '');
		}
	?>
<section class="mise_services" id="<?php echo esc_attr($servicesSectionID); ?>">
	<div class="mise_services_color"></div>
	<div class="mise_action_services">
		<?php if($servicesTitle || is_customize_preview()): ?>
			<h2 class="misee_main_text"><?php echo esc_html($servicesTitle); ?></h2>
		<?php endif; ?>
		<?php if($servicesSubTitle || is_customize_preview()): ?>
			<p class="mise_subtitle"><?php echo esc_html($servicesSubTitle); ?></p>
		<?php endif; ?>
		<div class="services_columns">
			<div class="one services_columns_single">
				<div class="singleServiceContent">
				<?php for( $number = 1; $number < MISE_VALUE_FOR_SERVICES; $number++ ) : ?>
					<?php if ($singleServiceBox["$number"]) : ?>
						<div class="singleService">
							<div class="serviceIcon"><div class="serviceIconCyrcle"></div><i class="<?php echo esc_attr($singleServiceFont["$number"]); ?>" aria-hidden="true"></i></div>
							<div class="serviceText">
								<h3><?php echo get_the_title(intval($singleServiceBox["$number"])); ?></h3>
								<?php
								$post_contentt = get_post(intval($singleServiceBox["$number"]));
								$content = $post_contentt->post_content;
								?>
								<p><?php echo wp_trim_words($content , intval($textLenght), esc_html($customMore) ); ?></p>
							</div>
						</div>
					<?php endif; ?>
				<?php endfor; ?>
				</div>
			</div>
			<div class="two services_columns_single" style="background-image: url(<?php echo esc_url($servicesImage); ?>);">
				<div class="serviceColumnSingleColor"></div>
				<div class="serviceContent">
					<?php if ($servicesPhrase || is_customize_preview()): ?>
						<h3><?php echo esc_html($servicesPhrase); ?></h3>
					<?php endif; ?>
					<?php if ($servicesTextarea || is_customize_preview()): ?>
						<p><?php echo wp_kses($servicesTextarea, mise_allowed_html()); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>