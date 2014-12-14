<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */

namespace AxC\Framework\Behaviors;

/**
 * Published attribute controller extension.
 *
 * Usage:
 *
 * In the controller class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.PublishedAttributeController'];
 *
 */
class PublishedAttributeController extends \Backend\Classes\ControllerBehavior
{
	/**
	 * Update the published column in the list.
	 * @return mixed
	 */
	public function index_onPublished()
	{
		$model = $this->controller->model;
		if ( ( $id = post('id') ) )
		{
			$record = $model::find($id);
			$record->published = !$record->published;
			$record->save();
			\Flash::success( trans( 'axc.framework::lang.columns.published.updated.'. ($record->published ? 'true': 'false') ) );
			$this->vars['action'] = 'index';
			return $this->controller->listRefresh();
		}
	}
}