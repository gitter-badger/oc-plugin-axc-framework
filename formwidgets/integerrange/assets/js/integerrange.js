/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

$(function ()
{
	$('*[data-integerrange]').find('input[type="text"]').on('change', function ()
	{
		var $this = $(this);
		if ($this.val() == "")
			$this.removeClass('text-center').addClass('text-right');
		else if ( !$this.hasClass('text-center') )
			$this.removeClass('text-right').addClass('text-center');
	});
});