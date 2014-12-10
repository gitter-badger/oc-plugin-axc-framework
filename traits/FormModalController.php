<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Traits
 */

namespace AxC\Framework\Traits;

/**
 * Trait to add form modal functionalities.
 */
trait FormModalController
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
	 * Initialize the modal mode loading the needed resources.
	 * @param array $options [ = [] ]
	 * @return null 
	 */
	protected function _initForm( array $options = [] )
	{
		$this->vars = array_merge($this->vars, $options);
		$this->vars['controller'] = $this;
		$this->vars['action'] = $this->action;
		$this->addJs('/plugins/axc/framework/assets/dist/form-modal.js');
	}

	/**
	 * Called when view the creation form.
	 * @return mixed Partial contents or false if not throwing an exception.
	 */
	public function onCreateForm()
	{
		$this->asExtension('FormController')->create();
		return $this->makePartial('@/plugins/axc/framework/partials/backend/controllers/modal/create.htm');
	}

	/**
	 * Called when record is created.
	 * @return array The list element selector as the key, and the list contents are the value.
	 */
	public function onCreate()
	{
		$this->asExtension('FormController')->create_onSave();
		return $this->listRefresh();
	}
	/**
	 * Called when view the update form.
	 * @return mixed Partial contents or false if not throwing an exception.
	 */
	public function onUpdateForm()
	{
		$this->asExtension('FormController')->update( post('record_id') );
		$this->vars['record_id'] = post('record_id');
		return $this->makePartial('@/plugins/axc/framework/partials/backend/controllers/modal/update.htm');
	}

	/**
	 * Called when record is updated.
	 * @return array The list element selector as the key, and the list contents are the value.
	 */
	public function onUpdate()
	{
		$this->asExtension('FormController')->update_onSave( post('record_id') );
		return $this->listRefresh();
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