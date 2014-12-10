<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package \AxC\Framework\Classes
 */

namespace AxC\Framework\Classes;

/**
 * Extended Translate plugin.
 */
class Translate
{
	private function __check()
	{
		return class_exists('RainLab\Translate\Behaviors\TranslatableModel');
	}

	public function menu()
	{
		if (	$this->__check() and class_exists('\Flynsarmy\Menu\Models\MenuItem') )
			\Flynsarmy\Menu\Models\MenuItem::extend(function ($model)
			{
				$model->implement[] = 'RainLab.Translate.Behaviors.TranslatableModel';
			});
	}
}