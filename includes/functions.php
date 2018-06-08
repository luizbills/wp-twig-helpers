<?php
if ( ! defined( 'WPINC' ) ) die();

function get_twig_template ( $path , $data = [] ) {
	$context = $context = array_merge( Timber::get_context(), $data );
	$cache = get_twig_cache_settings( $path );
	return Timber::compile( $path, $context, $cache['expires'], $cache['cache_mode'] );
}

function twig_template ( $path, $data = [] ) {
	echo get_twig_template( $path, $data );
}

function twig_template_callback ( $path, $data = [] ) {
	return function () use ( $path, $data ) {
		$output = get_twig_template( $path, $data );
		echo $output;
	};
}

function get_twig_cache_settings ( $path ) {
	return apply_filters( 'twig_helpers_cache_settings', [
		'expires' => false,
		'cache_mode' => Timber\Loader::CACHE_USE_DEFAULT
	], $path );
}
