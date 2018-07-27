<?php

add_shortcode( 'twig_template', function ( $args, $content = '' ) {
    $defaults = [
        'path' => ''
    ];
    $args = array_merge( $defaults, $args );
    $path = $args['path'];
    $data = [];

    unset( $args['path'] );

    foreach ( $args as $key => $value ) {
        $data[ $key ] = $value;
    }
    $data['content'] = $content;

    $result = compile_twig_template( $path, $data, false );

    // error only for admins
    if ( false === $result && current_user_can( 'install_plugins' ) ) {
        throw new Exception( 'Invalid path in twig_template shortcode' );
    }

    $result = apply_filters( 'twig_helpers_before_template_' . $path, '', $data, $content ) . $result;
    $result .= apply_filters( 'twig_helpers_after_template_' . $path, '', $data, $content );

    return $result;
} );
