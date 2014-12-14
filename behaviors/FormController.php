<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */

namespace AxC\Framework\Behaviors;

/**
 * Form controller extension.
 *
 * Usage:
 *
 * In the controller class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.FormController'];
 *
 */
class FormController extends \Backend\Behaviors\FormController
{
	/**
	 * {@inheritDoc}
	 */
	public function create($content = NULL)
	{
		parent::create();
		return $this->makePartial('create');
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($recordId = NULL, $context = NULL)
	{
		parent::update($recordId, $context);
		return $this->makePartial('update');
	}

	/**
	 * {@inheritDoc}
	 */
	public function preview($recordId = NULL, $context = NULL)
	{
		parent::preview($recordId, $context);
		return $this->makePartial('preview');
	}


	/**
	 * {@inheritDoc}
	 */
	public function formExtendFields($form)
	{
		$span = ['left', 'right'];
		$num_fields = count( $form->getFields() );

		if ( \Schema::hasColumn($form->model->table, 'position') )
			$fields['position'] = [
				'comment' => 'axc.datamanagement::lang.email.fields.position.comment',
				'label' => 'axc.framework::lang.fields.position.label',
				'placeholder' => 'axc.framework::lang.fields.position.placeholder',
				'required' => true,
				'type' => 'integerrange',
				'span' => $span[$num_fields++ % 2]
			];

		if ( \Schema::hasColumn($form->model->table, 'published') )
			$fields['published'] = [
				'comment' => 'axc.datamanagement::lang.abbreviation.fields.published.comment',
				'label' => 'axc.framework::lang.fields.published.label',
				'type' => 'switch',
				'span' => 'left'
			];

		if ( \Schema::hasColumn($form->model->table, 'principal') )
			$fields['principal'] = [
				'comment'=> 'axc.datamanagement::lang.email.fields.principal.comment',
				'label' => 'axc.framework::lang.fields.principal.label',
				'type' => 'switch',
				'span' => 'right'
			];

		$form->addFields($fields);
	}
}