<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Helpers
 */

namespace AxC\Framework\Helpers;

/**
 * Backend helpers.
 * @abstract
 */
abstract class Backend
{
	/**
	 * Add useful JS resources for Backend controller.
	 * @static
	 * @param \Backend\Classes\Controller $controller
	 * @return null
	 */
	public static function setJS(\Backend\Classes\Controller $controller)
	{
		$controller->addJs('//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.2.1/js/bootstrap-switch.min.js');
		$controller->addJs('//cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.1/icheck.min.js');

		$controller->addJs('/plugins/axc/framework/assets/vendor/axc-bootstrap/dist/axc-bootstrap.js');

		$controller->addJs('/plugins/axc/framework/assets/dist/axc-framework.js');
	}

	/**
	 * Add useful CSS resources for Backend controller.
	 * @static
	 * @param \Backend\Classes\Controller $controller
	 * @return null
	 */
	public static function setCSS(\Backend\Classes\Controller $controller)
	{
		$controller->addCss('//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css');
		$controller->addCss('//cdn.jsdelivr.net/flag-icon-css/0.6.0/css/flag-icon.min.css');
		$controller->addCss('//cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.1/skins/all.css');

		$controller->addCss('/plugins/axc/framework/assets/vendor/class2css/dist/class2.css');
		$controller->addCss('/plugins/axc/framework/assets/vendor/axc-bootstrap/dist/axc-bootstrap.css');

		$controller->addCss('/plugins/axc/framework/assets/dist/axc-framework.css');
	}
}