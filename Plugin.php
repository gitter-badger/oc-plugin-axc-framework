<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework
 */

namespace AxC\Framework;

/**
 * Framework Plugin Information File.
 */
class Plugin extends \System\Classes\PluginBase
{
	/**
	 * Plugin dependencies.
	 * @todo
	 * @var array
	 */
	public $require = ['Flynsarmy.Menu'];


	/**
	 * Returns information about this plugin.
	 * @return array
	 */
	public function pluginDetails()
	{
		return [
			'name'				=> 'Framework',
			'description'	=> trans('axc.framework::lang.plugin.description'),
			'author'			=> 'Alex Carrega',
			'icon'				=> 'icon-cubes'
		];
	}

	/**
	 * Called right before the request route.
	 * Perform additional translate methods with AxC\Framework\Classes\Translate.
	 * @return null
	 */
	public function boot()
	{
		$ext_translate = new Classes\Translate();
		$ext_translate->menu();
	}

	/**
	 * Register additional markup tags (related to the image functionalities) that can be used in the CMS.
	 * @return array 
	 */
	public function registerMarkupTags()
	{
		return [
			'functions' => [
				'image_field_path'						=> ['AxC\Framework\Helpers\ImageField', 'path'							],
				'image_field_thumb'						=> ['AxC\Framework\Helpers\ImageField', 'thumb'							],
				'image_field_path_settings'		=> ['AxC\Framework\Helpers\ImageField', 'pathFromSettings'	],
				'image_field_thumb_settings'	=> ['AxC\Framework\Helpers\ImageField', 'thumbFromSettings'	]
			]
		];
	}

	/**
	 * Register additional form widgets that can be used in the CMS.
	 * @return array
	 */
	public function registerFormWidgets()
	{
		return [
			'AxC\Framework\FormWidgets\IntegerRange' => [
					'label' => trans('axc.framework::lang.widget.integerrange.label'),
					'code'  => 'integerrange'
			]
		];
	}
}