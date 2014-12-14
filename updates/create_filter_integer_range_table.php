<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Updates
 */

namespace AxC\Framework\Updates;

use AxC\Framework\Helpers\Schema as SchemaHelper;

/**
 * Create the FilterIntegerRange DB scheme.
 */
class CreateFilterIntegerRangeTable extends \October\Rain\Database\Updates\Migration
{
	/**
	 * Create the DB scheme.
	 * @return null;
	 */
	public function up()
	{
		\Schema::dropIfExists('axc_framework_filter_integer_range');
		\Schema::create('axc_framework_filter_integer_range', function($table)
		{
			SchemaHelper::init($table);
			$table->integer('start')->index();
			$table->integer('end')->index();
			$table->string('message');
			SchemaHelper::addChangedAt($table);
			SchemaHelper::avoidDelete($table);
		});
	}

	/**
	 * Delete the DB scheme.
	 * @return null;
	 */
	public function down()
	{
		\Schema::dropIfExists('axc_framework_filter_integer_range');
	}
}