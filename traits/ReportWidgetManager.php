<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Traits
 */

namespace AxC\Framework\Traits;

/**
 * Trait to manage the controller report widgets.
 */
trait ReportWidgetManager
{
	/**
	 * Return the array of ReportWidget object (that extend @var \Backend\Classes\ReportWidgetBase) binded to this controller.
	 * @return array
	 */
	public function getReportWidgets()
	{
		return array_filter( (array)$this->widget, function ($widget)
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
		return $this->makePartial( '@/plugins/axc/framework/partials/backend/reportwidget.htm', ['controller' => $this] );
	}
}