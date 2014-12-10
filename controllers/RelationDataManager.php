<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Controllers
 */

namespace AxC\Framework\Controllers;

/**
 * RelationDataManager controller.
 */
abstract class RelationDataManager extends DataManager
{
	/**
	 * Reference to relation configuration
	 * @var string
	 */
	public $relationConfig = 'relation_config.yaml';

	/**
	 * Add RelationController behaviors to implement data member.
	 */
	public function __construct()
	{
		$this->_initMember('implement');
		$this->_addIfNotPresent('Backend.Behaviors.RelationController', 'implement');
		parent::__construct();
	}
}