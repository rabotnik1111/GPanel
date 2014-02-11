/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here. For example:
    config.language = 'ro';
    config.removePlugins = 'about,save,forms';
    config.extraPlugins = 'filebrowser,texttransform';
    config.filebrowserBrowseUrl = '/js/filemanager/index.html';
    config.height = 400;

    //config.uiColor = '#5cb85c';
};
