<?php
/**
 * Auto Rename Featured Image
 * Automatically rename featured images based on post title
 *
 * @package Elementor_Blank_Starter
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Rename featured image on upload
 */
function elementor_blank_rename_featured_image( $file ) {
	// Only process if we're setting a featured image
	if ( ! isset( $_POST['post_id'] ) || empty( $_POST['post_id'] ) ) {
		return $file;
	}

	$post_id = absint( $_POST['post_id'] );
	
	// Get the post
	$post = get_post( $post_id );
	
	if ( ! $post ) {
		return $file;
	}

	// Get post title and sanitize it
	$post_title = $post->post_title;
	
	if ( empty( $post_title ) ) {
		return $file;
	}

	// Remove accents
	$post_title = remove_accents( $post_title );
	
	// Convert to lowercase
	$post_title = strtolower( $post_title );
	
	// Replace spaces with hyphens
	$post_title = str_replace( ' ', '-', $post_title );
	
	// Remove special characters except hyphens
	$post_title = preg_replace( '/[^a-z0-9\-]/', '', $post_title );
	
	// Remove multiple consecutive hyphens
	$post_title = preg_replace( '/-+/', '-', $post_title );
	
	// Remove leading and trailing hyphens
	$post_title = trim( $post_title, '-' );

	// Get file extension
	$file_ext = pathinfo( $file['name'], PATHINFO_EXTENSION );
	
	// Create new filename
	$new_filename = $post_title . '.' . $file_ext;
	
	// Update the filename
	$file['name'] = $new_filename;

	return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'elementor_blank_rename_featured_image', 10, 1 );

/**
 * Rename existing featured image when post title changes
 */
function elementor_blank_rename_featured_on_save( $post_id, $post, $update ) {
	// Don't run on autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Don't run on revisions
	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}

	// Check if post has a featured image
	if ( ! has_post_thumbnail( $post_id ) ) {
		return;
	}

	// Get the attachment ID
	$attachment_id = get_post_thumbnail_id( $post_id );
	
	if ( ! $attachment_id ) {
		return;
	}

	// Get post title
	$post_title = $post->post_title;
	
	if ( empty( $post_title ) ) {
		return;
	}

	// Remove accents
	$post_title = remove_accents( $post_title );
	
	// Convert to lowercase
	$post_title = strtolower( $post_title );
	
	// Replace spaces with hyphens
	$post_title = str_replace( ' ', '-', $post_title );
	
	// Remove special characters except hyphens
	$post_title = preg_replace( '/[^a-z0-9\-]/', '', $post_title );
	
	// Remove multiple consecutive hyphens
	$post_title = preg_replace( '/-+/', '-', $post_title );
	
	// Remove leading and trailing hyphens
	$post_title = trim( $post_title, '-' );

	// Get current attachment file
	$file_path = get_attached_file( $attachment_id );
	
	if ( ! $file_path || ! file_exists( $file_path ) ) {
		return;
	}

	// Get file extension
	$file_ext = pathinfo( $file_path, PATHINFO_EXTENSION );
	
	// Get directory
	$file_dir = dirname( $file_path );
	
	// Create new filename
	$new_filename = $post_title . '.' . $file_ext;
	$new_file_path = $file_dir . '/' . $new_filename;

	// Get current filename without path
	$current_filename = basename( $file_path );
	
	// Don't rename if filename is already correct
	if ( $current_filename === $new_filename ) {
		return;
	}

	// Rename the file
	if ( rename( $file_path, $new_file_path ) ) {
		// Update attachment metadata
		update_attached_file( $attachment_id, $new_file_path );
		
		// Get attachment metadata
		$metadata = wp_get_attachment_metadata( $attachment_id );
		
		if ( $metadata && isset( $metadata['file'] ) ) {
			// Update the file path in metadata
			$metadata['file'] = str_replace( $current_filename, $new_filename, $metadata['file'] );
			
			// Rename thumbnail files if they exist
			if ( isset( $metadata['sizes'] ) && is_array( $metadata['sizes'] ) ) {
				foreach ( $metadata['sizes'] as $size => $size_data ) {
					$old_thumb_path = $file_dir . '/' . $size_data['file'];
					
					// Create new thumbnail name based on new filename
					$thumb_ext = pathinfo( $size_data['file'], PATHINFO_EXTENSION );
					$new_thumb_name = $post_title . '-' . $size_data['width'] . 'x' . $size_data['height'] . '.' . $thumb_ext;
					$new_thumb_path = $file_dir . '/' . $new_thumb_name;
					
					if ( file_exists( $old_thumb_path ) ) {
						rename( $old_thumb_path, $new_thumb_path );
						$metadata['sizes'][ $size ]['file'] = $new_thumb_name;
					}
				}
			}
			
			// Update attachment metadata
			wp_update_attachment_metadata( $attachment_id, $metadata );
		}
	}
}
add_action( 'save_post', 'elementor_blank_rename_featured_on_save', 10, 3 );
