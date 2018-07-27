# WordPress Twig Helpers

Introduces helper functions to easy and fast theme development with Twig.

## Requirements

- PHP v5.4+
- WordPress v4.6+
- [Timber](https://wordpress.org/plugins/timber-library/)

## Documentation

### Functions

#### `string compile_twig_template( string|array $path , array $data = [], bool $echo = true )`

Print or returns the output of a rendered twig template.

> Note: `$path` is a relative path of your theme twig templates.

#### `string compile_twig_string ( string $code, array $data = [], $echo = true )`

Print or returns the output of a rendered twig code.

#### `callable twig_template_callback( string|array $path, array $data = [] )`

Returns a callable that prints a rendered twig template.

```php
// usage
add_action( 'wp_footer', twig_template_callback( 'my-footer.twig', [ 'foo' => 'bar' ] ) );
```

#### `callable twig_string_callback( string|array $path, array $data = [] )`

Returns a callable that prints a rendered twig code.

```php
// usage
add_action( 'wp_footer', twig_string_callback( '<p>{{ foo }}</p>', [ 'foo' => 'bar' ] ) );
```

### Shortcodes

#### `[twig_template path="your_file.twig" foo="bar" ...]`

Print the output of a rendered twig template. All shortcode parameters (except `path`) will be part of template data.

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

#### `twig_helpers_before_template_{$path}` action

Useful to print non-rendered twig code before a which template.

> This filter is defined in [`includes/shortcode.php`](includes/shortcode.php);

#### `twig_helpers_after_template_{$path}` action

Useful to print non-rendered twig code after a which template.

> This filter is defined in [`includes/shortcode.php`](includes/shortcode.php);

## LICENSE

GPL v3
