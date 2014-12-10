/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

$(function ()
{
	'use strict';

	$('*[data-tooltip]').tooltip();
	$('*[data-popover]').ocPopover();
	$('*[data-sortable]').sortable();
	$('*[data-switch]').bootstrapSwitch();
	$('input[type="checkbox"]').iCheck();

	//AxC.Bootstrap.Modal.Alert.set({ okClass: 'btn-primary oc-icon-check' }).replace();
	//AxC.Bootstrap.Modal.Confirm.set({ okClass: 'btn-danger oc-icon-check', cancelClass: 'btn-default oc-icon-times' }).replace();
});