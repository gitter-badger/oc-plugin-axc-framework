<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Helpers
 */

namespace AxC\Framework\Helpers;

/**
 * String helper.
 * @abstract
 */
abstract class String
{
	/**
	 * Check if the string starts with @var $needle
	 * @static
	 * @param string $needle
	 * @return bool
	 */
	public static function startsWith($needle, $haystack)
	{
		return $needle === '' || strrpos( $haystack, $needle, -strlen($haystack) ) !== FALSE;
	}

	/**
	 * Check if the string ends with @var $needle
	 * @static
	 * @param string $needle
	 * @return bool
	 */
	public function endsWith($needle, $haystack)
	{
		return $needle === '' || strpos( $haystack, $needle, strlen($haystack) - strlen($needle) ) !== FALSE;
	}
}