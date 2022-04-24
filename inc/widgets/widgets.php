<?php 

require 'posts_list.php' ;
require 'sidebars.php';
require 'search.php';
require 'instgram.php';
require 'categories.php';


add_action( 'widgets_init' , function() {

    register_widget('Wpc_Instgrame');
    register_widget('Wpc_Search');
    register_widget('Wpc_Posts_List');
    register_widget('Wpc_Categories');


});