<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package AxC\Framework\Updates
 */

namespace AxC\Framework\Updates;

use AxC\Framework\Models\FilterBoolean;

/**
 * Add data to FilterBoolean DB scheme.
 */
class SeedFilterBooleanTable extends \Seeder
{
	/**
	 * Add data to DB scheme
	 * @return null;
	 */
	public function run()
	{
		FilterBoolean::truncate();

		foreach (['0' => 'False', '1' => 'True'] as $code => $message)
			FilterBoolean::create( [ 'code' => $code, 'message' => $message ] );
	}
}