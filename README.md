# Gamajo Template Loader

A class to copy into your WordPress plugin, to allow loading template parts with fallback through the child theme > parent theme > plugin.

## Description

Easy Digital Downloads, WooCommerce, and Events Calendar plugins, amongst others, allow you to add files to your theme to override the default templates that come with the plugin. As a developer, adding this convenience in to your own plugin can be a little tricky.

The `get_template_part()` function in WordPress was never really designed with plugins in mind, since it relies on `locate_template()` which only checks child and parent themes. So we can add in a final fallback that uses the templates in the plugin, we have to use a custom `locate_template()` function, and a custom `get_template_part()` function. The solution here just wraps them up as a class for convenience.

## Installation

This isn't a WordPress plugin on its own, so the usual instructions don't apply. Instead:

1. Copy [`class-gamajo-template-loader.php`](class-gamajo-template-loader.php) into your plugin. It can be into a file in the plugin root, or better, an `includes` directory.
2. Create a new file, such as `class-your-plugin-template-loader.php`, in the same directory.
3. Create a class in that file that extends `Gamajo_Tech_Loader`. You can copy the [meal planner](class-meal-planner-template-loader.php) example class as a starting point if it helps.
4. Override the class properties to suit your plugin. You could also override the `get_templates_dir()` method if it isn't right for you.
5. You can now instantiate your custom template loader class, and use it to call the `get_template_part()` method. This could be within a shortcode callback, or something you want theme developers to include in their files.
6. Optionally, you can wrap the reference to the object in a functions e.g.

  ~~~
  // Template loader instantiated elsewhere, such as the main plugin file
  $meal_planner_template_loader = new Meal_Planner_Template_Loader;

  // ...

  // This function can live wherever is suitable in your plugin
  function meal_planner_get_template_part( $slug, $name = null, $load = true ) {
      global $meal_planner_template_loader;
      $meal_planner_template_loader->get_template_part( $slug, $name, $load );
  }
  ~~~
7. An example using the helper function (or class method) would be:

  ~~~
  add_filter( 'the_content', 'meal_planner_single_recipe_content' );
  function meal_planner_single_recipe_content( $content ) {
      if ( ! function_exists( 'meal_planner_get_template_part' ) ) {
          return $content;
      }
      meal_planner_get_template_part( 'recipe', 'ingredients' );
      meal_planner_get_template_part( 'recipe', 'instructions' );
  }
  ~~~
This will try to load up `wp-content/themes/my-theme/meal-planner/recipe-ingredients.php`, or `wp-content/themes/my-theme/meal-planner/recipe.php`, then fallback to `wp-content/plugins/meal-planner/templates/recipe-ingredients.php` or `wp-content/plugins/meal-planner/templates/recipe.php`.

## Usage Example

The [Cue](https://github.com/AudioTheme/cue) plugin from [AudioTheme](http://audiotheme.com/) uses this class. Starting at [https://github.com/AudioTheme/cue/tree/develop/includes](https://github.com/AudioTheme/cue/tree/develop/includes), it has this class in the vendor directory, then the required subclass of my class in the `class-cue-template-loader.php` file, which sets a few basic properties. It also has a template in [https://github.com/AudioTheme/cue/tree/develop/templates](https://github.com/AudioTheme/cue/tree/develop/templates).

If you wanted the playlist to have different markup for your theme, you'd copy `templates/playlist.php` to `wp-content/themes/{your-active-theme}/cue/playlist.php` and do whatever changes you wanted. WordPress will look for that file first, before then checking a parent theme location (if your active theme is a child theme), before falling back to the default template that comes with the Cue plugin.

## Contributions
Contributions are welcome - fork, fix and send pull requests against the `develop` branch please.

## Credits

Built by [Gary Jones](https://twitter.com/GaryJ)  
Copyright 2013 [Gamajo Tech](http://gamajo.com/)
