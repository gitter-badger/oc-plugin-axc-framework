<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Controlllers
 */

namespace AxC\Framework\Controllers;

/**
 * Page helper.
 * @abstract
 */
abstract class Page extends \Backend\Classes\Controller
{
	/**
	 * Set the Backend menu and Settings context.
	 * Add CSS and JS resources.
	 */
	public function __construct()
	{
		$class_name = get_called_class();
		list($axc, $plugin_id, $plugin_type, $type) = explode('\\', $class_name);
		$pluginName = "$axc.$plugin_id";
		$pluginRef = str_replace( '_','-', snake_case($plugin_id) );
		$type = strtolower($type);

		parent::__construct();

		$this->_initPage();

		\AxC\Framework\Helpers\Backend::setJS($this);
		\AxC\Framework\Helpers\Backend::setCSS($this);

		\BackendMenu::setContext($pluginName, $pluginRef, $this->type);
		\System\Classes\SettingsManager::setContext($pluginName, $this->type);
	}

	/**
	 * Perform some initialization in derived class.
	 * @return null
	 */
	protected function _initPage()
	{
		// do nothing
	}
}