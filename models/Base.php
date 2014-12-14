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
		$this->implement[] = 'AxC.Framework.Behaviors.UserReferenceModel';
		if ( is_array($this->translatable) ) $this->implement[] = 'RainLab.Translate.Behaviors.TranslatableModel';

		if ( array_key_exists('principal', $this->rules) ) $this->implement[] = 'AxC.Framework.Behaviors.PrincipalAttributeModel';
		if ( array_key_exists('published', $this->rules) ) $this->implement[] = 'AxC.Framework.Behaviors.PublishedAttributeModel';
		if ( array_key_exists('principal', $this->rules) ) $this->implement[] = 'AxC.Framework.Behaviors.PrincipalAttributeModel';

		$this->implement = array_unique($this->implement);
		parent::__construct($attributes);
	}
}