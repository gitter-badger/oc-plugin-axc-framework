<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Alphas\Updates
 */

namespace AxC\DataManagement\Updates;

use AxC\Framework\Helpers\Schema as SchemaHelper;

/**
 * Create the FilterAlpha DB scheme.
 */
class CreateFilterAlphaTable extends \October\Rain\Database\Updates\Migration
{
	/**
	 * Create the DB scheme.
	 * @return null;
	 */
	public function up()
	{
		\Schema::dropIfExists('axc_framework_filter_alpha');
		\Schema::create('axc_framework_filter_alpha', function($table)
		{
			SchemaHelper::init($table);
			$table->string('code')->index();
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
		\Schema::drop('axc_framework_filter_alpha');
	}
}