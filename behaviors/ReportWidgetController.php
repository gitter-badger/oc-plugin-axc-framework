<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */

namespace AxC\Framework\Behaviors;

/**
 * ReportWidget controller extension.
 *
 * Usage:
 *
 * In the controller class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.PublishedAttributeModel'];
 *
 */
class ReportWidgetController extends \Backend\Classes\ControllerBehavior
{
	/**
	 * Return the array of ReportWidget object (that extend @var \Backend\Classes\ReportWidgetBase) binded to this controller.
	 * @return array
	 */
	public function getReportWidgets()
	{
		return array_filter( (array)$this->controller->widget, function ($widget)
		{
			return $widget instanceof \Backend\Classes\ReportWidgetBase;
		} );
	}

	/**
	 * Render the controller report widgets
	 * @return mixed
	 */
	public function reportWidgetRender()
	{
		return $this->makePartial( 'reportwidget');
	}
}