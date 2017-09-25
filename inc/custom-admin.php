<?php 

function add_page_rating_metabox() {
    add_meta_box( 'pagerating', __( 'Page rating', 'dart-theme' ), 'page_rating_meta_box', null, 'side', 'core' );
}

add_action( 'add_meta_boxes_page', 'add_page_rating_metabox' );


/**
 * Display page attributes form fields.
 *
 * @param object $post
 */
function page_rating_meta_box($post) {
    $page_rating_meta_value = get_post_meta( $post->ID, '_page_rating', true );
    ?>
        <select id="page_rating" name="page_rating">
            <option value=""></option>
            <?php
                foreach (range( 1, 5 ) as $r) {
                    ?>
                    <option value="<?php echo $r ?>" <?php selected( $r, $page_rating_meta_value ) ?>><?php echo $r ?></option>
                    <?php
                }
            ?>
        </select>
    <?php
}

/**
 * Save page rating
 *
 * @param int $post_id
 */
function page_rating_save_metabox($post_id) {
    // Prevent rating update on autosaving
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check user permissions
    if( !current_user_can( 'edit_page', $post_id ) ) {
        return;
    }

    if( isset( $_POST['page_rating'] ) && is_numeric ( $_POST['page_rating'] ) ) {
        // Meta name is staring with underscore (_) to hide it from metadata editor
        update_post_meta( $post_id, '_page_rating', intval( $_POST['page_rating'] ) );
    }else{
        // Set meta value to zero if not present in _POST or empty
        delete_post_meta( $post_id, '_page_rating' );
    }
}
add_action( 'save_post_page', 'page_rating_save_metabox' );