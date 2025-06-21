<!DOCTYPE html>
<html <?php language_attributes(); ?>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
  <body class="font-sans text-gray-800">
    <!-- Header -->
    <header class="flex items-center justify-between px-6 py-4 border-b bg-black">
      <h1 class="text-xl font-semibold text-white"><?php the_custom_logo(); ?></h1>
      <?php wp_nav_menu(
    array(
        'theme_location' => 'primary',
        'container' => false,
        'menu_class' => 'flex space-x-4 text-sm text-white', // ✅ Tailwind classes here
        'fallback_cb' => false,
    )
); ?>
    </header>