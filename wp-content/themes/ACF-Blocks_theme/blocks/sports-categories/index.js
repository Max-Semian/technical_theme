(function() {
    'use strict';

    var __ = wp.i18n.__;
    var registerBlockType = wp.blocks.registerBlockType;
    var createElement = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var InspectorControls = wp.blockEditor.InspectorControls;
    
    // Import necessary components
    if (typeof wp !== 'undefined' && wp.blockEditor && wp.blockEditor.useBlockProps) {
        var useBlockProps = wp.blockEditor.useBlockProps;
        var PanelBody = wp.components.PanelBody;
        var TextControl = wp.components.TextControl;
        var Button = wp.components.Button;
        var ColorPicker = wp.components.ColorPicker;
        var MediaUpload = wp.blockEditor.MediaUpload;
        var MediaUploadCheck = wp.blockEditor.MediaUploadCheck;

        registerBlockType('acf-blocks-theme/sports-categories', {
            edit: function(props) {
                var attributes = props.attributes;
                var setAttributes = props.setAttributes;
                var clientId = props.clientId;
                
                // Ensure sports categories array exists
                if (!attributes.sportsCategories || !Array.isArray(attributes.sportsCategories)) {
                    setAttributes({ 
                        sportsCategories: [
                            {
                                iconUrl: '',
                                iconId: 0,
                                name: 'Футбол',
                                url: '#'
                            }
                        ]
                    });
                    return createElement('div', null, 'Загрузка...');
                }
                
                var blockProps = useBlockProps ? useBlockProps({
                    className: 'sports-categories-block',
                    style: {
                        '--sports-categories-bg-color': attributes.backgroundColor
                    }
                }) : {
                    className: 'sports-categories-block',
                    style: {
                        '--sports-categories-bg-color': attributes.backgroundColor
                    }
                };

                function addSportCategory() {
                    var newSport = {
                        iconUrl: '',
                        iconId: 0,
                        name: 'Новый спорт ' + (attributes.sportsCategories.length + 1),
                        url: '#'
                    };
                    var newSports = [...attributes.sportsCategories, newSport];
                    setAttributes({ sportsCategories: newSports });
                }

                function removeSportCategory(index) {
                    var newSports = attributes.sportsCategories.filter(function(sport, i) {
                        return i !== index;
                    });
                    setAttributes({ sportsCategories: newSports });
                }

                function updateSportCategory(index, field, value) {
                    var newSports = attributes.sportsCategories.map(function(sport, i) {
                        if (i === index) {
                            var updatedSport = { ...sport, [field]: value };
                            return updatedSport;
                        }
                        return sport;
                    });
                    setAttributes({ sportsCategories: newSports });
                }

                return createElement(Fragment, null, [
                    // Inspector Controls (Sidebar)
                    createElement(InspectorControls, { key: 'inspector' }, [
                        createElement(PanelBody, {
                            key: 'background-panel',
                            title: __('Настройки фона', 'acf-blocks-theme'),
                            initialOpen: true
                        }, [
                            createElement('div', {
                                key: 'bg-color-wrapper',
                                style: { marginBottom: '20px' }
                            }, [
                                createElement('label', {
                                    key: 'bg-color-label',
                                    style: { 
                                        display: 'block', 
                                        marginBottom: '8px', 
                                        fontWeight: '600' 
                                    }
                                }, __('Цвет фона', 'acf-blocks-theme')),
                                createElement(ColorPicker, {
                                    key: 'bg-color-picker',
                                    color: attributes.backgroundColor,
                                    onChangeComplete: function(color) {
                                        setAttributes({ backgroundColor: color.hex });
                                    }
                                })
                            ]),
                            
                            createElement(TextControl, {
                                key: 'block-title-control',
                                label: __('Заголовок блока', 'acf-blocks-theme'),
                                value: attributes.blockTitle || 'Все виды спорта',
                                onChange: function(value) {
                                    setAttributes({ blockTitle: value });
                                },
                                style: { marginTop: '20px' }
                            })
                        ]),
                        
                        createElement(PanelBody, {
                            key: 'sports-panel',
                            title: __('Категории спорта', 'acf-blocks-theme'),
                            initialOpen: true
                        }, [
                            createElement(Button, {
                                key: 'add-sport-button',
                                isPrimary: true,
                                onClick: addSportCategory,
                                style: { marginBottom: '20px' }
                            }, __('+ Добавить категорию', 'acf-blocks-theme')),
                            
                            // Render sport controls
                        ].concat(
                            attributes.sportsCategories.map(function(sport, index) {
                                return createElement('div', {
                                    key: 'sport-' + index,
                                    style: { 
                                        border: '1px solid #ddd', 
                                        padding: '15px', 
                                        marginBottom: '15px',
                                        borderRadius: '4px'
                                    }
                                }, [
                                    createElement('h4', {
                                        key: 'sport-title-' + index,
                                        style: { marginTop: '0', marginBottom: '15px' }
                                    }, __('Спорт ', 'acf-blocks-theme') + (index + 1)),
                                    
                                    createElement(TextControl, {
                                        key: 'sport-name-' + index,
                                        label: __('Название спорта', 'acf-blocks-theme'),
                                        value: sport.name,
                                        onChange: function(value) {
                                            updateSportCategory(index, 'name', value);
                                        }
                                    }),
                                    
                                    createElement(TextControl, {
                                        key: 'sport-url-' + index,
                                        label: __('Ссылка на категорию', 'acf-blocks-theme'),
                                        value: sport.url,
                                        onChange: function(value) {
                                            updateSportCategory(index, 'url', value);
                                        }
                                    }),
                                    
                                    createElement(MediaUploadCheck, {
                                        key: 'media-check-' + index
                                    }, [
                                        createElement(MediaUpload, {
                                            key: 'media-upload-' + index,
                                            onSelect: function(media) {
                                                if (media && media.url) {
                                                    var newSports = attributes.sportsCategories.map(function(sport, i) {
                                                        if (i === index) {
                                                            return { 
                                                                ...sport, 
                                                                iconUrl: media.url,
                                                                iconId: media.id
                                                            };
                                                        }
                                                        return sport;
                                                    });
                                                    setAttributes({ sportsCategories: newSports });
                                                }
                                            },
                                            allowedTypes: ['image'],
                                            value: sport.iconId,
                                            render: function(obj) {
                                                return createElement(Button, {
                                                    onClick: obj.open,
                                                    isSecondary: true,
                                                    style: { marginRight: '10px' }
                                                }, sport.iconUrl ? __('Изменить иконку', 'acf-blocks-theme') : __('Выбрать иконку', 'acf-blocks-theme'));
                                            }
                                        })
                                    ]),
                                    
                                    sport.iconUrl && createElement('div', {
                                        key: 'icon-preview-' + index,
                                        style: { marginTop: '10px', marginBottom: '10px' }
                                    }, [
                                        createElement('img', {
                                            key: 'preview-icon-' + index,
                                            src: sport.iconUrl,
                                            style: { maxWidth: '50px', height: 'auto' }
                                        }),
                                        createElement(Button, {
                                            key: 'remove-icon-' + index,
                                            isDestructive: true,
                                            onClick: function() {
                                                updateSportCategory(index, 'iconUrl', '');
                                                updateSportCategory(index, 'iconId', 0);
                                            },
                                            style: { marginLeft: '10px' }
                                        }, __('Удалить иконку', 'acf-blocks-theme'))
                                    ]),
                                    
                                    createElement(Button, {
                                        key: 'remove-sport-' + index,
                                        isDestructive: true,
                                        onClick: function() {
                                            removeSportCategory(index);
                                        },
                                        style: { marginTop: '15px' }
                                    }, __('Удалить категорию', 'acf-blocks-theme'))
                                ]);
                            })
                        ))
                    ]),
                    
                    // Block Preview
                    createElement('div', blockProps, [
                        createElement('div', {
                            key: 'container',
                            className: 'sports-categories-container'
                        }, [
                            attributes.blockTitle && createElement('h2', {
                                key: 'title',
                                className: 'sports-categories-title'
                            }, attributes.blockTitle),
                            
                            createElement('div', {
                                key: 'grid',
                                className: 'sports-categories-grid'
                            }, attributes.sportsCategories.map(function(sport, index) {
                                return createElement('div', {
                                    key: 'sport-category-' + index,
                                    className: 'sport-category-item editor-preview'
                                }, [
                                    createElement('div', {
                                        key: 'icon-container-' + index,
                                        className: 'sport-category-icon-container'
                                    }, [
                                        sport.iconUrl ? 
                                            createElement('img', {
                                                key: 'icon-' + index,
                                                src: sport.iconUrl,
                                                alt: sport.name,
                                                className: 'sport-category-icon'
                                            }) :
                                            createElement('div', {
                                                key: 'placeholder-' + index,
                                                className: 'sport-category-icon-placeholder'
                                            }, createElement('span', null, '⚽'))
                                    ]),
                                    
                                    createElement('span', {
                                        key: 'name-' + index,
                                        className: 'sport-category-name'
                                    }, sport.name || 'Спорт')
                                ]);
                            }))
                        ])
                    ])
                ]);
            },
            
            save: function() {
                // Возвращаем null, так как используем render.php
                return null;
            }
        });
    }
})();
