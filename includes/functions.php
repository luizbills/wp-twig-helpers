<?php

if ( ! defined( 'WPINC' ) ) die();

function get_twig_cache_settings ( $path ) {
	return apply_filters( 'twig_helpers_cache_settings', [
		'expires' => false,
		'cache_mode' => Timber\Loader::CACHE_USE_DEFAULT
	], $path );
}

/* for templates */
function compile_twig_template ( $path , $data = [], $echo = true ) {
	$context = $data;
	if ( apply_filters( 'twig_helpers_use_timber_context', true, $path ) ) {
		$context = array_merge( Timber::get_context(), $data );
	}
	$cache = get_twig_cache_settings( $path );
	$result = Timber::compile( $path, $context, $cache['expires'], $cache['cache_mode'] );
	
	if ( false !== $result && $echo ) {
		echo $result;
	}

	return $result;
} 

function twig_template_callback ( $path, $data = [] ) {
	return function () use ( $path, $data ) {
		echo compile_twig_template( $path, $data );
	};
}

/* for strings */
function compile_twig_string ( $string , $data = [], $echo = true ) {
	$context = $data;
	if ( apply_filters( 'twig_helpers_use_timber_context', true, $path ) ) {
		$context = array_merge( Timber::get_context(), $data );
	}
	$result = Timber::compile_string( $string, $context );
	if ( $echo ) echo $result;
	return $result;
}

function twig_string_callback ( $string, $data = [] ) {
	return function () use ( $string, $data ) {
		echo compile_twig_string( $string, $data );
	};
}
