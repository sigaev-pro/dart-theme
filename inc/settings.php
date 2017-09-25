<?php

/**
 * Register settings
 */
function settings_init() {

    add_settings_field( 'ajax_pagination', __( 'AJAX Pagingation', 'dart-theme' ), 'ajax_pagination_render_field', 'reading' );

    register_setting( 'reading', 'ajax_pagination' );
}
add_action( 'admin_init', 'settings_init' );

/**
 * Render AJAX Pagination settings field
 */
function ajax_pagination_render_field() {
    ?>
    <label for="ajax_pagination">
    <input id="ajax_pagination" name="ajax_pagination" type="checkbox" value="1" <?php checked( 1, get_option( 'ajax_pagination' ) ); ?> />
    <?php esc_html_e( 'Enable AJAX pagination', 'dart-theme' ); ?>
    </label>
    <?php
}