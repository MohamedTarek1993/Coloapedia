 <?php
    class Wpc_Posts_List extends WP_Widget
    {
        function __construct()
        {
            parent::__construct('wpc_posts_list', 'Wpc_Posts_List', ['description' => 'This Widgets creates a post list ']);
        }

        function widget($args, $instance)
        {
            echo $args['before_widget'];
            $title = apply_filters('widget_title', $instance['title']);
            if (!empty($title)) {
                echo $args['before_title'] . $title . $args['after_title'];
            }
            $option = [];
            if (isset($instance['orderby']) && $instance['orderby'] == 'post_views') {
                $option['orderby'] = 'meta_value_num';
                $option['meta_key'] = 'wpc_post_views';
            } elseif (isset($instance['orderby']) && $instance['orderby'] == 'post_date') {
                $option['orderby'] = 'date';
            }
            if (isset($instance['order'])) {
                $option['order'] = $instance['order'];
            }
            if (isset($instance['posts_count'])) {
                $option['numberposts'] = $instance['posts_count'];
            }
            $popular_posts = get_posts($option);


            if (count($popular_posts)) {
                echo '<div class="blog-list-widget"><div class="list-group">';
                foreach ($popular_posts as $post) {
    ?>
                 <a href="<?php echo get_permalink($post) ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                     <div class="w-100 justify-content-between">
                         <?php echo get_the_post_thumbnail($post, 'thumbnail', ['class' => 'img-fluid float-left']); ?>
                         <h5 class="mb-1"><?php echo $post->post_title; ?></h5>
                         <small>
                             <?php
                                if (isset($instance['alt_content']) && $instance['alt_content'] == 'post_views') { ?>
                                 <i class="fa fa-eye"></i> <?php echo ((int)get_post_meta($post->ID, 'wpc_post_views', true)); ?>

                             <?php
                                } else {
                                    echo get_the_date('d M, Y', $post);
                                }
                                ?>
                         </small>
                     </div>
                 </a>
         <?php
                }
                echo '</div></div>';
            }
            echo $args['after_widget'];
        }
        function form($instance)
        {
            // field title name in widget
            if (isset($instance['title'])) {
                $title = $instance['title'];
            } else {
                $title = 'Popular Posts';
            }
            // field count in widget
            if (isset($instance['posts_count'])) {
                $posts_count = $instance['posts_count'];
            } else {
                $posts_count = 3;
            }

            // field type content in widget
            if (isset($instance['alt_content'])) {
                $alt_content = $instance['alt_content'];
            } else {
                $alt_content = 'post_date';
            }

            // field orderby in widget
            if (isset($instance['orderby'])) {
                $orderby = $instance['orderby'];
            } else {
                $orderby = 'post_views';
            }

            // field orderby in widget
            if (isset($instance['order'])) {
                $order = $instance['order'];
            } else {
                $order = 'DESC';
            }

            ?>
         <!-- field title name in widget -->
         <p>
             <label for="<?php echo $this->get_field_id('title'); ?>"> Widget Title</label>
             <input id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>">
         </p>

         <!-- field count in widget -->
         <p>
             <label for="<?php echo $this->get_field_id('posts_count'); ?>"> NO.of Posts</label>
             <input id="<?php echo $this->get_field_id('posts_count'); ?>" type="number" name="<?php echo $this->get_field_name('posts_count'); ?>" value="<?php echo esc_attr($posts_count); ?>" min="1">
         </p>

         <!-- field type content in widget -->
         <p>
             <label for="<?php echo $this->get_field_id('alt_content'); ?>"> Type Of Content</label>
             <select id="<?php echo $this->get_field_id('alt_content'); ?>" name="<?php echo $this->get_field_name('alt_content'); ?>">
                 <option value="post_date" <?php echo ($alt_content == 'post_date') ? 'selected' : ''; ?>> Post Date</option>
                 <option value="post_views" <?php echo ($alt_content == 'post_views') ? 'selected' : ''; ?>> Post Views</option>
             </select>
         </p>

         <!-- field orderby  in widget -->
         <p>
             <label for="<?php echo $this->get_field_id('orderby'); ?>"> Order By</label>
             <select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
                 <option value="post_date" <?php echo ($orderby == 'post_date') ? 'selected' : ''; ?>> Post Date</option>
                 <option value="post_views" <?php echo ($orderby == 'post_views') ? 'selected' : ''; ?>> Post Views</option>
             </select>
         </p>

         <!-- field order  in widget -->
         <p>
             <label for="<?php echo $this->get_field_id('order'); ?>"> Order</label>
             <select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
                 <option value="DESC" <?php echo ($order == 'DESC') ? 'selected' : ''; ?>> High to low</option>
                 <option value="ASC" <?php echo ($order == 'ASC') ? 'selected' : ''; ?>> Low to high</option>
             </select>
         </p>
 <?php

        }

        // update widgets field
        function update($new_instance, $old_instance)
        {
            $new_data = [];
            $new_data['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : $old_instance['title'];
            $new_data['posts_count'] = (isset($new_instance['posts_count']) && is_numeric($new_instance['posts_count'])
                && $new_instance['posts_count'] > 0) ? ((int)($new_instance['posts_count'])) : $old_instance['posts_count'];
            $new_data['alt_content'] = (in_array($new_instance['alt_content'], ['post_views', 'post_date'])) ? $new_instance['alt_content'] : $old_instance['alt_content'];
            $new_data['orderby'] = (in_array($new_instance['orderby'], ['post_views', 'post_date'])) ? $new_instance['orderby'] : $old_instance['orderby'];
            $new_data['order'] = (in_array($new_instance['order'], ['DESC', 'ASC'])) ? $new_instance['order'] : $old_instance['order'];

            return $new_data;
        }
    }
