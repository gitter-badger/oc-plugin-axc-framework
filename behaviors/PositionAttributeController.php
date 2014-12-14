<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */

namespace AxC\Framework\Behaviors;

/**
 * Position attribute controller extension.
 *
 * Usage:
 *
 * In the controller class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.PositionAttributeController'];
 *
 */
class PositionAttributeController extends \Backend\Classes\ControllerBehavior
{
	/**
	 * Update the position column in the list.
	 * @return mixed
	 */
	public function index_onPosition()
	{
		$model = $this->controller->model;
		if ( ( $id = post('id') ) and ( $mode = post('mode') ) )
		{
			$record = $model::find($id);
			$record->position += $mode;
			$record->save();
			\Flash::success( trans('axc.framework::lang.columns.position.updated') );
			$this->controller->vars['action'] = 'index';
			return $this->controller->listRefresh();
		}
	}
}