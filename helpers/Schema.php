<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Helpers
 */

namespace AxC\Framework\Helpers;

/**
 * Class to add helpers for Laravel Eloquent Schema Builder.
 * @abstract
 */
abstract class Schema
{
	/**
	 * Init the @var $table model.
	 * @static
	 * @param \Illuminate\Database\Schema\Blueprint &$table
	 * @return null
	 */
	public static function init(\Illuminate\Database\Schema\Blueprint &$table)
	{
		$table->engine = 'InnoDB';
		$table->increments('id');
	}

	/**
	 * Add published boolean field to the @var $table model.
	 * @static
	 * @param \Illuminate\Database\Schema\Blueprint &$table
	 * @return null
	 */
	public static function addPublished(\Illuminate\Database\Schema\Blueprint &$table)
	{
		static::addBoolean($table, 'published');
	}

	/**
	 * Add @var $field boolean field to the @var $table model.
	 * @static
	 * @param \Illuminate\Database\Schema\Blueprint &$table
	 * @param string $field
	 * @return null
	 */
	public static function addBoolean(\Illuminate\Database\Schema\Blueprint &$table, $field)
	{
		$table->boolean($field)->default(false)->index();
	}

	/**
	 * Add position integer field to the @var $table model.
	 * @static
	 * @param \Illuminate\Database\Schema\Blueprint &$table
	 * @return null
	 */
	public static function addPosition(\Illuminate\Database\Schema\Blueprint &$table)
	{
		$table->integer('position')->unique()->unsigned()->index();
	}

	/**
	 * Add position integer field to the @var $table model (NOT unique version).
	 * @static
	 * @param \Illuminate\Database\Schema\Blueprint &$table
	 * @return null
	 */
	public static function addPositionNotUnique(\Illuminate\Database\Schema\Blueprint &$table)
	{
		$table->integer('position')->unsigned()->index();
	}

	/**
	 * Add user reference for different record action to the @var $table model.
	 * @static
	 * @param \Illuminate\Database\Schema\Blueprint &$table
	 * @return null
	 */
	public static function addChangedBy(\Illuminate\Database\Schema\Blueprint &$table)
	{
		$table->integer('created_by_id')->unsigned()->nullable();
		$table->integer('deleted_by_id')->unsigned()->nullable();
		$table->integer('updated_by_id')->unsigned()->nullable();
		$table->foreign('created_by_id')->references('id')->on('backend_users');
		$table->foreign('updated_by_id')->references('id')->on('backend_users');
		$table->foreign('deleted_by_id')->references('id')->on('backend_users');
	}

	/**
	 * Add created_at and updated_at datatime field to the @var $table model.
	 * @static
	 * @param \Illuminate\Database\Schema\Blueprint &$table
	 * @return null
	 */
	public static function addChangedAt(\Illuminate\Database\Schema\Blueprint &$table)
	{
		$table->timestamps();
	}

	/**
	 * Add soft deletion to the @var $table model.
	 * @static
	 * @param \Illuminate\Database\Schema\Blueprint &$table
	 * @return null
	 */
	public static function avoidDelete(\Illuminate\Database\Schema\Blueprint &$table)
	{
		$table->softDeletes();
	}

	/**
	 * Add soft deletion to the @var $table model.
	 * @static
	 * @param \Illuminate\Database\Schema\Blueprint &$table
	 * @param string $field
	 * @param string $on
	 * @return null
	 */
	public static function foreign(\Illuminate\Database\Schema\Blueprint &$table, $field, $on)
	{
		$table->integer("{$field}_id")->unsigned()->nullable();
		$table->foreign("{$field}_id")->references('id')->on("axc_{$on}_{$field}");
	}
}