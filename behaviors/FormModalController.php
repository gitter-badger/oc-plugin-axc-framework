<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */

namespace AxC\Framework\Behaviors;

/**
 * Form controller extension with modal actions.
 *
 * Usage:
 *
 * In the controller class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.FormModalController'];
 *
 */
class FormModalController extends FormController
{
	/**
	 * {@inheritDoc}
	 */
	public function __construct(\Backend\Classes\Controller $controller)
	{
		parent::__construct($controller);
		$this->addJs('/plugins/axc/framework/assets/dist/form-modal.js', 'core');
	}

	/**
	 * Called when view the creation form.
	 * @return mixed Partial contents or false if not throwing an exception.
	 */
	public function index_onCreateForm()
	{
		parent::create();
		return $this->makePartial('create');
	}

	/**
	 * Called when record is created.
	 * @return array The list element selector as the key, and the list contents are the value.
	 */
	public function index_onCreate()
	{
		parent::create_onSave();
		return $this->controller->listRefresh();
	}
	/**
	 * Called when view the update form.
	 * @return mixed Partial contents or false if not throwing an exception.
	 */
	public function index_onUpdateForm()
	{
		$record_id = post('record_id');
		parent::update($record_id);
		$this->controller->vars['record_id'] = $record_id;
		return $this->makePartial('update');
	}

	/**
	 * Called when record is updated.
	 * @return array The list element selector as the key, and the list contents are the value.
	 */
	public function index_onUpdate()
	{
		$record_id = post('record_id');
		parent::update_onSave($record_id));
		return $this->controller->listRefresh();
	}
}