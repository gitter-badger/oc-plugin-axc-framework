<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Traits
 */

namespace AxC\Framework\Traits;

/**
 * To perform action related to deleted records in AJAX mode.
 */
trait TrashAjaxController
{
	/**
	 * Load the trash controller methods.
	 */
	use TrashController;

	/**
	 * Indicate if the deleted records are shown or not.
	 * @var boolean
	 */
	protected $_enabled = false;

	/**
	 * Initialize the trash controller in AJAX mode loading the needed resources.
	 * @param array $options [ = [] ]
	 * @return null 
	 */
	protected function _initTrash( array $options = [] )
	{
		// to nothing
	} 

	/**
	 * Show the deleted records.
	 * @return array
	 */
	public function index_onShowDeleted()
	{
		$this->_enabled = true;
		return $this->listRefresh();
	}

	/**
	 * Hide the deleted records.
	 * @return array
	 */
	public function index_onHideDeleted()
	{
		$this->_enabled = false;
		return $this->listRefresh();
	}

	/**
	 * Extend the list behavior the show/hide the deleted record.
	 * @param \October\Rain\Database\Builder $query
	 * @return \October\Rain\Database\Builder
	 */
	public function listExtendQuery(\October\Rain\Database\Builder $query)
	{
		return $this->_enabled ? $query->withTrashed() : $query;
	}

	/**
	 * Adds the 'deletedStat' column is the deleted records are shown.
	 * @param \Backend\Widgets\Lists $list
	 * @return null
	 */
	public function listExtendColumns(\Backend\Widgets\Lists $list)
	{
		if ($this->_enabled)
			$list->addColumns([
				'deletedStat' => [
					'label'				=> 'axc.framework::lang.columns.timestamp.deletedStat.label',
					'type'				=> 'partial',
						'path'			=> '@/plugins/axc/framework/partials/backend/models/column/timestamp.htm',
						'cssClass'	=> 'wdt-200px'
					]
			]);
	}

	/**
	 * Indicate if the deleted records are shown or not.
	 * @return boolean
	 */
	public function hasShowDeleted()
	{
		return $this->_enabled;
	}

	/**
	 * Render the partial with trash buttons in the toolbar.
	 * @return mixed Partial contents or false if not throwing an exception.
	 */
	public function toolbarTrashRender()
	{
		return $this->makePartial('@/plugins/axc/framework/partials/backend/controllers/toolbars/_trash-ajax.htm');
	}
}