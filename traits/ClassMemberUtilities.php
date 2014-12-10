<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Traits
 */

namespace AxC\Framework\Traits;

/**
 * ClassMemberUtilities trait.
 */
trait ClassMemberUtilities
{
	/**
	 * Add to the member @var $member the value @var $value if the key @var $key is not exist.
	 * @param string $key 
	 * @param string $value
	 * @param string $member
	 * @return null
	 */
	protected function _addIfKeyNotExist($key, $value, $member)
	{
		if ( !array_key_exists($key, $this->$member) )
		{
			$data = &$this->$member;
			$data[$key] = $value;
		}
	}

	/**
	 * Add @var $value to @var member if not already present.
	 * @var string $value
	 * @return null
	 */
	protected function _addIfNotPresent($value, $member)
	{
		if ( !in_array($value, $this->$member) ) array_push($this->$member, $value);
	}

	/**
	 * Initialize the data member @var $member.
	 * @param string $member
	 * @return null
	 */
	protected function _initMember($member)
	{
		if ( !@$this->$member ) $this->$member = [];
	}
}