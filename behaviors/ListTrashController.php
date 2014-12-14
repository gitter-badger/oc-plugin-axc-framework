<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */

namespace AxC\Framework\Behaviors;

/**
 * List Trash controller extension.
 *
 * Usage:
 *
 * In the controller class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.ListTrashController'];
 *
 */
class ListTrashController extends \Backend\Classes\ControllerBehavior
{
	/**
	 * {@inheritDoc}
	 */
	public function listExtendQuery($query)
	{
		return $this->controller->action === 'trash' ? $query->onlyTrashed() : $query;
	}

	/**
	 * Empty the trash.
	 * @return array;
	 */
	public function trash_onEmptyDeleted()
	{
		$model = $this->model;
		foreach ($model::onlyTrashed()->get() as $r) $r->forceDelete();
		\Flash::success( trans('axc.framework::lang.system.empty.flash') );
		return $this->controller->listRefresh();
	}

	/**
	 * Restore the selected records.
	 * @return array;
	 */
	public function trash_onRestoreDeleted()
	{
		return $this->__makeAction('restore', 'axc.framework::lang.system.restore.flash');
	}

	/**
	 * Permanently delete the selected records.
	 * @return array 
	 */
	public function trash_onPermanentlyDeleted()
	{
		return $this->__makeAction('forceDelete', 'axc.framework::lang.system.permamently_delete.flash');
	}

	/**
	 * Internal method to perform the restore/permanently delete actions.
	 * @return array
	 */
	private function __makeAction($action, $message)
	{
		$model = $this->model;
		if ( ( $checked_ids = post('checked') ) && is_array($checked_ids) && count($checked_ids) )
		{
			foreach ($model::onlyTrashed()->find($checked_ids) as $r) $r->$action();
			\Flash::success( trans($message) );
			return $this->listRefresh();
		}
		else
			\Flash::warning( trans('axc.framework::lang.system.no_records') );
	}

	/**
	 * View the trash with deleted records.
	 * @return mixed Partial contents or false if not throwing an exception.
	 */
	public function trash()
	{
		$this->controller->pageTitle = trans('axc.framework::lang.system.trash.label');
		$this->controller->asExtension('ListController')->index();
		return $this->makePartial('trash');
	}

	/**
	 * Render the partial with trash buttons in the toolbar.
	 * @return mixed Partial contents or false if not throwing an exception.
	 */
	public function toolbarTrashRender()
	{
		return $this->makePartial('@/plugins/axc/framework/partials/backend/controllers/toolbars/_trash.htm');
	}
}