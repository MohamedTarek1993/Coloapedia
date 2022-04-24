<?php
$post_id = get_the_id();
?>
<div class="pitem item-w1 item-h1">
    <div class="blog-box">
        <div class="post-media">
            <a href="<?php echo get_permalink($post_id); ?>" title="">

                <?php if (has_post_thumbnail($post_id)) :
                    the_post_thumbnail('medium');
                endif; ?>

                <div class="hovereffect">
                    <span></span>
                </div><!-- end hover -->
            </a>
        </div><!-- end media -->
        <div class="blog-meta">
            <!-- catgory -->
            <?php
            $catgories = get_the_terms($post_id, 'category');
            if (is_array($catgories)) {
                foreach ($catgories as $catgory) {
                    echo '<span class="bg-grey"><a href="' . get_term_link($catgory) . '" title="">' . $catgory->name . '</a></span>';
                }
            }

            ?>
            <!-- catgory -->
            <h4><a href="<?php echo get_permalink($post_id); ?>" title=""><?php the_title(); ?></a></h4>
            <!-- AUTHOR META -->
            <small><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title=""><?php echo get_the_author_meta('display_name'); ?></a></small>
            <!-- AUTHOR META -->
            <!-- DATA META -->
            <small><a href="<? get_year_link(get_the_date('Y')); ?>" title=""><?php echo get_the_date('d M, Y', $post_id); ?></a></small>
            <!-- DATA META -->
        </div><!-- end meta -->
    </div><!-- end blog-box -->
</div><!-- end col -->