<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Models
 */

namespace AxC\Framework\Models;

/**
 * FilterAlpha model class.
 */
class FilterAlpha extends \Model
{
	/**
	 * DB Table name.
	 * @var string
	 */
	protected $table = 'axc_framework_filter_alpha';

	/**
	 * Modal validation.
	 * @var array
	 */
	public $rules = [
		'code'		=> 'required|unique:axc_framework_filter_alpha|regex:/[A-Za-z0-9\-]*/',
		'message'	=> 'required'
	];
}