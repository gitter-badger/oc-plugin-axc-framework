/**
 * GULP Config
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

var axc_gulp = require('axc-gulp');
var __join = axc_gulp.plugin.path.join;

axc_gulp.config.set({
	title:				'AxC.Framework',
	path:					__join(__dirname, 'assets'),
	icon_notify:	__join(__dirname, 'assets/images/gulp/icon/notify.png')
});

axc_gulp.task
	// clean
	.clean({ src: ['dist/**', 'css/**', 'fonts/**'] })

	// axc-framework
	.less2dist({ concat: 'axc-framework' })
	.js2dist({ src: ['js/**/*.js', '!js/form-modal.js'], concat: 'axc-framework' })
	.run({ taskName: 'axc-framework', dependences: ['less2dist', 'js2dist'] })

	// form-modal
	.js2dist({ taskName: 'form-modal', src: 'js/form-modal.js', concat: 'form-modal' })

	// metro-ui
	.copy({ taskName: 'metro-ui-fonts', src: 'vendor/metro-ui-css/fonts/**', dest: 'fonts/metro-ui' })
	.less2dist({ taskName: 'metro-ui-css', src: [
		'vendor/metro-ui-css/less/metro-bootstrap.less',
		'vendor/metro-ui-css/less/icons.less',
		'vendor/metro-ui-css/less/metro-bootstrap-responsive.less'],
		dest: 'dist', concat: 'metro-ui', replace: { '@import "reset.less";': '', '@import "icons";' : '', '../fonts/': '../fonts/metro-ui/' } })
	.copy({ taskName: 'metro-ui-js', src: 'vendor/metro-ui-css/min/**.js', dest: 'dist', concat: 'metro-ui.js' })
	.run({ taskName: 'metro-ui', dependences: ['metro-ui-fonts', 'metro-ui-css', 'metro-ui-js'] })

	// default: all together
	.default(['axc-framework', 'form-modal', 'metro-ui']);


	//  in variables.less