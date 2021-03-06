 ﻿
 ( function()
 {
 	function addQueryString( url, params )
 	{
 		var queryString = [];
 		if ( !params )
 			return url;
 		else
 		{
 			for ( var i in params )
 				queryString.push( i + "=" + encodeURIComponent( params[ i ] ) );
 		}
 		return url + ( ( url.indexOf( "?" ) != -1 ) ? "&" : "?" ) + queryString.join( "&" );
 	}
 	function ucFirst( str )
 	{
 		str += '';
 		var f = str.charAt( 0 ).toUpperCase();
 		return f + str.substr( 1 );
 	}
 	function browseServer( evt )
 	{
 		var dialog = this.getDialog();
 		var editor = dialog.getParentEditor();
 		editor._.filebrowserSe = this;
 		var width = editor.config[ 'filebrowser' + ucFirst( dialog.getName() ) + 'WindowWidth' ]
				|| editor.config.filebrowserWindowWidth || '80%';
		var height = editor.config[ 'filebrowser' + ucFirst( dialog.getName() ) + 'WindowHeight' ]
 				|| editor.config.filebrowserWindowHeight || '70%';
 		var params = this.filebrowser.params || {};
 		params.CKEditor = editor.name;
 		params.CKEditorFuncNum = editor._.filebrowserFn;
 		if ( !params.langCode )
 			params.langCode = editor.langCode;
		var url = addQueryString( this.filebrowser.url, params );
 		editor.popup( url, width, height, editor.config.filebrowserWindowFeatures || editor.config.fileBrowserWindowFeatures );
 	}
 	function uploadFile( evt )
 	{
 		var dialog = this.getDialog();
 		var editor = dialog.getParentEditor();
 		editor._.filebrowserSe = this;
 		if ( !dialog.getContentElement( this[ 'for' ][ 0 ], this[ 'for' ][ 1 ] ).getInputElement().$.value )
 			return false;
 		if ( !dialog.getContentElement( this[ 'for' ][ 0 ], this[ 'for' ][ 1 ] ).getAction() )
 			return false;
 		return true;
 	}
 	function setupFileElement( editor, fileInput, filebrowser )
 	{
 		var params = filebrowser.params || {};
 		params.CKEditor = editor.name;
 		params.CKEditorFuncNum = editor._.filebrowserFn;
 		if ( !params.langCode )
 			params.langCode = editor.langCode;
 		fileInput.action = addQueryString( filebrowser.url, params );
 		fileInput.filebrowser = filebrowser;
 	}
 	function attachFileBrowser( editor, dialogName, definition, elements )
 	{
 		var element, fileInput;
 		for ( var i in elements )
 		{
 			element = elements[ i ];
 			if ( element.type == 'hbox' || element.type == 'vbox' || element.type == 'fieldset' )
 				attachFileBrowser( editor, dialogName, definition, element.children );
 			if ( !element.filebrowser )
 				continue;
 			if ( typeof element.filebrowser == 'string' )
 			{
 				var fb =
 				{
 					action : ( element.type == 'fileButton' ) ? 'QuickUpload' : 'Browse',
 					target : element.filebrowser
 				};
 				element.filebrowser = fb;
 			}
 			if ( element.filebrowser.action == 'Browse' )
 			{
 				var url = element.filebrowser.url;
 				if ( url === undefined )
 				{
 					url = editor.config[ 'filebrowser' + ucFirst( dialogName ) + 'BrowseUrl' ];
 					if ( url === undefined )
 						url = editor.config.filebrowserBrowseUrl;
 				}
 				if ( url )
 				{
 					element.onClick = browseServer;
 					element.filebrowser.url = url;
 					element.hidden = false;
 				}
 			}
 			else if ( element.filebrowser.action == 'QuickUpload' && element[ 'for' ] )
 			{
 				url = element.filebrowser.url;
 				if ( url === undefined )
 				{
 					url = editor.config[ 'filebrowser' + ucFirst( dialogName ) + 'UploadUrl' ];
 					if ( url === undefined )
 						url = editor.config.filebrowserUploadUrl;
 				}
 				if ( url )
 				{
 					var onClick = element.onClick;
 					element.onClick = function( evt )
 					{
 						var sender = evt.sender;
 						if ( onClick && onClick.call( sender, evt ) === false )
 							return false;
 						return uploadFile.call( sender, evt );
 					};
 					element.filebrowser.url = url;
 					element.hidden = false;
 					setupFileElement( editor, definition.getContents( element[ 'for' ][ 0 ] ).get( element[ 'for' ][ 1 ] ), element.filebrowser );
 				}
 			}
 		}
 	}
 	function updateTargetElement( url, sourceElement )
 	{
 		var dialog = sourceElement.getDialog();
 		var targetElement = sourceElement.filebrowser.target || null;
 		if ( targetElement )
 		{
 			var target = targetElement.split( ':' );
 			var element = dialog.getContentElement( target[ 0 ], target[ 1 ] );
 			if ( element )
 			{
 				element.setValue( url );
 				dialog.selectPage( target[ 0 ] );
 			}
 		}
 	}
 	function isConfigured( definition, tabId, elementId )
 	{
 		if ( elementId.indexOf( ";" ) !== -1 )
 		{
 			var ids = elementId.split( ";" );
 			for ( var i = 0 ; i < ids.length ; i++ )
 			{
 				if ( isConfigured( definition, tabId, ids[i] ) )
 					return true;
 			}
 			return false;
 		}
 		var elementFileBrowser = definition.getContents( tabId ).get( elementId ).filebrowser;
 		return ( elementFileBrowser && elementFileBrowser.url );
 	}
 	function setUrl( fileUrl, data )
 	{
 		var dialog = this._.filebrowserSe.getDialog(),
 			targetInput = this._.filebrowserSe[ 'for' ],
 			onSelect = this._.filebrowserSe.filebrowser.onSelect;
 		if ( targetInput )
 			dialog.getContentElement( targetInput[ 0 ], targetInput[ 1 ] ).reset();
 		if ( typeof data == 'function' && data.call( this._.filebrowserSe ) === false )
 			return;
 		if ( onSelect && onSelect.call( this._.filebrowserSe, fileUrl, data ) === false )
 			return;
 		if ( typeof data == 'string' && data )
 			alert( data );
 		if ( fileUrl )
 			updateTargetElement( fileUrl, this._.filebrowserSe );
 	}
 	CKEDITOR.plugins.add( 'filebrowser',
 	{
 		init : function( editor, pluginPath )
 		{
 			editor._.filebrowserFn = CKEDITOR.tools.addFunction( setUrl, editor );
 			editor.on( 'destroy', function () { CKEDITOR.tools.removeFunction( this._.filebrowserFn ); } );
 		}
 	} );
 	CKEDITOR.on( 'dialogDefinition', function( evt )
 	{
 		var definition = evt.data.definition,
 			element;
 		for ( var i in definition.contents )
 		{
 			if ( ( element = definition.contents[ i ] ) )
 			{
 				attachFileBrowser( evt.editor, evt.data.name, definition, element.elements );
 				if ( element.hidden && element.filebrowser )
 				{
 					element.hidden = !isConfigured( definition, element[ 'id' ], element.filebrowser );
 				}
 			}
 		}
 	} );
 } )();
