function addCoverAttribute(settings, name) {
  if (typeof settings.attributes !== 'undefined') {
    if (name == 'core/image') {
      settings.attributes = Object.assign(settings.attributes, {
        saCustomWidth: {
          type: 'string'
        },
        saCustomHeight: {
          type: 'string'
        }
      });
    }
  }
  return settings;
}
wp.hooks.addFilter('blocks.registerBlockType', 'awp/cover-custom-attribute', addCoverAttribute);
var coverAdvancedControls = wp.compose.createHigherOrderComponent(function (BlockEdit) {
  return function (props) {
    var Fragment = wp.element.Fragment;
    var TextControl = wp.components.TextControl;
    var InspectorAdvancedControls = wp.blockEditor.InspectorAdvancedControls;
    var attributes = props.attributes,
      setAttributes = props.setAttributes,
      isSelected = props.isSelected;
    return /*#__PURE__*/React.createElement(Fragment, null, /*#__PURE__*/React.createElement(BlockEdit, props), isSelected && props.name == 'core/image' && /*#__PURE__*/React.createElement(InspectorAdvancedControls, null, /*#__PURE__*/React.createElement(TextControl, {
      label: wp.i18n.__('Ширина (px)', 'awp'),
      value: attributes.saCustomWidth,
      onChange: function onChange(value) {
        return setAttributes({
          saCustomWidth: value
        });
      }
    }), /*#__PURE__*/React.createElement(TextControl, {
      label: wp.i18n.__('Высота (px)', 'awp'),
      value: attributes.saCustomHeight,
      onChange: function onChange(value) {
        return setAttributes({
          saCustomHeight: value
        });
      }
    })));
  };
}, 'coverAdvancedControls');
wp.hooks.addFilter('editor.BlockEdit', 'awp/cover-advanced-control', coverAdvancedControls);



function coverApplyExtraClass(extraProps, blockType, attributes) {
  var saCustomHeight = attributes.saCustomHeight,
    saCustomWidth = attributes.saCustomWidth;
  if (typeof saCustomHeight !== 'undefined' && saCustomHeight) {
    extraProps['data-height'] = saCustomHeight;
  }
  if (typeof saCustomWidth !== 'undefined' && saCustomWidth) {
    extraProps['data-width'] = saCustomWidth;
  }
  return extraProps;
}
wp.hooks.addFilter('blocks.getSaveContent.extraProps', 'awp/cover-apply-class', coverApplyExtraClass);