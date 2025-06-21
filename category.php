<?php
get_header();
?>
        <h1 class="text-4xl font-serif text-center my-8">
            <?php single_cat_title() ?>
        </h1>
<section class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6 py-12">
      <div class="md:col-span-3 grid grid-cols-3 sm:grid-cols-4 gap-6">
      <?php

        if (have_posts()) {
            while (have_posts()){
                the_post();
                ?>
                <div>
                    <img src="<?php echo esc_url( get_the_post_thumbnail_url(get_the_ID(), 'full') ); ?>" alt="<?php _e(the_title()) ?>" class="w-full mb-4 corner">
                    <div class="flex flex-direction-col justify-between">
                        <div class="author flex justify-content-center items-center mb-2">
                            <?php
                            $current_cat = get_queried_object();
                            $current_cat_id = $current_cat->term_id;
                            $categories = get_the_category();
                            if ( ! empty( $categories ) ) {
                                $matched = false;
                                foreach($categories as $category) {
                                    if ($category->term_id == $current_cat_id) {
                                        echo '<span class="font-bold">' . esc_html( $category->name ) . '</span>';
                                        $matched = true;
                                        break;
                                    }
                                }
                            }

                            ?>
                            
                    </div>
                        <div class="text-sm text-gray-500"><?php _e(get_the_date()) ?></div>
                    </div>
                    <a href="<?php echo esc_url(get_the_permalink()) ?>"> <h2 class="text-3xl font-semibold mt-2 mb-1"><?php _e(the_title()) ?></h2> </a>
                    <p class="text-sm text-gray-600"><?php _e(the_excerpt()) ?></p>
                    <a href="<?php echo esc_url(get_the_permalink()) ?>" class="text-blue-500 text-sm"> <?php _e("View Post", "pulse") ?></a>
                </div>
                
            <?php
            }
        }

     ?>
      </div>
    </section>