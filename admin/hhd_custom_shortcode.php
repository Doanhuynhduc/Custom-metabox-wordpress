<?php 
function hhd_bds_get_post_type($args, $content){
    ob_start();
	$data = array(
		'post_status' => 'publish', 
		'post_type' => 'post', 
		'showposts' => $args['showpost'], 
		'cat' => $args['category'], 
	);
     $getposts = new WP_query($data); 
     global $wp_query; $wp_query->in_the_loop = true;

     ?>
<div class="row large-columns-4 medium-columns-1 small-columns-1">
    <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
    <div class="col post-item">
        <div class="col-inner">
            <a href="<?php the_permalink()?>" class="plain">
                <div class="box box-normal box-text-bottom box-blog-post has-hover">
                    <div class="box-image">
                        <div class="image-zoom image-cover" style="padding-top:75%;">
                            <?php the_post_thumbnail('thumbnail'); ?> </div>
                    </div>
                    <div class="box-text text-left title">
                        <div class="box-text-inner blog-post-inner">
                            <h5 class="post-title is-large "><?php the_title(); ?></h5>
                        </div>
                    </div>

                </div>
            </a>
            <div class="real_detail">
                <div class="row row-collapse">
                    <div class="col medium-6">
                        <p class="kdbs-gia"><i class="fas fa-dollar-sign"></i> Giá:
                            <?php  $post_id = get_the_ID(); $hdd_pmt_price = get_post_meta( $post_id, '_hhd_price', true ); 
                                    if($hdd_pmt_price == ""){
                                        echo "Đang cập nhật";
                                    }else{
                                        echo $hdd_pmt_price;
                                    }  ?></p>
                    </div>
                    <div class="col medium-6">
                        <p class="text-right kdbs-trang-thai"><i class="fas fa-calendar-check"></i>
                            <?php  $post_id = get_the_ID(); $hdd_pmt_status = get_post_meta( $post_id, '_hhd_status', true ); 
                                    if($hdd_pmt_status == ""){
                                        echo "Đang cập nhật";
                                    }else{
                                        echo $hdd_pmt_status;
                                    }  ?>
                        </p>
                    </div>
                    <div class="col medium-12">
                        <p class="kdbs-diachi"><i class="fas fa-map-marker-alt"></i> ĐC:
                        <?php  $post_id = get_the_ID(); $hdd_pmt_address = get_post_meta( $post_id, '_hhd_address', true ); 
                                    if($hdd_pmt_address == ""){
                                        echo "Đang cập nhật";
                                    }else{
                                        echo $hdd_pmt_address;
                                    }  ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php endwhile; wp_reset_postdata(); ?>
</div>
<?php
$ct = ob_get_contents();
ob_end_clean();
return $ct;
}
add_shortcode( 'hhd_bds_blog_post', 'hhd_bds_get_post_type' );