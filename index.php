
    <?php
    get_header();
    ?>

    <!-- Hero -->
    <?php 
        get_template_part('template-parts/hero');
    ?>

    <!-- Featured + Recent -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-8 px-6 py-10">
      <!-- Feature Post -->

      <?php
        $pulse_featured_posts = new WP_Query(
            array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'meta_query' => array(
                    array(
                        'key' => 'featured_post',
                        'value' => true,
                        'orderby' => 'date',
                    )
                ),
            )
        );

        $pulse_featured_post_id = null;
        if ($pulse_featured_posts->have_posts()) {
            while ($pulse_featured_posts->have_posts()) {
                $pulse_featured_posts->the_post();
                $pulse_featured_post_id = get_the_ID();
                ?>
                        <div>
                <img src="<?php echo esc_url( get_the_post_thumbnail_url($pulse_featured_post_id, 'full') ); ?>" alt="<?php the_title(); ?>" class="w-full mb-4 corner">
                <div class="flex flex-direction-col justify-between">
                    <div class="author flex justify-content-center items-center mb-2">
                        <?php 
                            echo get_avatar(get_the_author_meta("ID"), 50, '', get_the_author());
                        ?>
                        <span class="ml-2"><?php the_author(); ?></span>     <div class="text-sm text-gray-500"></div>
                    </div>
                    <div class="text-sm text-gray-500"> <?php the_date() ?></div>
                </div>
                <a href="<?php echo esc_url(get_permalink()); ?>"> <h2 class="text-3xl font-semibold mt-2 mb-1"> <?php the_title(); ?> </h2> </a>
                <p class="text-sm text-gray-600"> <?php the_excerpt() ?></p>
                <a href="<?php echo esc_url(get_permalink()); ?>" class="text-blue-500 text-sm"><?php _e("View Post", "pulse"); ?></a>
            </div>

      <?php

            }
        }
        
        wp_reset_postdata();
        

      ?>

      <!-- Recent Posts -->
      <div class="space-y-6">

        <?php
        $pulse_featured_posts = new WP_Query(
            array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post__not_in' => [$pulse_featured_post_id], // Exclude the featured post
                'orderby' => 'date'
            )
        );

        if ($pulse_featured_posts->have_posts()) {
            while ($pulse_featured_posts->have_posts()) {
                $pulse_featured_posts->the_post();
                ?>
                        <div class="flex gap-4">
                            <img src="<?php echo esc_url( get_the_post_thumbnail_url(get_the_ID(), 'full') ); ?>" class="w-24 h-24 object-cover corner" />
                            <div>
                                <div class="text-sm text-gray-400"> <?php echo get_the_date(); ?></div>
                                <a href="<?php echo esc_url(get_permalink()) ?>"> <h4 class="text-xl font-medium leading-tight"> <?php the_title() ?></h4> </a>
                                <p>
                                    <?php
                                    $excerpt = get_the_excerpt();
                                    $excerpt = wp_trim_words($excerpt, 10, '...');
                                    echo esc_html($excerpt);
                                    ?>     </p>
                                <a href="<?php echo esc_url(get_permalink()) ?>" class="text-blue-500 text-sm">View Post</a>
                            </div>
                        </div>
                        <!-- Repeat 2 more times -->

      <?php

            }
        }

        wp_reset_postdata();

        ?>
            </div>
      </div>
      
    </section>

    <!-- Full Banner Post -->

    <?php 
       $pulse_banner_posts = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 1,
    'meta_query' => array(
        array(
            'key' => 'featured_post',
            'value' => true,
            'compare' => '='
        )
    )
));

        if ($pulse_banner_posts -> have_posts()) {
            while ($pulse_banner_posts -> have_posts()){
                $pulse_banner_posts->the_post();
                ?>
                <section class="relative py-[150px] px-6 bg-cover bg-center text-white" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>');">
                    <div class="text-center max-w-2xl mx-auto">
                        <span class="text-xs uppercase tracking-wide">Travel</span>
                        <a href="<?php echo esc_url(get_the_permalink()) ?>"> <h1 class="text-3xl md:text-4xl font-serif my-4"> <?php the_title(); ?></h1> </a>
                        <p class="inline-block text-white text-black px-6 corner"> <?php echo get_the_excerpt(); ?> </p>
                    </div>
                </section>
                <?php
            }
        }
        wp_reset_postdata();
    ?>

    <!-- Technology & Travel -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6 py-12">
      <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">

      <?php

        $pulse_tech_posts = new WP_Query(array(

            'post_type' => 'post',
            "posts_per_page" => 2,
            "category_name" => "sport",
            "orderby" => "date",

        ));

        if ($pulse_tech_posts-> have_posts()) {
            while ($pulse_tech_posts->have_posts()){
                $pulse_tech_posts->the_post();
                $pulse_tech_post_id = get_the_ID();
                ?>
                <div>
                    <img src="<?php echo esc_url( get_the_post_thumbnail_url(get_the_ID(), 'full') ); ?>" alt="<?php _e(the_title()) ?>" class="w-full mb-4 corner">
                    <div class="flex flex-direction-col justify-between">
                        <div class="author flex justify-content-center items-center mb-2">
                            <?php
                            $category = get_the_category();
                            if ( ! empty( $category ) ) {
                                echo '<span class="font-bold">' . esc_html( $category[0]->name ) . '</span>';
                            }
                            ?>     </div>
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
        <!-- Another tech post -->
      </div>
      <div>
        <h4 class="font-semibold mb-4">Travels</h4>
        <ul class="space-y-2 text-sm">

        <?php

        $pulse_travel_posts = new WP_Query(array(

            'post_type' => 'post',
            "posts_per_page" => 4,
            "category_name" => "travel",
            "orderby" => "date",

        ));

        if ($pulse_travel_posts-> have_posts()) {
            while ($pulse_travel_posts->have_posts()){
                $pulse_travel_posts->the_post();
                $pulse_travel_post_id = get_the_ID();
                ?>

                <li class="border-b pb-6 border-color-black-500">
                    <div class="flex gap-4">
                    <img src="<?php echo esc_url( get_the_post_thumbnail_url(get_the_ID(), 'full') ); ?>" class="w-28 h-20 object-cover corner" />
                    <div >
                        <a href="<?php echo esc_url(get_the_permalink()) ?>"> <h4 class="text-xl font-medium leading-tight mb-2"> <?php the_title() ?></h4> </a>
                        <div class="text-sm text-gray-400"> <?php echo esc_html(get_the_date()) ?></div>
                    </div>
                    </div>
                </li>
                
            <?php
            }
        }

     ?>
          
          <!-- More links -->
        </ul>
      </div>
    </section>

    <!-- Newsletter -->
    <section class="bg-black text-white px-6 py-[150px] text-center">
      <h2 class=" text-4xl mb-2">Join the Conversation:<br>Let Your Words Soar!</h2>
      <div class="mt-4">
        <input type="email" placeholder="Enter your email" class="px-4 py-2 corner text-black" />
        <button class="bg-blue-600 px-4 py-2 ml-2 corner">Subscribe</button>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white px-6 py-10 text-sm grid grid-cols-1 md:grid-cols-4 gap-6">
      <div>
        <p class="font-semibold">Fueling Creativity, Sparking Conversations.</p>
        <div class="mt-2 space-x-2">
          <a href="#">Facebook</a>
          <a href="#">Twitter</a>
          <a href="#">Instagram</a>
        </div>
      </div>
      <div>
        <h5 class="font-semibold mb-2">Categories</h5>
        <ul>
          <li><a href="#">All</a></li>
          <li><a href="#">Lifestyle</a></li>
          <li><a href="#">Fashion</a></li>
        </ul>
      </div>
      <div>
        <h5 class="font-semibold mb-2">Menu</h5>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Blog</a></li>
        </ul>
      </div>
      <div>
        <h5 class="font-semibold mb-2">Pages</h5>
        <ul>
          <li><a href="#">Coming Soon</a></li>
          <li><a href="#">404</a></li>
          <li><a href="#">Single-Blog</a></li>
        </ul>
      </div>
    </footer>
  </body>
    <?php wp_footer(); ?>
</html>