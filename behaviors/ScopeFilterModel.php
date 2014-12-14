<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */

namespace AxC\Framework\Behaviors;

/**
 * Scope filter model extension.
 *
 * Usage:
 *
 * In the model class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.ScopeFilterModel'];
 *
 */
class ScopeFilterModel extends \System\Classes\ModelBehavior
{
	/**
	 * Provide scope functionality: starts with some value.
	 * @param \October\Rain\Database\Builder query
	 * @param array $params
	 * @param \Backend\Classes\FilterScope $scope
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function scopeFilterStarts(\October\Rain\Database\Builder $query, array $params, \Backend\Classes\FilterScope $scope)
	{
		return $this->__filterOperator($query, $params, $scope, 'LIKE', '%s%%');
	}

	/**
	 * Provide scope functionality: equals with some value.
	 * @param \October\Rain\Database\Builder query
	 * @param array $params
	 * @param \Backend\Classes\FilterScope $scope
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function scopeFilterEquals(\October\Rain\Database\Builder $query, array $params, \Backend\Classes\FilterScope $scope)
	{
		return $this->__filterOperator($query, $params, $scope, '=', '%s');
	}

	/**
	 * Provide scope functionality: inside an integer range.
	 * @param \October\Rain\Database\Builder query
	 * @param array $params
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function scopeFilterIntegerRange(\October\Rain\Database\Builder $query, array $params, $scope)
	{
		$field = $this->__getField($scope);
		$where_cond = 'where';
		$q = $query;
		foreach ($params as $id)
		{
			$obj = $this->__getModel($scope, $id);
			$q = $q->$where_cond($field, '>=', $obj->start)->where($field, '<=', $obj->end);
			$where_cond = 'orWhere';
		}
		return $q->get();
	}

	private function __getField($scope)
	{
		list($field) = explode('_', $scope->scopeName);
		return $field;
	}

	private function __getModel($scope, $id)
	{
		$model_class = $scope->config['modelClass'];
		return $model_class::find($id);
	}

	/**
	 * Performn the scope filter based on @var $operator and @var $pattern_match.
	 * @param \October\Rain\Database\Builder query
	 * @param array $params
	 * @param \Backend\Classes\FilterScope $scope
	 * @param string $pattern_match
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	private function __filterOperator(\October\Rain\Database\Builder $query, array $params, \Backend\Classes\FilterScope $scope, $operator, $pattern_match)
	{
		$where_cond = 'where';
		$q = $query;
		foreach ($params as $id)
		{
			$obj = $this->__getModel($scope, $id);
			$q = $q->$where_cond( $this->__getField($scope), $operator, sprintf($pattern_match, $obj->code) );
			$where_cond = 'orWhere';
		}
		return $q->get();
	}
}