<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */

namespace AxC\Framework\Behaviors;

/**
 * Published attribute model extension.
 *
 * Usage:
 *
 * In the model class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.PublishedAttributeModel'];
 *
 */
class PublishedAttributeModel extends \System\Classes\ModelBehavior
{
	/**
	 * Return the published records order by position in ASCENDING order.
	 * @param \October\Rain\Database\Builder $query
	 * @return array
	 */
	public function scopePublished(\October\Rain\Database\Builder $query)
	{
		return $query->wherePublished(true)->orderBy('position', 'ASC')->get()->all();
	}
}