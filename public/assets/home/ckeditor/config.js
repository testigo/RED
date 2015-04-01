/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'uk';
	// config.uiColor = '#AADC6E';
    config.pasteFromWordRemoveFontStyles = true;
    config.pasteFromWordPromptCleanup = true;
    config.pasteFromWordRemoveStyles = true;
    config.extraPlugins = 'youtube';
    config.uiColor = '#ffffff';
    config.toolbar = [
        { 
            name: 'paragraph', 
            items : [ 
                'Undo',
                'Redo',
                'Outdent',
                'Indent',
                'Blockquote',
                'JustifyLeft',
                'JustifyCenter',
                'JustifyRight',
                'JustifyBlock',
            ] 
        },
        { 
            name: 'basicstyles', 
            items : [ 
                'Bold',
                'Italic',
                'Underline',
                'Strike',
                'Subscript',
                'Superscript',
                'RemoveFormat',
                'NumberedList',
                'BulletedList',
            ] 
        },
        { 
            name: 'clipboard', 
            items : [ 
                'Cut',
                'Copy',
                'Paste',
                'PasteText',
                'PasteFromWord',
                'Find',
                'SelectAll',
                'TextColor',
                'BGColor', 
            ] 
        },
        { 
            name: 'styles', 
            items : 
            [ 
                'Styles',
                'Format',
                'Font',
                'FontSize', 
            ] 
        },
        { 
            name: 'insert', 
            items : [ 
                'Image',
                'Table',
                'HorizontalRule',
                'SpecialChar',
                'PageBreak',
                'Iframe',
                'Link',
                'Unlink',
                'Anchor',
            ] 
        },
        { 
            name: 'tools', 
            items : [ 
                'Maximize', 
                'ShowBlocks', 
            ] 
        }
    ]
};
