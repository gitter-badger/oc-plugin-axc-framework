<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Models
 */

namespace AxC\Framework\Models;

/**
 * FilterInteger model class.
 */
class FilterIntegerRange extends \Model
{
	/**
	 * DB Table name.
	 * @var string
	 */
	protected $table = 'axc_framework_filter_integer_range';

	/**
	 * Modal validation.
	 * @var array
	 */
	public $rules = [
		'start'		=> 'required|unique:axc_framework_filter_integer_range|integer',
		'end'			=> 'required|unique:axc_framework_filter_integer_range|integer',
		'message'	=> 'required'
	];
}