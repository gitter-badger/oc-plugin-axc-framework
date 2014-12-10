<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Helpers
 */

namespace AxC\Framework\Helpers;

/**
 * Image helper.
 * @abstract
 */
abstract class ImageField
{
	/**
	 * Thumb auto mode.
	 * @var string
	 */
	const MODE_AUTO = 'auto';

	/**
	 * Thumb crop mode.
	 * @var string
	 */
	const MODE_CROP = 'crop';

	/**
	 * Thumb exact mode.
	 * @var string
	 */
	const MODE_EXACT = 'exact';

	/**
	 * Thumb landscape mode.
	 * @var string
	 */
	const MODE_LANDSCAPE = 'landscape';

	/**
	 * Thumb portrait mode.
	 * @var string
	 */
	const MODE_PORTRAIT = 'portrait';

	/**
	 * PlaceHold URL for default image.
	 * @var string
	 */
	const PLACEHOLD_URL = 'http://www.placehold.it/%dx%d';

	/**
	 * Return the path of the image field record
	 * @static
	 * @param string $value
	 * @param string $setting_model
	 * @param string $controller
	 * @param int $width
	 * @param int $height
	 * @return string 
	 */
	public static function path($value, $width, $height)
	{
		return $value ? $value->getPath() : sprintf(static::PLACEHOLD_URL, $width, $height);
	}

	/**
	 * Return the path of the image field record using the dimension from @var $setting_model DB table and field @var $controller.
	 * @static
	 * @param string $value
	 * @param string $setting_model
	 * @param string $controller
	 * @param int $width
	 * @param int $height
	 * @return string 
	 */
	public static function pathFromSettings($value, $settings_model, $controller)
	{
		$width = $settings_model::get("{$controller}_image_width", $width);
		$height = $settings_model::get("{$controller}_image_height", $height);
		return $value ? $value->getPath() : sprintf(static::PLACEHOLD_URL, $width, $height);
	}

	/**
	 * Return the path of the resized image field record.
	 * @static
	 * @param string $value
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
	public static function thumb($value, $width, $height, $mode)
	{
		return $value ? $value->getThumb($width, $height, ['mode' => $mode] ) : sprintf(static::PLACEHOLD_URL, $width, $height);
	}

	/**
	 * Return the path of the resized image field record using the dimension from @var $setting_model DB table and field @var $controller.
	 * @static
	 * @param string $value
	 * @param string $setting_model
	 * @param string $controller
	 * @return string
	 */
	public static function thumbFromSettings($value, $settings_model, $controller, $mode)
	{
		$width = $settings_model::get("{$controller}_image_width");
		$height = $settings_model::get("{$controller}_image_height");
		return $value ? $value->getThumb($width, $height, ['mode' => $mode] ) : sprintf(static::PLACEHOLD_URL, $width, $height);
	}
}