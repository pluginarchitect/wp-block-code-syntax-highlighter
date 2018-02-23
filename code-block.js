
/**
 * Code Block
 *
 * @TODO Add style/theme support.
 * @TODO Add language setting.
 */
( function( blocks, i18n, element, components ) {

  var el      = element.createElement;
  var RawHTML = element.RawHTML;

  var __ = i18n.__;

  var PlainText = blocks.PlainText;

  function highlight( code ){
    var highlightedCode = hljs.highlightAuto( code );
    return el( 'pre', { className: 'javascript hljs' },
      el( RawHTML, {}, highlightedCode.value )
    );
  }

	blocks.registerBlockType( 'code-block/code-block', {
		title: __( 'Code', 'code-block' ),
		icon: 'editor-code',
		category: 'common',

		attributes: {

      code: {
        type: 'string',
        default: '',
      },

		},

		edit: function( props ) {

      var focus = props.focus;

      var code = props.attributes.code;
      function onChangeCode( newCode ){
        props.setAttributes( { code: newCode } );
      }

      if( focus ){
        return el( PlainText, { value: props.attributes.code, onChange: onChangeCode } )
      }

      if( ! code ){
        return highlight( '<?php // ...' );
      }

      return highlight( code );
		},
		save: function( props ) {
      var code = props.attributes.code;
      return highlight( code );
		},

	} );
} )(
	window.wp.blocks,
	window.wp.i18n,
	window.wp.element,
	window.wp.components
);
