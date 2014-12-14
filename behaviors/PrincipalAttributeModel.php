<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */

namespace AxC\Framework\Behaviors;

/**
 * Principal attribute model extension.
 *
 * Usage:
 *
 * In the model class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.PrincipalAttributeModel'];
 *
 */
class PrincipalAttributeModel extends \System\Classes\ModelBehavior
{
	/**
	 * {@inheritDoc}
	 */
	public function __construct(\Model $model)
	{
		parent::__construct($model);

		$this->model->bindEvent('model.beforeSave', function() use ($model)
		{
			if ($model->id && $model->principal)
				$model::withTrashed()->wherePrincipal(true)->where('id', '<>', $model->id)->update( ['principal' => false] );
		});
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