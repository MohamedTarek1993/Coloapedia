<?php

class Wpc_Search extends WP_Widget
{
    function __construct()
    {
        parent::__construct('wpc_search', 'Wpc_Search', ['description' => 'This Widgets For Search']);
    }

    function widget($args, $instance)
    {
        echo $args['before_widget'];

        
        $title = apply_filters('widget_title', $instance['title']);
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
?>

        <form class="form-inline search-form">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="<?php echo esc_attr( $instance['placeholder'] ) ;?>">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </form>


    <?php

        echo $args['after_widget'];
    }


    function form($instance)
    {
        // field title name in widget
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = 'Search';
        }

           // field placeholder name in widget
           if (isset($instance['placeholder'])) {
            $placeholder = $instance['placeholder'];
        } else {
            $placeholder = 'Search on the site';
        }

    ?>
        <!-- field title name in widget -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"> Widget Title</label>
            <input id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>">
        </p>

        <!-- field  placeholder in widget -->
        <p>
            <label for="<?php echo $this->get_field_id('placeholder'); ?>">  Placeholder</label>
            <input id="<?php echo $this->get_field_id('placeholder'); ?>" type="text" name="<?php echo $this->get_field_name('placeholder'); ?>" value="<?php echo esc_attr($placeholder); ?>">
        </p>

<?php
    }

    // update widgets field
    function update($new_instance, $old_instance)
    {
        $new_data = [];
        $new_data['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : $old_instance['title'];
        $new_data['placeholder'] = (!empty($new_instance['placeholder'])) ? strip_tags($new_instance['placeholder']) : $old_instance['placeholder'];

        return $new_data ;

    }
}

