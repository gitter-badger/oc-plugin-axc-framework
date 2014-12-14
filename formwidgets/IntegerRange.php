<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\DataManagement\FormWidgets
 */

namespace AxC\Framework\FormWidgets;

/**
 * Widget to display plus/minus buttons with a text field to insert an integer number.
 */
class IntegerRange extends \Backend\Classes\FormWidgetBase
{
	/**
	 * {@inheritDoc}
	 */
	public $defaultAlias = 'integerrange';

	/**
	 * HTML class for button value increment.
	 * @var string
	 */
	public $incClass = 'btn btn-success'; 

	/**
	 * HTML class for button value decrement.
	 * @var string
	 */
	public $decClass = 'btn btn-danger';

	/**
	 * Icon class for button value increment.
	 * @var string
	 */
	public $incIconClass = 'icon-plus';

	/**
	 * Icon class for button value decrement.
	 * @var string
	 */
	public $decIconClass = 'icon-minus';

		/**
		 * Prepares the widget data.
		 * @return null
		 */
	public function prepareVars()
	{
		$this->vars['incClass'] = $this->incClass;
		$this->vars['decClass'] = $this->decClass;
		$this->vars['incIconClass'] = $this->incIconClass;
		$this->vars['decIconClass'] = $this->decIconClass;
		$this->vars['stretch'] = $this->formField->stretch;
		$this->vars['size'] = $this->formField->size;
		$this->vars['placeholder'] = trans(@$this->formField->placeholder);
		$this->vars['name'] = $this->formField->getName();
		$this->vars['value'] = $this->getLoadData();
	}

	/**
	 * {@inheritDoc}
	 */
	public function render()
	{
		$this->prepareVars();
		return $this->makePartial('integerrange');
	}

	/**
	 * {@inheritDoc}
	 */
	public function loadAssets()
	{
			$this->addJs('js/integerrange.js', 'core');
	}
}