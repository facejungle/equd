<?php
function equd_excerpt($data)
{
  //change your_post_type to post, page, or your custom post type slug
  if ('post' == $data['post_type']) {

    $excerpt = $data['post_excerpt'];

    if (empty($excerpt)) { // If excerpt field is empty

      // Check if the data is not drafed and trashed
      if (($data['post_status'] != 'draft') && ($data['post_status'] != 'trash')) {

        $data['post_status'] = 'draft';

        add_filter('redirect_post_location', 'excerpt_error_message_redirect', '99');

      }
    }
  }

  return $data;
}

add_filter('wp_insert_post_data', 'equd_excerpt');

function excerpt_error_message_redirect($location)
{

  $location = str_replace('&message=6', '', $location);

  return add_query_arg('excerpt_required', 1, $location);

}

function excerpt_admin_notice()
{

  if (!isset($_GET['excerpt_required']))
    return;

  switch (absint($_GET['excerpt_required'])) {

    case 1:

      $message = 'Excerpt field is empty! Excerpt is required to publish your recipe post.';

      break;

    default:

      $message = 'Unexpected error';
  }

  echo '<div id="notice" class="error"><p>' . $message . '</p></div>';

}


add_action('admin_notices', 'excerpt_admin_notice');