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
	 * {@inheritDoc}
	 */
	public $formConfig = 'form_config.yaml';

	/**
	 * {@inheritDoc}
	 */
	public $listConfig = 'list_config.yaml';

	/**
	 * Controller extensions.
	 * @var array
	 */
	public $implement = [
		'AxC.Framework.Behaviors.BackendController',
		'AxC.Framework.Behaviors.BackendAssetController',
		'AxC.Framework.Behaviors.BreadcrumbController',
		'AxC.Framework.Behaviors.FormController',
		'AxC.Framework.Behaviors.ListController',
		'AxC.Framework.Behaviors.ListTrashController',
		'AxC.Framework.Behaviors.PositionAttributeController',
		'AxC.Framework.Behaviors.PrincipalAttributeController',
		'AxC.Framework.Behaviors.PublishedAttributeController',
		'AxC.Framework.Behaviors.ReportWidgetController'
	];
}