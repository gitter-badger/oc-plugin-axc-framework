<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package AxC\Framework\Updates
 */

namespace AxC\Framework\Updates;

/**
 * Add data to FilterYesNo DB scheme.
 */
class SeedFilterYesNoTable extends \Seeder
{
	/**
	 * Add data to DB scheme
	 * @return null;
	 */
	public function run()
	{
		foreach (['0' => 'No', '1' => 'Yes'] as $code => $message)
			\AxC\Framework\Models\FilterYesNo::create( [ 'code' => $code, 'message' => $message ] );
	}
}