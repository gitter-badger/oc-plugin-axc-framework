<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Controllers
 */

namespace AxC\Framework\Controllers;

/**
 * DataManager controller.
 */
abstract class DataManager extends \Backend\Classes\Controller
{
	/**
	 * To manage the controller report widgets.
	 */
	use \AxC\Framework\Traits\ReportWidgetManager;

	/**
	 * Useful methods to init and add data to class member variables. 
	 */
	use \AxC\Framework\Traits\ClassMemberUtilities;

	/**
	 * To show the form as modal
	 */
	use \AxC\Framework\Traits\FormController;

	/**
	 * To perform action related to deleted records.
	 */
	use \AxC\Framework\Traits\TrashController;

	/**
	 * Init the form and trash controllers and relative fields.
	 * Init the implement data member, .
	 * Add CSS and JS resources.
	 */
	public function __construct()
	{
		$class_name = get_called_class();
		list($axc, $plugin_id, $plugin_type, $type) = explode('\\', $class_name);
		$this->pluginName = "$axc.$plugin_id";
		$this->pluginId = strtolower($plugin_id);
		$this->pluginRef = str_replace( '_','-', snake_case($plugin_id) );
		$this->type = str_replace( '_', '.', snake_case($type) );
		$this->model = str_replace( 'Controllers', 'Models', $class_name);

		$this->_initTrashController();
		$this->_initFormController();

		parent::__construct();

		\AxC\Framework\Helpers\Backend::setJS($this);
		\AxC\Framework\Helpers\Backend::setCSS($this);

		\BackendMenu::setContext($this->pluginName, $this->pluginRef, $this->type);
		\System\Classes\SettingsManager::setContext($this->pluginName, $this->type);

		$this->_initDataManager();
	}

	/**
	 * Perform some initialization in derived class.
	 * @return null
	 */
	protected function _initDataManager()
	{
		// do nothing
	}

	/**
	 * Called by 'Delete' button on controller list toolbar.
	 * @return array
	 */
	public function index_onDelete()
	{
		$model = $this->model;
		if ( ( $checked_ids = post('checked') ) && is_array($checked_ids) && count($checked_ids) )
		{
			foreach ($model::find($checked_ids) as $r) $r->delete();
			\Flash::success( trans('axc.framework::lang.system.delete.flash') );
			return $this->listRefresh();
		}
	}

	/**
	 * Called by 'Duplicate' button on controller list toolbar.
	 * @return array
	 */
	public function index_onDuplicate()
	{
		$model = $this->model;
		if ( ( $checked_ids = post('checked') ) && is_array($checked_ids) && count($checked_ids) )
		{
			foreach ($model::find($checked_ids) as $r)
			{
				if( !$r->attributes ) throw new \Exception( sprintf('One or more items cannot be found.') );
				$new_item = $model::find($r->id)->replicate()->beforeDuplicate();
			}
			\Flash::success( trans('axc.framework::lang.system.duplicate.flash') );
			return $this->listRefresh();
		}
	}

	/**
	 * Called by 'Published' a-href on published column.
	 */
	public function index_onPublished()
	{
		$model = $this->model;
		if ( ( $id = post('id') ) )
		{
			$record = $model::find($id);
			$record->published = !$record->published;
			$record->save();
			\Flash::success( trans( 'axc.framework::lang.columns.published.updated.'. ($record->published ? 'true': 'false') ) );
			return $this->listRefresh();
		}
	}

	public function index_onPosition()
	{
		$model = $this->model;
		if ( ( $id = post('id') ) and ( $mode = post('mode') ) )
		{
			$record = $model::find($id);
			$record->position += $mode;
			$record->save();
			\Flash::success( trans('axc.framework::lang.columns.position.updated') );
			return $this->listRefresh();
		}
	}

	public function listExtendColumns($list)
	{
		if ($this->action === 'index')
			$columns['edit'] = [
				'label'			=> '',
				'type'			=> 'partial',
				'sortable'	=> false,
				'path'			=> '@/plugins/axc/framework/partials/backend/models/column/edit.htm',
				'cssClass'	=> 'wdt-80px'
			];

		if ( \Schema::hasColumn($list->model->table, 'position') )
			$columns['position'] = [
				'label' 			=>	'axc.framework::lang.columns.position.label',
				'type'			=> 'partial',
				'path'		=> '@/plugins/axc/framework/partials/backend/models/column/integer-range.htm',
				'handler'		=> [
					'method'	=> 'onPosition',
					'title'		=> ['up' => 'axc.framework::lang.columns.position.title.up', 'down' => 'axc.framework::lang.columns.position.title.down']
				],
				'cssClass'	=> 'wdt-200px nolink'
			];

		if ( \Schema::hasColumn($list->model->table, 'published') )
			$columns['published'] = [
				'label'			=> 'axc.framework::lang.columns.published.label',
				'type'			=> 'partial',
				'path' 			=> '@/plugins/axc/framework/partials/backend/models/column/boolean.htm',
				'handler'		=> [
					'method'	=> 'onPublished',
					'title'		=> 'axc.framework::lang.columns.published.handler.title'
				],
				'cssClass'	=> 'wdt-120px nolink'
			];

		if ( \Schema::hasColumn($list->model->table, 'principal') )
			$columns['principal'] = [
				'label'			=> 'axc.framework::lang.columns.principal.label',
				'type'			=> 'partial',
				'path'			=> '@/plugins/axc/framework/partials/backend/models/column/boolean.htm',
				'cssClass'	=> 'wdt-120px nolink'
			];

		if ( \Schema::hasColumn($list->model->table, 'created_at') )
			$columns['createdStat'] = [
				'label'			=>	'axc.framework::lang.columns.timestamp.createdStat.label',
				'type'			=>	'partial',
				'path'			=>	'@/plugins/axc/framework/partials/backend/models/column/timestamp.htm',
				'cssClass'	=>	'wdt-180px'
			];

		if ( \Schema::hasColumn($list->model->table, 'updated_at') )
			$columns['updatedStat'] = [
				'label'			=> 'axc.framework::lang.columns.timestamp.updatedStat.label',
				'type'			=> 'partial',
				'path'			=> '@/plugins/axc/framework/partials/backend/models/column/timestamp.htm',
				'cssClass'	=> 'wdt-180px'
			];

		$list->addColumns($columns);
	}
}