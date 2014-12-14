<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */

namespace AxC\Framework\Behaviors;

/**
 * BackendPage controller extension.
 *
 * Usage:
 *
 * In the controller class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.BackendController'];
 *
 */
class BackendController extends \Backend\Classes\ControllerBehavior
{
	/**
	 * {@inheritDoc}
	 */
	public function __construct(\Backend\Classes\Controller $controller)
	{
		parent::__construct($controller);

		$class_name = get_class($controller);
		list($axc, $plugin_id, $plugin_type, $type) = explode('\\', $class_name);
		$pluginName = "$axc.$plugin_id";
		$pluginId = strtolower($plugin_id);
		$pluginRef = str_replace( '_','-', snake_case($plugin_id) );
		$type = strtolower($type);
		$controller->model = str_replace( 'Controllers', 'Models', $class_name);
		if ( !class_exists($controller->model) ) $controller->model = null;

		$controller->vars['indexTitle'] = trans("axc.$pluginId::lang.$type.label.singular");
		$controller->vars['cancelURL'] = "axc/$pluginId/". str_replace('.', '', $type);

		\BackendMenu::setContext($pluginName, $pluginRef);
		\System\Classes\SettingsManager::setContext($pluginName, $type);
	}
}