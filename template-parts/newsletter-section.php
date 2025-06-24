<?php
// Create: template-parts/newsletter-section.php

if (!get_theme_mod('pulse_newsletter_enable', true)) {
    return;
}

$newsletter_title = get_theme_mod('pulse_newsletter_title', __('Subscribe to our Newsletter', 'pulse'));
$newsletter_description = get_theme_mod('pulse_newsletter_description', __('Stay updated with our latest posts and news.', 'pulse'));
$newsletter_form = get_theme_mod('pulse_newsletter_form_shortcode', '');
?>

<section class="pulse-newsletter-section px-6 py-24 text-center">
    <div class="max-w-4xl mx-auto">
        <?php if (!empty($newsletter_title)): ?>
            <h2 class="text-4xl font-semibold mb-4">
                <?php echo esc_html($newsletter_title); ?>
            </h2>
        <?php endif; ?>
        
        <?php if (!empty($newsletter_description)): ?>
            <p class="text-lg mb-8 max-w-2xl mx-auto opacity-90">
                <?php echo esc_html($newsletter_description); ?>
            </p>
        <?php endif; ?>
        
        <?php if (!empty($newsletter_form)): ?>
            <div class="newsletter-form mt-8">
                <?php echo do_shortcode($newsletter_form); ?>
            </div>
        <?php else: ?>
            <!-- Fallback form or message -->
            <div class="newsletter-form-placeholder">
                <p class="text-sm opacity-75 mb-4">
                    <?php _e('Add your newsletter form shortcode in Customizer → Newsletter Section', 'pulse'); ?>
                </p>
                <div class="flex max-w-md mx-auto">
                    <input type="email" placeholder="<?php _e('Enter your email', 'pulse'); ?>" class="flex-1 px-4 py-3 rounded-l-lg text-gray-900">
                    <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-r-lg transition-colors">
                        <?php _e('Subscribe', 'pulse'); ?>
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>