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
 
if( ! class_exists( 'Gamajo_Template_Loader' ) ) {
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
	 * @type string
	 */
	protected $filter_prefix = 'meal_planner';

	/**
	 * Directory name where custom templates for this plugin should be found in the theme.
	 *
	 * @since 1.0.0
	 * @type string
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
	 * @type string
	 */
	protected $plugin_directory = MEAL_PLANNER_PLUGIN_DIR;

}
