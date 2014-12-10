<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package AxC\Framework\Updates
 */

namespace AxC\Framework\Updates;

/**
 * Add data to FilterAlpha DB scheme.
 */
class SeedFilterAlphaTable extends \Seeder
{
	/**
	 * Add data to DB scheme
	 * @return null;
	 */
	public function run()
	{
		foreach (range('a', 'z') as $code)
			\AxC\Framework\Models\FilterAlpha::create( [ 'code' => $code, 'message' => strtoupper($code) ] );
	}
}