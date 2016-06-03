/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */
CKEDITOR.plugins.addExternal('fmath_formula', 'plugins/fmath_formula/', 'plugin.js');
CKEDITOR.plugins.addExternal('video', 'plugins/video/', 'plugin.js');
CKEDITOR.plugins.addExternal('html5audio', 'plugins/html5audio/', 'plugin.js');

CKEDITOR.editorConfig = function( config ) {
	CKEDITOR.config.allowedContent = true;
	config.protectedSource.push(/<\?[\s\S]*?\?>/g); // PHP Code
	config.protectedSource.push(/<code>[\s\S]*?<\/code>/gi); // Code tags
	config.filebrowserBrowseUrl = '../plugins/plg_kcfinder/browse.php?type=files&dir=files';
	config.filebrowserImageBrowseUrl = '../plugins/plg_kcfinder/browse.php?type=images&dir=images';
	config.filebrowserFlashBrowseUrl = '../plugins/plg_kcfinder/browse.php?type=flash&dir=flash';	
	config.filebrowserVideoBrowseUrl = '../plugins/plg_kcfinder/browse.php?type=video&dir=videos';	
	config.language = 'id';
	
	CKEDITOR.config.skin = 'default';
	config.extraPlugins = "fmath_formula,video";
	
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] }
	];	
};
