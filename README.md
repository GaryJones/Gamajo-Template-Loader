# Gamajo Template Loader

[![Code Climate](https://codeclimate.com/github/GaryJones/Gamajo-Template-Loader/badges/gpa.svg)](https://codeclimate.com/github/GaryJones/Gamajo-Template-Loader)

A class to copy into your WordPress plugin, to allow loading template parts with fallback through the child theme > parent theme > plugin.

## Description

Easy Digital Downloads, WooCommerce, and Events Calendar plugins, amongst others, allow you to add files to your theme to override the default templates that come with the plugin. As a developer, adding this convenience in to your own plugin can be a little tricky.

The `get_template_part()` function in WordPress was never really designed with plugins in mind, since it relies on `locate_template()` which only checks child and parent themes. So we can add in a final fallback that uses the templates in the plugin, we have to use a custom `locate_template()` function, and a custom `get_template_part()` function. The solution here just wraps them up as a class for convenience.

## Installation

This isn't a WordPress plugin on its own, so the usual instructions don't apply. Instead:

1. Copy [`class-gamajo-template-loader.php`](class-gamajo-template-loader.php) into your plugin. It can be into a file in the plugin root, or better, an `includes` directory.
2. Create a new file, such as `class-your-plugin-template-loader.php`, in the same directory.
3. Create a class in that file that extends `Gamajo_Template_Loader`. You can see the Meal Planner Template Loader example class below as a starting point if it helps.
4. Override the class properties to suit your plugin. You could also override the `get_templates_dir()` method if it isn't right for you.
5. You can now instantiate your custom template loader class, and use it to call the `get_template_part()` method. This could be within a shortcode callback, or something you want theme developers to include in their files.

  ~~~php
  // Template loader instantiated elsewhere, such as the main plugin file.
  $meal_planner_template_loader = new Meal_Planner_Template_Loader;
  ~~~
* Use it to call the `get_template_part()` method. This could be within a shortcode callback, or something you want theme developers to include in their files.

  ~~~php
  $meal_planner_template_loader->get_template_part( 'recipe' );
  ~~~
* If you want to pass data to the template, call the `set_template_data()` method with an array before calling `get_template_part()`. `set_template_data()` returns the loader object to allow for method chaining.

  ~~~php
  $data = array( 'foo' => 'bar', 'baz' => 'boom' );
  $meal_planner_template_loader
      ->set_template_data( $data );
      ->get_template_part( 'recipe' );
  ~~~
  
  The value of `bar` is now available inside the recipe template as `$data->foo`.
  
  If you wish to use a different variable name, add a second parameter to `set_template_data()`:

  ~~~php
  $data = array( 'foo' => 'bar', 'baz' => 'boom' );
  $meal_planner_template_loader
      ->set_template_data( $data, 'context' )
      ->get_template_part( 'recipe', 'ingredients' );
  ~~~
  
  The value of `bar` is now available inside the recipe template as `$context->foo`.

  This will try to load up `wp-content/themes/my-theme/meal-planner/recipe-ingredients.php`, or `wp-content/themes/my-theme/meal-planner/recipe.php`, then fallback to `wp-content/plugins/meal-planner/templates/recipe-ingredients.php` or `wp-content/plugins/meal-planner/templates/recipe.php`.

### Meal Planner Example Class

```php
<?php
/**
 * Meal Planner
 *
 * @package   Meal_Planner
 * @author    Gary Jones
 * @link      http://example.com/meal-planner
 * @copyright 2013 Gary Jones
 * @license   GPL-2.0+
 */

if ( ! class_exists( 'Gamajo_Template_Loader' ) ) {
  require plugin_dir_path( __FILE__ ) . 'class-gamajo-template-loader.php';
}

/**
 * Template loader for Meal Planner.
 *
 * Only need to specify class properties here.
 *
 * @package Meal_Planner
 * @author  Gary Jones
 */
class Meal_Planner_Template_Loader extends Gamajo_Template_Loader {
  /**
   * Prefix for filter names.
   *
   * @since 1.0.0
   *
   * @var string
   */
  protected $filter_prefix = 'meal_planner';

  /**
   * Directory name where custom templates for this plugin should be found in the theme.
   *
   * @since 1.0.0
   *
   * @var string
   */
  protected $theme_template_directory = 'meal-planner';

  /**
   * Reference to the root directory path of this plugin.
   *
   * Can either be a defined constant, or a relative reference from where the subclass lives.
   *
   * In this case, `MEAL_PLANNER_PLUGIN_DIR` would be defined in the root plugin file as:
   *
   * ~~~
   * define( 'MEAL_PLANNER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
   * ~~~
   *
   * @since 1.0.0
   *
   * @var string
   */
  protected $plugin_directory = MEAL_PLANNER_PLUGIN_DIR;

  /**
   * Directory name where templates are found in this plugin.
   *
   * Can either be a defined constant, or a relative reference from where the subclass lives.
   *
   * e.g. 'templates' or 'includes/templates', etc.
   *
   * @since 1.1.0
   *
   * @var string
   */
  protected $plugin_template_directory = 'templates';
}
```

## Usage Example

The [Cue](https://github.com/AudioTheme/cue) plugin from [AudioTheme](http://audiotheme.com/) uses this class. Starting at [https://github.com/AudioTheme/cue/tree/develop/includes](https://github.com/AudioTheme/cue/tree/develop/includes), it has this class in the vendor directory, then the required subclass of my class in the `class-cue-template-loader.php` file, which sets a few basic properties. It also has a template in [https://github.com/AudioTheme/cue/tree/develop/templates](https://github.com/AudioTheme/cue/tree/develop/templates).

If you wanted the playlist to have different markup for your theme, you'd copy `templates/playlist.php` to `wp-content/themes/{your-active-theme}/cue/playlist.php` and do whatever changes you wanted. WordPress will look for that file first, before then checking a parent theme location (if your active theme is a child theme), before falling back to the default template that comes with the Cue plugin.

## Change Log

See the [change log](CHANGELOG.md).

## License

[GPL-2.0+](LICENSE).

## Contributions

Contributions are welcome - fork, fix and send pull requests against the `develop` branch please.

## Credits

Built by [Gary Jones](https://twitter.com/GaryJ)  
Copyright 2013 [Gamajo Tech](https://gamajo.com)
