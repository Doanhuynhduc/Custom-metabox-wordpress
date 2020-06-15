<?php
/**
 Khai báo meta box
**/
function hhd_custom_meta_box()
{
 add_meta_box( 'thong-tin', 'Thông tin dự án', 'hhd_thongtin_output', 'post' );
}
add_action( 'add_meta_boxes', 'hhd_custom_meta_box' );
 
/**
 Khai báo callback
 @param $post là đối tượng WP_Post để nhận thông tin của post
**/
function hhd_thongtin_output( $post )
{
 $hhd_price = get_post_meta( $post->ID, '_hhd_price', true );
 $hhd_status = get_post_meta( $post->ID, '_hhd_status', true );
 $hhd_address = get_post_meta( $post->ID, '_hhd_address', true );
 wp_nonce_field( 'hhd_price', 'thongtin_price_nonce' );
 wp_nonce_field( 'hhd_status', 'thongtin_status_nonce' );
 wp_nonce_field( 'hhd_address', 'thongtin_address_nonce' );
 // Tạo trường Link Download
 echo ( '<label for="hhd_price" style="width: 100px; display: inline-block">Giá tiền: </label>' );
 echo ('<input type="text" id="hhd_price" name="hhd_price" value="'.esc_attr( $hhd_price ).'" /></br></br>');
 echo ( '<label for="hhd_status" style="width: 100px; display: inline-block">Trạng thái: </label>' );
 echo ('<input type="text" id="hhd_status" name="hhd_status" value="'.esc_attr( $hhd_status ).'" /></br></br>');
 echo ( '<label for="hhd_address" style="width: 100px; display: inline-block">Địa chỉ: </label>' );
 echo ('<input type="text" id="hhd_address" name="hhd_address" size="50" value="'.esc_attr( $hhd_address ).'" /></br></br>');
}
 
/**
 Lưu dữ liệu meta box khi nhập vào
 @param post_id là ID của post hiện tại
**/
function hhd_thongtin_save( $post_id )
{
    $thongtin_price_nonce = $_POST['thongtin_price_nonce'];
    $thongtin_status_nonce = $_POST['thongtin_status_nonce'];
    $thongtin_address_nonce = $_POST['thongtin_address_nonce'];
 // Kiểm tra nếu nonce chưa được gán giá trị
 if( !isset( $thongtin_price_nonce ) && !isset( $thongtin_status_nonce ) && !isset( $thongtin_address_nonce ) ) {
  return;
 }
 // Kiểm tra nếu giá trị nonce không trùng khớp
 if( !wp_verify_nonce( $thongtin_price_nonce, 'hhd_price' ) && !wp_verify_nonce( $thongtin_status_nonce, 'hhd_status' ) && !wp_verify_nonce( $thongtin_address_nonce, 'hhd_address' )) {
  return;
 }


 $hhd_price = sanitize_text_field( $_POST['hhd_price'] );
 update_post_meta( $post_id, '_hhd_price', $hhd_price );

 $hhd_status = sanitize_text_field( $_POST['hhd_status'] );
 update_post_meta( $post_id, '_hhd_status', $hhd_status );

 $hhd_address = sanitize_text_field( $_POST['hhd_address'] );
 update_post_meta( $post_id, '_hhd_address', $hhd_address );
}
add_action( 'save_post', 'hhd_thongtin_save' );