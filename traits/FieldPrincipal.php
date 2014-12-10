<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Traits
 */

namespace AxC\Framework\Traits;

/**
 * Trait to manage the update of the principal field.
 */
trait FieldPrincipal
{
	/**
	 * Update the principal field of all the records (including the ones in trash) before save the current one.
	 * @return mixed
	 */
	public function beforeSave()
	{
		if ($this->principal) static::withTrashed()->wherePrincipal(true)->where('id', '<>', $this->id)->update( ['principal' => false] );
		return parent::beforeSave();
	}

	/**
	 * Return the principal records order by position in ASCENDING order.
	 * @param \October\Rain\Database\Builder $query
	 * @return array
	 */
	public function scopePrincipal($query)
	{
		return $query->wherePrincipal(true)->orderBy('position', 'ASC')->first();
	}
}