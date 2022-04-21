<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Coloapedia
 */
  
$post_id = get_the_ID();

// $x =   add_post_meta( $post_id, 'wpc_post_views' , 0 ) ;   //add post meta

$post_meta = get_post_meta($post_id);  //get post meta

$visit_count = ((int)($post_meta['wpc_post_views'][0])) + 1;


update_post_meta($post_id, 'wpc_post_views', $visit_count); //update post meta

get_header();

if (have_posts()) :
	while (have_posts()) : the_post();
?>

		<section class="section wb">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
						<div class="page-wrapper">
							<div class="blog-title-area">
								<ol class="breadcrumb hidden-xs-down">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item"><a href="#">Blog</a></li>
									<li class="breadcrumb-item active"><?php the_title(); ?></li>
								</ol>


								<!-- catgory -->
								<?php
								$catgories = get_the_terms($post_id, 'category');
								if (is_array($catgories)) {
									foreach ($catgories as $catgory) {
										echo '<span class="color-aqua"><a href="' . get_term_link($catgory) . '" title="">' . $catgory->name . '</a></span>';
									}
								}

								?>
								<!-- catgory -->



								<h3><?php echo  get_the_title(); ?></h3>

								<div class="blog-meta big-meta">
									<small><a href="<? get_year_link(get_the_date('Y')); ?>" title=""><?php echo get_the_date('d M, Y', $post_id); ?></a></small>
									<small><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title=""><?php echo get_the_author_meta('display_name'); ?></a></small>
									<small><a href="#" title=""><i class="fa fa-eye"></i> <?php echo $visit_count; ?></a></small>
								</div><!-- end meta -->

								<div class="post-sharing">
									<ul class="list-inline">

										<?php
										$link = get_permalink($post_id);
										?>
										<li><a target="__blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
										<li><a target="__blank" href="https://twitter.com/intent/tweet?url=<?php echo $link; ?>" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
									</ul>
								</div><!-- end post-sharing -->
							</div><!-- end title -->
                           <?php if(has_post_thumbnail( $post->ID )) : ?>
							<div class="single-post-media">
								<?php the_post_thumbnail(); ?>
							</div><!-- end media -->
                            <?php endif ; ?>
							<div class="blog-content">
								<?php the_content(); ?>
							</div><!-- end content -->

							<div class="blog-title-area">
								<div class="tag-cloud-single">
									<span>Tags</span>


									<!-- tags -->
									<?php the_tags('<small><a>', '</a> <a>', '</a></small>'); ?>
									<!-- tags -->


								</div><!-- end meta -->

								<div class="post-sharing">
									<ul class="list-inline">
										<li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
										<li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
										<li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
									</ul>
								</div><!-- end post-sharing -->
							</div><!-- end title -->

							<div class="row">
								<div class="col-lg-12">
									<div class="banner-spot clearfix">
										<div class="banner-img">
											<img src="<?php echo get_template_directory_uri(); ?>/assets/upload/banner_01.jpg" alt="" class="img-fluid">
										</div><!-- end banner-img -->
									</div><!-- end banner -->
								</div><!-- end col -->
							</div><!-- end row -->

							<hr class="invis1">
							<?php
							$next_post = get_next_post();
							$previous_post = get_previous_post();
							?>
							<div class="custombox prevnextpost clearfix">
								<div class="row">
									<div class="col-lg-6">
										<?php if(is_object($previous_post)) : ?>
										<div class="blog-list-widget">
											<div class="list-group">
												<a href="<?php echo get_permalink($previous_post->ID) ?>" class="list-group-item list-group-item-action flex-column align-items-start">
													<div class="w-100 justify-content-between text-right">
														<?php echo get_the_post_thumbnail($previous_post); ?>
														<h5 class="mb-1"><?php echo $previous_post->post_title; ?></h5>
														<small>Prev Post</small>
													</div>
												</a>
											</div>
										</div>
										<?php endif ?>
									</div><!-- end col -->

									<div class="col-lg-6">
									<?php if(is_object($next_post)) : ?>
										<div class="blog-list-widget">
											<div class="list-group">
												<a href="<?php echo get_permalink($next_post) ?>" class="list-group-item list-group-item-action flex-column align-items-start">
													<div class="w-100 justify-content-between">
														<?php echo get_the_post_thumbnail($next_post) ?>
														<h5 class="mb-1"><?php echo $next_post->post_title; ?></h5>
														<small>Next Post</small>
													</div>
												</a>
											</div>
										</div>
										<?php endif ; ?>
									</div><!-- end col -->
								</div><!-- end row -->
							</div><!-- end author-box -->

							<hr class="invis1">

							<div class="custombox authorbox clearfix">
								<h4 class="small-title">About author</h4>
								<div class="row">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<img src="upload/author.jpg" alt="" class="img-fluid rounded-circle">
									</div><!-- end col -->

									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<h4><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author_meta('display_name'); ?></a></h4>
										<p><?php echo get_the_author_meta('description'); ?></p>

										<div class="topsocial">
											<a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
											<a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
											<a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
											<a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
											<a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
											<a href="#" data-toggle="tooltip" data-placement="bottom" title="Website"><i class="fa fa-link"></i></a>
										</div><!-- end social -->

									</div><!-- end col -->
								</div><!-- end row -->
							</div><!-- end author-box -->

							<hr class="invis1">

							<div class="custombox clearfix">
								<h4 class="small-title">You may also like</h4>
								<div class="row">
									<div class="col-lg-6">
										<div class="blog-box">
											<div class="post-media">
												<a href="single.html" title="">
													<img src="upload/menu_06.jpg" alt="" class="img-fluid">
													<div class="hovereffect">
														<span class=""></span>
													</div><!-- end hover -->
												</a>
											</div><!-- end media -->
											<div class="blog-meta">
												<h4><a href="single.html" title="">We are guests of ABC Design Studio</a></h4>
												<small><a href="blog-category-01.html" title="">Trends</a></small>
												<small><a href="blog-category-01.html" title="">21 July, 2017</a></small>
											</div><!-- end meta -->
										</div><!-- end blog-box -->
									</div><!-- end col -->

									<div class="col-lg-6">
										<div class="blog-box">
											<div class="post-media">
												<a href="single.html" title="">
													<img src="upload/menu_07.jpg" alt="" class="img-fluid">
													<div class="hovereffect">
														<span class=""></span>
													</div><!-- end hover -->
												</a>
											</div><!-- end media -->
											<div class="blog-meta">
												<h4><a href="single.html" title="">Nostalgia at work with family</a></h4>
												<small><a href="blog-category-01.html" title="">News</a></small>
												<small><a href="blog-category-01.html" title="">20 July, 2017</a></small>
											</div><!-- end meta -->
										</div><!-- end blog-box -->
									</div><!-- end col -->
								</div><!-- end row -->
							</div><!-- end custom-box -->

							<hr class="invis1">

							<div class="custombox clearfix">
								<h4 class="small-title">3 Comments</h4>
								<div class="row">
									<div class="col-lg-12">
										<div class="comments-list">
											<div class="media">
												<a class="media-left" href="#">
													<img src="upload/author.jpg" alt="" class="rounded-circle">
												</a>
												<div class="media-body">
													<h4 class="media-heading user_name">Amanda Martines <small>5 days ago</small></h4>
													<p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag. Selfies iPhone Kickstarter, drinking vinegar jean.</p>
													<a href="#" class="btn btn-primary btn-sm">Reply</a>
												</div>
											</div>
											<div class="media">
												<a class="media-left" href="#">
													<img src="upload/author_01.jpg" alt="" class="rounded-circle">
												</a>
												<div class="media-body">

													<h4 class="media-heading user_name">Baltej Singh <small>5 days ago</small></h4>

													<p>Drinking vinegar stumptown yr pop-up artisan sunt. Deep v cliche lomo biodiesel Neutra selfies. Shorts fixie consequat flexitarian four loko tempor duis single-origin coffee. Banksy, elit small.</p>

													<a href="#" class="btn btn-primary btn-sm">Reply</a>
												</div>
											</div>
											<div class="media last-child">
												<a class="media-left" href="#">
													<img src="upload/author_02.jpg" alt="" class="rounded-circle">
												</a>
												<div class="media-body">

													<h4 class="media-heading user_name">Marie Johnson <small>5 days ago</small></h4>
													<p>Kickstarter seitan retro. Drinking vinegar stumptown yr pop-up artisan sunt. Deep v cliche lomo biodiesel Neutra selfies. Shorts fixie consequat flexitarian four loko tempor duis single-origin coffee. Banksy, elit small.</p>

													<a href="#" class="btn btn-primary btn-sm">Reply</a>
												</div>
											</div>
										</div>
									</div><!-- end col -->
								</div><!-- end row -->
							</div><!-- end custom-box -->

							<hr class="invis1">

							<div class="custombox clearfix">
								<h4 class="small-title">Leave a Reply</h4>
								<div class="row">
									<div class="col-lg-12">
										<form class="form-wrapper">
											<input type="text" class="form-control" placeholder="Your name">
											<input type="text" class="form-control" placeholder="Email address">
											<input type="text" class="form-control" placeholder="Website">
											<textarea class="form-control" placeholder="Your comment"></textarea>
											<button type="submit" class="btn btn-primary">Submit Comment</button>
										</form>
									</div>
								</div>
							</div>
						</div><!-- end page-wrapper -->
					</div><!-- end col -->

					<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
						<div class="sidebar">
							<div class="widget">
								<h2 class="widget-title">Search</h2>
								<form class="form-inline search-form">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Search on the site">
									</div>
									<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
								</form>
							</div><!-- end widget -->

							<div class="widget">
								<h2 class="widget-title">Recent Posts</h2>
								<div class="blog-list-widget">
									<div class="list-group">
										<a href="single.html" class="list-group-item list-group-item-action flex-column align-items-start">
											<div class="w-100 justify-content-between">
												<img src="upload/blog_square_01.jpg" alt="" class="img-fluid float-left">
												<h5 class="mb-1">5 Beautiful buildings you need to before dying</h5>
												<small>12 Jan, 2016</small>
											</div>
										</a>

										<a href="single.html" class="list-group-item list-group-item-action flex-column align-items-start">
											<div class="w-100 justify-content-between">
												<img src="upload/blog_square_02.jpg" alt="" class="img-fluid float-left">
												<h5 class="mb-1">Let's make an introduction for creative life</h5>
												<small>11 Jan, 2016</small>
											</div>
										</a>

										<a href="single.html" class="list-group-item list-group-item-action flex-column align-items-start">
											<div class="w-100 last-item justify-content-between">
												<img src="upload/blog_square_03.jpg" alt="" class="img-fluid float-left">
												<h5 class="mb-1">Did you see the most beautiful sea in the world?</h5>
												<small>07 Jan, 2016</small>
											</div>
										</a>
									</div>
								</div><!-- end blog-list -->
							</div><!-- end widget -->

							<div class="widget">
								<h2 class="widget-title">Advertising</h2>
								<div class="banner-spot clearfix">
									<div class="banner-img">
										<img src="upload/banner_03.jpg" alt="" class="img-fluid">
									</div><!-- end banner-img -->
								</div><!-- end banner -->
							</div><!-- end widget -->

							<div class="widget">
								<h2 class="widget-title">Instagram Feed</h2>
								<div class="instagram-wrapper clearfix">
									<a class="" href="#"><img src="upload/insta_01.jpeg" alt="" class="img-fluid"></a>
									<a href="#"><img src="upload/insta_02.jpeg" alt="" class="img-fluid"></a>
									<a href="#"><img src="upload/insta_03.jpeg" alt="" class="img-fluid"></a>
									<a href="#"><img src="upload/insta_04.jpeg" alt="" class="img-fluid"></a>
									<a href="#"><img src="upload/insta_05.jpeg" alt="" class="img-fluid"></a>
									<a href="#"><img src="upload/insta_06.jpeg" alt="" class="img-fluid"></a>
									<a href="#"><img src="upload/insta_07.jpeg" alt="" class="img-fluid"></a>
									<a href="#"><img src="upload/insta_08.jpeg" alt="" class="img-fluid"></a>
									<a href="#"><img src="upload/insta_09.jpeg" alt="" class="img-fluid"></a>
								</div><!-- end Instagram wrapper -->
							</div><!-- end widget -->

							<div class="widget">
								<h2 class="widget-title">Popular Categories</h2>
								<div class="link-widget">
									<ul>
										<li><a href="#">Fahsion <span>(21)</span></a></li>
										<li><a href="#">Lifestyle <span>(15)</span></a></li>
										<li><a href="#">Art & Design <span>(31)</span></a></li>
										<li><a href="#">Health Beauty <span>(22)</span></a></li>
										<li><a href="#">Clothing <span>(66)</span></a></li>
										<li><a href="#">Entertaintment <span>(11)</span></a></li>
										<li><a href="#">Food & Drink <span>(87)</span></a></li>
									</ul>
								</div><!-- end link-widget -->
							</div><!-- end widget -->

						</div><!-- end sidebar -->
					</div><!-- end col -->
				</div><!-- end row -->
			</div><!-- end container -->
		</section>

<?php
	endwhile;  //end while loop
endif;    //end if   
?>

<?php
get_footer();
?>