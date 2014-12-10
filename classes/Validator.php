<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Classes
 */

namespace AxC\Framework\Classes;

/**
 * Extended Model validator.
 */
class Validator extends \Illuminate\Validation\Validator
{
	/**
	 * Customer error messages.
	 * @var array
	 */
	private $__custom_messages = [
		'select_unique' => 'The :attribute field is already taken.',
		'lowercase' => 'The :attribute field must be in lowercase format.',
		'uppercase' => 'The :attribute field must be in uppercase format.',
	];

	/**
	 * Perform basic setup.
	 * @param string $translator
	 * @param string $data
	 * @param string $rules
	 * @param array $messages [ = [ ] ]
	 * @param array $custom_attributes [ = [ ] ]
	 */
	public function __construct( $translator, $data, $rules, array $messages = [], array $custom_attributes = [] )
	{
		parent::__construct($translator, $data, $rules, $messages, $custom_attributes);
		$this->setCustomMessages($this->__custom_messages);
	}

	/**
	 * select_unique model validation.
	 * @param string $attributes
	 * @param string $value
	 * @param array $parameters
	 * @return bool
	 */
	public function validateSelectUnique( $attribute, $value, array $parameters = [] )
	{
		list($table, $column, $checkValue) = $parameters;
		return $value != $checkValue || \DB::table($table)->where( $column, $this->data[$column] )->where($attribute, $value)->where( 'id', '<>', $this->data['id'] )->count() == 0;
	}

	/**
	 * lowercase model validation.
	 * @param string $attributes
	 * @param string $value
	 * @param array $parameters
	 * @return bool
	 */
	public function validateLowercase( $attribute, $value, array $parameters = [] )
	{
		return ctype_lower($value);
	}

	/**
	 * uppercase model validation.
	 * @param string $attributes
	 * @param string $value
	 * @param array $parameters
	 * @return bool
	 */
	public function validateUppercase( $attribute, $value, array $parameters = [] )
	{
		return ctype_upper($value);
	}
}