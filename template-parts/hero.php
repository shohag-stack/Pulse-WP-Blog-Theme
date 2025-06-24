<?php 

$pulse_header_title = get_theme_mod('pulse_header_title', __('Discover, Connect, Share', 'pulse')); 
?>

<section class="text-center py-16 px-6">
      <?php
        if (!empty($pulse_header_title)) {
            echo '<h1 class="text-4xl font-serif mb-4">' . esc_html($pulse_header_title) . '</h1>';
        } else {
            echo '<h1 class="text-4xl font-serif mb-4">' . __('Welcome to Pulse', 'pulse') . '</h1>';

        }
      ?>
      <p class="max-w-xl mx-auto mb-6 text-gray-600">
        <?php bloginfo("description"); ?>
      </p>
      <a href="#" class="inline-block bg-black text-white px-6 py-2 corner">Learn More</a>
    </section>