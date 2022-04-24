<?php
    class Wpc_Categories extends WP_Widget
    {
        function __construct()
        {
            parent::__construct('wpc_category', 'Wpc_Categories', ['description' => 'This Widgets creates a categorie ']);
        }

        function widget($args, $instance)
        {
            echo $args['before_widget'];

            $title = apply_filters('widget_title', $instance['title']);
            if (!empty($title)) {
                echo $args['before_title'] . $title . $args['after_title'];
            }
            ?>
             <ul>
                        <?php 
                        $popular_categories = get_terms([
                            'taxonomy'   =>'category',
                            'orderby'    => 'count' ,
                            'order'      => 'DESC',
                            'hide_empty' => true ,
                        ]);
                        if(is_array($popular_categories)) :
                            foreach($popular_categories as $category) :
                            echo ' <li><a href=" '. get_term_link( $category ) .'"> '. $category->name .' <span>('.$category->count .')</span></a></li>' ;
                       
                        endforeach ;
                        endif ;
                        ?>
                         </ul>

                         <?php
            echo $args['after_widget'];

        }

        function form($instance)
        {
            // field title name in widget
            if (isset($instance['title'])) {
                $title = $instance['title'];
            } else {
                $title = 'Categories';
            }

            ?>
                <!-- field title name in widget -->
         <p>
             <label for="<?php echo $this->get_field_id('title'); ?>"> Widget Title</label>
             <input id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>">
         </p>   
            <?php
        }


        function update($new_instance, $old_instance)
        {
            $new_data = [];
            $new_data['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : $old_instance['title'];

            return $new_data ;
        }
    }