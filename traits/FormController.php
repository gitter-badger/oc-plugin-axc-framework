<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Traits
 */

namespace AxC\Framework\Traits;

/**
 * Trait to add form functionalities.
 */
trait FormController
{
	/**
	 * Reference to from configuration
	 * @var string
	 */
	public $formConfig = 'form_config.yaml';

	/**
	 * Reference to list configuration
	 * @var string
	 */
	public $listConfig = [ 'list' => 'list_config.yaml' ];

	/**
	 * Initialize the form loading the needed resources.
	 * @param array $options [ = [] ]
	 * @return null 
	 */
	protected function _initFormController( array $options = [] )
	{
		$this->_initMember('implement');
		$this->_addIfNotPresent('Backend.Behaviors.FormController', 'implement');
		$this->_addIfNotPresent('Backend.Behaviors.ListController', 'implement');

		\Event::listen('backend.list.injectRowClass', function ($list, $record)
		{
			return @$record->deleted_at ? 'danger strong' : false;
		});

		$this->vars = array_merge($this->vars, $options);

		$this->vars['controller'] = $this;
		$this->vars['action'] = $this->action;
		$this->vars['indexTitle'] = trans("axc.$this->pluginId::lang.$this->type.label.singular");
		$this->vars['cancelURL'] = "axc/$this->pluginId/". str_replace('.', '', $this->type);
	}

	/**
	 * Called when view the creation form.
	 * @return mixed Partial contents or false if not throwing an exception.
	 */
	public function create()
	{
		$this->asExtension('FormController')->create();
		return $this->makePartial('@/plugins/axc/framework/partials/backend/controllers/standard/create.htm');
	}

	/**
	 * Called when view the update form.
	 * @param int $recordId The model primary key to update.
	 * @param string $context Explicitly define a form context.
	 * @return mixed Partial contents or false if not throwing an exception.
	 */
	public function update($recordId, $context = null)
	{
		$this->asExtension('FormController')->update($recordId, $context);
		return $this->makePartial('@/plugins/axc/framework/partials/backend/controllers/standard/update.htm');
	}

	/**
	 * Called to view the form in read-only mode.
	 * @param int $recordId The model primary key to preview.
	 * @param string $context Explicitly define a form context.
	 * @return mixed Partial contents or false if not throwing an exception.
	 */
	public function preview($recordId = null, $context = null)
	{
		$this->asExtension('FormController')->preview($recordId, $context);
		return $this->makePartial('@/plugins/axc/framework/partials/backend/controllers/standard/preview.htm');
	}

	/**
	 * Index action.
	 * @return mixed Partial contents or false if not throwing an exception.
	 */
	public function index()
	{
		$this->asExtension('ListController')->index();
		return $this->makePartial('@/plugins/axc/framework/partials/backend/controllers/index.htm');
	}
}