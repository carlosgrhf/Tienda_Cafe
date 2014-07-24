/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
        config.filebrowserBrowseUrl = '../lib/kcfinder/browse.php?type=files';
        config.filebrowserImageBrowseUrl = '../lib/kcfinder/browse.php?type=images';
        config.filebrowserFlashBrowseUrl = '../lib/kcfinder/browse.php?type=flash';
        config.filebrowserUploadUrl = '../lib/kcfinder/upload.php?type=files';
        config.filebrowserImageUploadUrl = '../lib/kcfinder/upload.php?type=images';
        config.filebrowserFlashUploadUrl = '../lib/kcfinder/upload.php?type=flash';
};
