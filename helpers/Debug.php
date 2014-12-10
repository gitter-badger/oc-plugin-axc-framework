<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Helpers
 */

namespace AxC\Framework\Helpers;

/**
 * Debug helper methods.
 * @abstract
 */
abstract class Debug
{
	/**
	 * Dump and die if @var $value is an array.
	 * @param mixed $value
	 * @return null
	 */
	public static function dieIfArray($value)
	{
		if ( is_array($value) )
		{
			var_dump($value);
			die('--- END ---');
		}
	}
}