<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Traits
 */

namespace AxC\Framework\Behaviors;

/**
 * List controller extension.
 *
 * Usage:
 *
 * In the controller class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.ListController'];
 *
 */
class ListController extends \Backend\Behaviors\ListController
{
	/**
	 * Called by 'Delete' button on controller list toolbar.
	 * @return array
	 */
	public function index_onDelete()
	{
		$model = $this->controller->model;
		if ( ( $checked_ids = post('checked') ) && is_array($checked_ids) && count($checked_ids) )
		{
			foreach ($model::find($checked_ids) as $r) $r->delete();
			\Flash::success( trans('axc.framework::lang.system.delete.flash') );
			return $this->controller->listRefresh();
		}
	}

	/**
	 * Called by 'Duplicate' button on controller list toolbar.
	 * @return array
	 */
	public function index_onDuplicate()
	{
		$model = $this->controller->model;
		if ( ( $checked_ids = post('checked') ) && is_array($checked_ids) && count($checked_ids) )
		{
			foreach ($model::find($checked_ids) as $r)
			{
				if( !$r->attributes ) throw new \Exception( sprintf('One or more items cannot be found.') );
				$new_item = $model::find($r->id)->replicate()->beforeDuplicate();
			}
			\Flash::success( trans('axc.framework::lang.system.duplicate.flash') );
			return $this->controller->listRefresh();
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public function index()
	{
		parent::index();
		return $this->makePartial( 'index', ['action' => 'index'] );
	}

	/**
	 * {@inheritDoc}
	 */
	public function listExtendColumns($list)
	{
		if ($this->controller->action === 'index')
			$columns['edit'] = [
				'label' => '',
				'type' => 'partial',
				'sortable' => false,
				'path' => '@/plugins/axc/framework/partials/backend/models/column/edit.htm',
				'cssClass' => 'wdt-80px'
			];

		if ( \Schema::hasColumn($list->model->table, 'position') )
			$columns['position'] = [
				'label' => 'axc.framework::lang.columns.position.label',
				'type' => 'partial',
				'path' => '@/plugins/axc/framework/partials/backend/models/column/integer-range.htm',
				'handler' => [
					'method' => 'onPosition',
					'title' => ['up' => 'axc.framework::lang.columns.position.title.up', 'down' => 'axc.framework::lang.columns.position.title.down']
				],
				'cssClass' => 'wdt-200px nolink'
			];

		if ( \Schema::hasColumn($list->model->table, 'published') )
			$columns['published'] = [
				'label' => 'axc.framework::lang.columns.published.label',
				'type' => 'partial',
				'path' => '@/plugins/axc/framework/partials/backend/models/column/boolean.htm',
				'handler' => [
					'method' => 'onPublished',
					'title' => 'axc.framework::lang.columns.published.handler.title'
				],
				'cssClass' => 'wdt-120px nolink'
			];

		if ( \Schema::hasColumn($list->model->table, 'principal') )
			$columns['principal'] = [
				'label' => 'axc.framework::lang.columns.principal.label',
				'type' => 'partial',
				'path' => '@/plugins/axc/framework/partials/backend/models/column/boolean.htm',
				'handler' => [
					'method' => 'onPrincipal',
					'title' => 'axc.framework::lang.columns.onPrincipal.handler.title'
				],
				'cssClass' => 'wdt-120px nolink'
			];

		if ( \Schema::hasColumn($list->model->table, 'created_at') )
			$columns['createdStat'] = [
				'label' => 'axc.framework::lang.columns.timestamp.createdStat.label',
				'type' => 'partial',
				'path' => '@/plugins/axc/framework/partials/backend/models/column/timestamp.htm',
				'cssClass' => 'wdt-180px'
			];

		if ( \Schema::hasColumn($list->model->table, 'updated_at') )
			$columns['updatedStat'] = [
				'label' => 'axc.framework::lang.columns.timestamp.updatedStat.label',
				'type' => 'partial',
				'path' => '@/plugins/axc/framework/partials/backend/models/column/timestamp.htm',
				'cssClass' => 'wdt-180px'
			];

		$list->addColumns($columns);
	}
}