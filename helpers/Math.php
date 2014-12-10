<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Helpers
 */

namespace AxC\Framework\Helpers;

/**
 * Math helper.
 * @abstract
 */
abstract class Math
{
	/**
	 * Return the sign of @var $x
	 * @static
	 * @param number $x
	 */
	public static function sign($x)
	{
		return min( 1, max(-1, $x) );
	}
}

