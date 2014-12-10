<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Traits
 */
	
namespace AxC\Framework\Traits;

/**
 * Trait to add reference to the user creation, update, soft delete of the specific record.
 */
trait UserReferenceManager
{
	/**
	 * Called before the creation of the record.
	 * @return null
	 */
	public function beforeCreate()
	{
		$user = \BackendAuth::getUser();
		if ($user) $this->created_by_id = $user->id;
	}

	/**
	 * Called before the update of the record.
	 * @return null
	 */
	public function beforeUpdate()
	{
		$user = \BackendAuth::getUser();
		if ($user) $this->updated_by_id = \BackendAuth::getUser()->id;
	}

	/**
	 * Called before the soft delete of the record.
	 * @return null
	 */
	public function beforeDelete()
	{
		$user = \BackendAuth::getUser();
		if ($user) $this->deleted_by_id = \BackendAuth::getUser()->id;
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
		return $this->$field ?
			$this->$field->getAvatarThumb($size) :
			"http://www.placehold.it/{$size}x$size";
	}
}