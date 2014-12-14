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
 *   public $implement = ['AxC.Framework.Behaviors.PositionAttributeModel'];
 *
 */
class PositionAttributeModel extends \System\Classes\ModelBehavior
{
	/**
	 * {@inheritDoc}
	 */
	public function __construct(\Model $model)
	{
		parent::__construct($model);

		$this->model->bindEvent('model.beforeSave', function($key) use ($model)
		{
			if( $model->id && $model->position !== @$model->original['position'] )
			$model::wherePosition($model->position)->where('id', '<>', $model->id)->update( ['position' => -1] );
		});

		$this->model->bindEvent('model.afterSave', function($key) use ($model)
		{
			if ( $model->id && $model->position !== @$model->original['position'] )
				$model::wherePosition(-1)->where('id', '<>', $model->id)->update( ['position' => @$model->original['position'] ] );
		});
	}

}