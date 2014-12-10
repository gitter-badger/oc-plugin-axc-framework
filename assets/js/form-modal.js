/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 **/

+function ($)
{
	"use strict";

	var axcFormModal = function()
	{
		this.updateRecord = function(record_id)
		{
			var newModal = $('<a />');
			newModal.popup({
				handler: 'onUpdateForm',
				extraData: {
					'record_id': record_id,
				}
			});
		}

		this.createRecord = function()
		{
			var newModal = $('<a />');
			newModal.popup({ handler: 'onCreateForm' });
		}
	}

	$.axc_framework_form_modal = new axcFormModal;

}(window.jQuery);