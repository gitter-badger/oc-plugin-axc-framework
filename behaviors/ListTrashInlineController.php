<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */

namespace AxC\Framework\Behaviors;

/**
 * List Trash controller extension with inline view.
 *
 * Usage:
 *
 * In the controller class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.ListTrashInlineController'];
 *
 */
class ListTrashInlineController extends ListTrashController
{
	/**
	 * Indicate if the deleted records are shown or not.
	 * @var boolean
	 */
	private $__enabled = false;

	/**
	 * {@inheritDoc}
	 */
	public function __construct(\Backend\Classes\Controller $controller)
	{
		parent::__construct($controlelr);
		\Event::listen('backend.list.injectRowClass', function ($list, $record)
		{
			return @$record->deleted_at ? 'danger strong' : false;
		});
	}

	/**
	 * Show the deleted records.
	 * @return array
	 */
	public function index_onShowDeleted()
	{
		$this->__enabled = true;
		return $this->listRefresh();
	}

	/**
	 * Hide the deleted records.
	 * @return array
	 */
	public function index_onHideDeleted()
	{
		$this->__enabled = false;
		return $this->controller->listRefresh();
	}

	/**
	 * Indicate if the deleted records are shown or not.
	 * @return boolean
	 */
	public function hasShowDeleted()
	{
		return $this->__enabled;
	}

	/**
	 * Render the partial with trash buttons in the toolbar.
	 * @return mixed Partial contents or false if not throwing an exception.
	 */
	public function toolbarTrashRender()
	{
		return $this->makePartial('trash-inline');
	}

	/**
	 * {@inheritDoc}
	 */
	public function listExtendQuery(\October\Rain\Database\Builder $query)
	{
		return $this->__enabled ? $query->withTrashed() : $query;
	}

	/**
	 * {@inheritDoc}
	 */
	public function listExtendColumns(\Backend\Widgets\Lists $list)
	{
		if ($this->__enabled)
			$list->addColumns([
				'deletedStat' => [
					'label'				=> 'axc.framework::lang.columns.timestamp.deletedStat.label',
					'type'				=> 'partial',
						'path'			=> '@/plugins/axc/framework/partials/backend/models/column/timestamp.htm',
						'cssClass'	=> 'wdt-200px'
					]
			]);
	}
}