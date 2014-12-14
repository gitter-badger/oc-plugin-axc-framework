<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */

namespace AxC\Framework\Behaviors;

/**
 * Asset controller extension.
 *
 * Usage:
 *
 * In the controller class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.BackendAssetController'];
 *
 */
class BackendAssetController extends \Backend\Classes\ControllerBehavior
{
	/**
	 * {@inheritDoc}
	 */
	public function __construct(\Backend\Classes\Controller $controller)
	{
		parent::__construct($controller);

		// bootstrap-switch
		$this->addJs('//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.2.1/js/bootstrap-switch.min.js');

		// animate
		$this->addCss('//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css');

		// flag-icon
		$this->addCss('//cdn.jsdelivr.net/flag-icon-css/0.6.0/css/flag-icon.min.css');

		// axc-class2
		$this->addCss('/plugins/axc/framework/assets/vendor/axc-class2.css/dist/axc-class2.css', 'core');

		// axc-bootstrap
		$this->addCss('/plugins/axc/framework/assets/vendor/axc-bootstrap/dist/axc-bootstrap.css', 'core');
		$this->addJs('/plugins/axc/framework/assets/vendor/axc-bootstrap/dist/axc-bootstrap.js', 'core');

		// metro-ui
		$this->addJs('//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js');
		$this->addCss('/plugins/axc/framework/assets/dist/metro-ui.css', 'core');
		$this->addJs('/plugins/axc/framework/assets/dist/metro-ui.js', 'core');

		// axc-framework
		$this->addCss('/plugins/axc/framework/assets/dist/axc-framework.css', 'core');
		$this->addJs('/plugins/axc/framework/assets/dist/axc-framework.js', 'core');
	}
}