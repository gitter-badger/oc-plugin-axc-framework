<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Behaviors
 */
	
namespace AxC\Framework\Behaviors;

/**
 * User Reference model extension.
 *
 * Usage:
 *
 * In the model class definition:
 *
 *   public $implement = ['AxC.Framework.Behaviors.UserReferenceModel'];
 *
 */
class UserReferenceModel extends \System\Classes\ModelBehavior
{
	/**
	 * {@inheritDoc}
	 */
	public function __construct(\Model $model)
	{
		$model->belongsTo['created_by'] = ['Backend\Models\User', 'foreignKey' => 'created_by_id'];
		$model->belongsTo['updated_by'] = ['Backend\Models\User', 'foreignKey' => 'updated_by_id'];

		parent::__construct($model);

		$model->bindEvent('model.beforeCreate', function() use ($model)
		{
			$user = \BackendAuth::getUser();
			if ($user) $model->created_by_id =$user->id;
		});

		$model->bindEvent('model.beforeUpdate', function() use ($model)
		{
			$user = \BackendAuth::getUser();
			if ($user) $model->updated_by_id = \BackendAuth::getUser()->id;
		});

		$model->bindEvent('model.beforeDelete', function() use ($model)
		{
			$user = \BackendAuth::getUser();
			if ($user) $model->deleted_by_id = \BackendAuth::getUser()->id;
		});
	}

	/**
	 * Return the avatar image path of user that performed the creation to the record.
	 * @param int $size
	 * @return string
	 */
	public function createdByAvatar($size)
	{
		return $this->__avatar('created_by', $size);
	}

	/**
	 * Return the avatar image path of user that performed the last update to the record.
	 * @param int $size
	 * @return string
	 */
	public function updatedByAvatar($size)
	{
		return $this->__avatar('updated_by', $size);
	}

	/**
	 * Return the avatar image path of user that performed the soft delete to the record.
	 * @param int $size
	 * @return string
	 */
	public function deletedByAvatar($size)
	{
		return $this->__avatar('deleted_by', $size);
	}

	/**
	 * Internal method to get the avatar image path based on the @var $field.
	 * @param string $field
	 * @param int $size
	 * @return string
	 */
	private function __avatar($field, $size)
	{
		return $this->model->$field ? $this->model->$field->getAvatarThumb($size) : "http://www.placehold.it/{$size}x$size";
	}
}