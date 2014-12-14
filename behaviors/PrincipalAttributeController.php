<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */

namespace AxC\Framework\Behaviors;

/**
 * Principal attribute controller extension.
 *
 * Usage:
 *
 * In the controller class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.PrincipalAttributeController'];
 *
 */
class PrincipalAttributeController extends \Backend\Classes\ControllerBehavior
{
	/**
	 * Update the position column in the list.
	 * @return mixed
	 */
	public function index_onPrincipal()
	{
		$model = $this->controller->model;
		if ( $id = post('id') )
		{
			$record = $model::find($id);
			if ( !$record->principal)
			{
				$record->principal = !$record->principal;
				$record->save();
				\Flash::success( trans('axc.framework::lang.columns.principal.updated') );
				$this->vars['action'] = 'index';
				return $this->controller->listRefresh();
			}
			else
				\Flash::warning( trans('axc.framework::lang.columns.principal.already_done') );
		}
	}
}