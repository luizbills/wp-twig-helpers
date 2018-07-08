# WordPress Twig Helpers

Introduces helper functions to easy and fast theme development with Twig.

## Requirements

- PHP v5.4+
- WordPress v4.6+
- [Timber](https://wordpress.org/plugins/timber-library/)

## Documentation

### Functions

#### `string get_twig_template( string|array $path, array $data = [] )`

Returns the output of a rendered twig template.

> Note: `$path` is a relative path of your theme twig templates.

#### `void twig_template( string|array $path, array $data = [] )`

Prints a rendered twig template.

#### `callable twig_template_callback( string|array $path, array $data = [] )`

Returns a callable that prints a rendered twig template.

```php
// usage
add_action( 'wp_footer', twig_template_callback( 'my-footer.twig', [ 'foo' => 'bar' ] ) );
```

### Hooks

#### `twig_helpers_cache_settings` filter

Useful to change the cache mode and expiration time of a template.

**Additional parameters:**

- `string|array $path` of twig template(s).

```php
// usage

add_filter( 'twig_helpers_cache_settings', 'my_twig_cache_settings', 10, 2 );
function my_twig_cache_settings ( $settings, $path ) {
	$settings['expires'] = 8 * HOUR_IN_SECONDS; // 8 hours
	$settings['cache_mode'] = Timber\Loader::CACHE_OBJECT;

	return $settings;
}
```

> This filter is defined in [`includes/functions.php`](includes/functions.php);

## LICENSE

GPL v3
