<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */

namespace AxC\Framework\Behaviors;

/**
 * Breadcrumb controller extension.
 *
 * Usage:
 *
 * In the controller class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.BreadCrumbView'];
 *
 */
class BreadcrumbController extends \Backend\Classes\ControllerBehavior
{
	/**
	 * Render the breadcrumb.
	 * @return mixed
	 */
	public function breadcrumbRender()
	{
		return $this->makePartial('breadcrumb');
	}
}