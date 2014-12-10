<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Models
 */

namespace AxC\Framework\Models;

\Validator::resolver(function($translator, $data, $rules, $messages)
{
	return new \AxC\Framework\Classes\Validator($translator, $data, $rules, $messages);
});

/**
 * Base model.
 */
abstract class Base extends \Model
{
	/**
	 * For soft delete method.
	 */
	use \Illuminate\Database\Eloquent\SoftDeletingTrait;

	/**
	 * Model validation.
	 */
	use \October\Rain\Database\Traits\Validation;

	/**
	 * Manage the user reference to this model.
	 */
	use \AxC\Framework\Traits\UserReferenceManager;

	/**
	 * Useful methods to init and add data to class member variables. 
	 */
	use \AxC\Framework\Traits\ClassMemberUtilities;

	/**
	 * To manage dynamic scopes of the model to use for the list filter.
	 */
	use \AxC\Framework\Traits\ScopeFilter;

	/**
	 * Values are converted to an instance of Carbon/DateTime objects after fetching.
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * Set the Created and updated by users references.
	 * Add TranslatableModel and Filter behaviors to implement.
	 * Add published field to filter in yes-no mode.
	 * @param array $attributes [ = [] ] 
	 */
	public function __construct( array $attributes = [] )
	{
		$this->_initMember('belongsTo');
		$this->_initMember('implement');

		$this->_addIfKeyNotExist( 'created_by', ['Backend\Models\User', 'foreignKey' => 'created_by_id'], 'belongsTo');
		$this->_addIfKeyNotExist( 'updated_by', ['Backend\Models\User', 'foreignKey' => 'updated_by_id'], 'belongsTo');

		if ( is_array($this->translatable) )
			$this->_addIfNotPresent('RainLab.Translate.Behaviors.TranslatableModel', 'implement');

		parent::__construct($attributes);
	}

	/**
	 * Return the published records order by position in ASCENDING order.
	 * @param \October\Rain\Database\Builder $query
	 * @return array
	 */
	public function scopePublished($query)
	{
		return $query->wherePublished(true)->orderBy('position', 'ASC')->get()->all();
	}

	/**
	 * Update the position of all the records before to save the current ones.
	 * @return null
	 */
	public function beforeSave()
	{
		if ($this->position !== null && $this->position !== $this->original['position'] )
			static::wherePosition($this->position)->where('id', '<>', $this->id)->update( ['position' => -1] );
	}

	/**
	 * Finalize the update the position of all the records after the save of the current ones.
	 * @return null
	 */
	public function afterSave()
	{
		if ( $this->position !== null && $this->position !== $this->original['position'] )
			static::wherePosition(-1)->where('id', '<>', $this->id)->update( ['position' => $this->original['position'] ] );
	}
}