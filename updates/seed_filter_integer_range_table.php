<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package AxC\Framework\Updates
 */

namespace AxC\Framework\Updates;

use AxC\Framework\Models\FilterIntegerRange;

/**
 * Add data to FilterIntegerRange DB scheme.
 */
class SeedFilterIntegerRangeTable extends \Seeder
{
	/**
	 * Add data to DB scheme
	 * @return null;
	 */
	public function run()
	{
		FilterIntegerRange::truncate();

		$start_range = 0;
		$end_range = 90; 
		$step = 10;
		$offset = 1;
		foreach (range($start_range, $end_range, $step) as $start)
			FilterIntegerRange::create( [ 'start' => $start + $offset, 'end' => $start + $step, 'message' => ($start + $offset) .' - '. ($start + $step) ] );
	}
}