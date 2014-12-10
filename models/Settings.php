<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Models
 */

namespace AxC\Framework\Models;

/**
 * Settings model.
 */
class Settings extends \Model
{
	/**
	 * AxC Category.
	 * @var string
	 */
	const CATEGORY_AXC = 'axc.framework::lang.system.categories.label';

	/**
	 * Implement the System.Behaviors.SettingsModel behavior.
	 * @param array 
	 */
	public $implement = ['System.Behaviors.SettingsModel'];

	/**
	 * Reference to field configuration
	 * @param string
	 */
	public $settingsFields = 'fields.yaml';
}