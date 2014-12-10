/**
 * GULP Config
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

var axc_gulp = require('axc-gulp');
var __join = axc_gulp.plugin.path.join;

axc_gulp.config.set({
	name:					'axc-framework',
	title:				'AxC.Framework',
	path:					__join(__dirname, 'assets'),
	icon_notify:	__join(__dirname, 'assets/images/gulp/icon/notify.png')
});

axc_gulp.task
	.clean({ src: ['dist/**', 'css/**'] })
	.less2css()
	.css2dist({ dependences: ['less2css'] })
	.js2dist({ src: ['js/**/*.js', '!js/form-modal.js'] })
	.js2dist({ taskName: 'js-form-modal', src: 'js/form-modal.js', outputName: 'form-modal' })
	.default(['css2dist', 'js2dist', 'js-form-modal']);