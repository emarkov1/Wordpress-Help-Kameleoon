<?php $showSkills = mise_options('_onepage_section_skills', ''); ?>
<?php if ($showSkills == 1) : ?>
	<?php
		$skillsSectionID = mise_options('_onepage_id_skills', 'skills');
		$skillsTitle = mise_options('_onepage_title_skills', __('Our Skills', 'mise'));
		$skillsSubTitle = mise_options('_onepage_subtitle_skills', __('What We Do', 'mise'));
		$skillName = array();
		$skillValue = array();
		for( $number = 1; $number < MISE_VALUE_FOR_SKILLS; $number++ ){
			$skillName["$number"] = mise_options('_onepage_skillname_'.$number.'_skills', '');
			$skillValue["$number"] = mise_options('_onepage_skillvalue_'.$number.'_skills', '');
		}
	?>
<section class="mise_skills" id="<?php echo esc_attr($skillsSectionID); ?>">
	<div class="mise_skills_color"></div>
	<div class="mise_action_skills">
	<?php if($skillsTitle || is_customize_preview()): ?>
		<h2 class="misee_main_text"><?php echo esc_html($skillsTitle); ?></h2>
	<?php endif; ?>
	<?php if($skillsSubTitle || is_customize_preview()): ?>
		<p class="mise_subtitle"><?php echo esc_html($skillsSubTitle); ?></p>
	<?php endif; ?>
		<div class="skills_columns">
			<?php for( $number = 1; $number < MISE_VALUE_FOR_SKILLS; $number++ ) : ?>
				<?php if ($skillName["$number"]) : ?>
					<div class="miseSkill">
						<div class="skillTop">
							<div class="skillName"><?php echo esc_html($skillName["$number"]); ?></div>
							<div class="skillNameUnder"><?php echo esc_html($skillName["$number"]); ?></div>
							<div class="skillValue" data-delay="<?php echo intval($number * 150) ?>"><span><?php echo intval($skillValue["$number"]); ?></span><i><?php esc_html_e('%', 'mise'); ?></i></div>
						</div>
						<div class="skillBottom">
							<div class="skillBar"></div>
							<div class="skillRealBar" data-number="<?php echo intval($skillValue["$number"]); ?>%" data-delay="<?php echo intval($number * 150) ?>"><div class="skillRealBarCyrcle"></div></div>
						</div>
					</div>
				<?php endif; ?>
			<?php endfor; ?>
		</div>
	</div>
</section>
<?php endif; ?>