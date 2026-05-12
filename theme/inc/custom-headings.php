<?php
add_filter( 'block_type_metadata', function( $metadata ) {
  if ( ! isset( $metadata['name'] ) || 'core/heading' !== $metadata['name'] ) {
    return $metadata;
  }

  if ( isset( $metadata['attributes']['content']['selector'] ) ) {
    $metadata['attributes']['content']['selector'] = 'h3,h4,h5,h6';
  }

  if ( isset( $metadata['attributes']['level']['default'] ) ) {
    $metadata['attributes']['level']['default'] = 3;
  }

  return $metadata;
} );
