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

        registerBlockType('acf-blocks-theme/bonus-cards', {
            edit: function(props) {
                var attributes = props.attributes;
                var setAttributes = props.setAttributes;
                var clientId = props.clientId;
                
                // Ensure bonuses array exists
                if (!attributes.bonuses || !Array.isArray(attributes.bonuses)) {
                    setAttributes({ 
                        bonuses: [
                            {
                                imageUrl: '',
                                imageId: 0,
                                title: 'Приветственный бонус',
                                status: 'Casino',
                                url: '#'
                            }
                        ]
                    });
                    return createElement('div', null, 'Загрузка...');
                }
                
                var blockProps = useBlockProps ? useBlockProps({
                    className: 'bonus-cards-block',
                    style: {
                        '--bonus-cards-bg-color': attributes.backgroundColor
                    }
                }) : {
                    className: 'bonus-cards-block',
                    style: {
                        '--bonus-cards-bg-color': attributes.backgroundColor
                    }
                };

                function addBonusCard() {
                    var newBonus = {
                        imageUrl: '',
                        imageId: 0,
                        title: 'Новый бонус ' + (attributes.bonuses.length + 1),
                        status: 'Casino',
                        url: '#'
                    };
                    var newBonuses = [...attributes.bonuses, newBonus];
                    setAttributes({ bonuses: newBonuses });
                }

                function removeBonusCard(index) {
                    var newBonuses = attributes.bonuses.filter(function(bonus, i) {
                        return i !== index;
                    });
                    setAttributes({ bonuses: newBonuses });
                }

                function updateBonusCard(index, field, value) {
                    var newBonuses = attributes.bonuses.map(function(bonus, i) {
                        if (i === index) {
                            var updatedBonus = { ...bonus, [field]: value };
                            return updatedBonus;
                        }
                        return bonus;
                    });
                    setAttributes({ bonuses: newBonuses });
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
                                value: attributes.blockTitle || 'Наши бонусы',
                                onChange: function(value) {
                                    setAttributes({ blockTitle: value });
                                },
                                style: { marginTop: '20px' }
                            })
                        ]),
                        
                        createElement(PanelBody, {
                            key: 'bonuses-panel',
                            title: __('Бонусные карточки', 'acf-blocks-theme'),
                            initialOpen: true
                        }, [
                            createElement(Button, {
                                key: 'add-bonus-button',
                                isPrimary: true,
                                onClick: addBonusCard,
                                style: { marginBottom: '20px' }
                            }, __('+ Добавить бонус', 'acf-blocks-theme')),
                            
                            // Render bonus controls
                        ].concat(
                            attributes.bonuses.map(function(bonus, index) {
                                return createElement('div', {
                                    key: 'bonus-' + index,
                                    style: { 
                                        border: '1px solid #ddd', 
                                        padding: '15px', 
                                        marginBottom: '15px',
                                        borderRadius: '4px'
                                    }
                                }, [
                                    createElement('h4', {
                                        key: 'bonus-title-' + index,
                                        style: { marginTop: '0', marginBottom: '15px' }
                                    }, __('Бонус ', 'acf-blocks-theme') + (index + 1)),
                                    
                                    createElement(TextControl, {
                                        key: 'bonus-name-' + index,
                                        label: __('Название бонуса', 'acf-blocks-theme'),
                                        value: bonus.title,
                                        onChange: function(value) {
                                            updateBonusCard(index, 'title', value);
                                        }
                                    }),
                                    
                                    createElement(TextControl, {
                                        key: 'bonus-status-' + index,
                                        label: __('Статус/Лейбл', 'acf-blocks-theme'),
                                        value: bonus.status,
                                        onChange: function(value) {
                                            updateBonusCard(index, 'status', value);
                                        }
                                    }),
                                    
                                    createElement(TextControl, {
                                        key: 'bonus-url-' + index,
                                        label: __('Ссылка', 'acf-blocks-theme'),
                                        value: bonus.url,
                                        onChange: function(value) {
                                            updateBonusCard(index, 'url', value);
                                        }
                                    }),
                                    
                                    createElement(MediaUploadCheck, {
                                        key: 'media-check-' + index
                                    }, [
                                        createElement(MediaUpload, {
                                            key: 'media-upload-' + index,
                                            onSelect: function(media) {
                                                if (media && media.url) {
                                                    var newBonuses = attributes.bonuses.map(function(bonus, i) {
                                                        if (i === index) {
                                                            return { 
                                                                ...bonus, 
                                                                imageUrl: media.url,
                                                                imageId: media.id
                                                            };
                                                        }
                                                        return bonus;
                                                    });
                                                    setAttributes({ bonuses: newBonuses });
                                                }
                                            },
                                            allowedTypes: ['image'],
                                            value: bonus.imageId,
                                            render: function(obj) {
                                                return createElement(Button, {
                                                    onClick: obj.open,
                                                    isSecondary: true,
                                                    style: { marginRight: '10px' }
                                                }, bonus.imageUrl ? __('Изменить изображение', 'acf-blocks-theme') : __('Выбрать изображение', 'acf-blocks-theme'));
                                            }
                                        })
                                    ]),
                                    
                                    bonus.imageUrl && createElement('div', {
                                        key: 'image-preview-' + index,
                                        style: { marginTop: '10px', marginBottom: '10px' }
                                    }, [
                                        createElement('img', {
                                            key: 'preview-img-' + index,
                                            src: bonus.imageUrl,
                                            style: { maxWidth: '100px', height: 'auto' }
                                        }),
                                        createElement(Button, {
                                            key: 'remove-image-' + index,
                                            isDestructive: true,
                                            onClick: function() {
                                                updateBonusCard(index, 'imageUrl', '');
                                                updateBonusCard(index, 'imageId', 0);
                                            },
                                            style: { marginLeft: '10px' }
                                        }, __('Удалить изображение', 'acf-blocks-theme'))
                                    ]),
                                    
                                    createElement(Button, {
                                        key: 'remove-bonus-' + index,
                                        isDestructive: true,
                                        onClick: function() {
                                            removeBonusCard(index);
                                        },
                                        style: { marginTop: '15px' }
                                    }, __('Удалить бонус', 'acf-blocks-theme'))
                                ]);
                            })
                        ))
                    ]),
                    
                    // Block Preview
                    createElement('div', blockProps, [
                        createElement('div', {
                            key: 'container',
                            className: 'bonus-cards-container'
                        }, [
                            attributes.blockTitle && createElement('h2', {
                                key: 'title',
                                className: 'bonus-cards-title'
                            }, attributes.blockTitle),
                            
                            createElement('div', {
                                key: 'grid',
                                className: 'bonus-cards-grid'
                            }, attributes.bonuses.map(function(bonus, index) {
                                return createElement('div', {
                                    key: 'bonus-card-' + index,
                                    className: 'bonus-card-item editor-preview'
                                }, [
                                    createElement('div', {
                                        key: 'image-container-' + index,
                                        className: 'bonus-card-image-container'
                                    }, [
                                        bonus.imageUrl ? 
                                            createElement('img', {
                                                key: 'image-' + index,
                                                src: bonus.imageUrl,
                                                alt: bonus.title,
                                                className: 'bonus-card-image'
                                            }) :
                                            createElement('div', {
                                                key: 'placeholder-' + index,
                                                className: 'bonus-card-image-placeholder'
                                            }, createElement('span', null, '🎁')),
                                        
                                        bonus.status && createElement('span', {
                                            key: 'status-' + index,
                                            className: 'bonus-card-status'
                                        }, bonus.status)
                                    ]),
                                    
                                    createElement('div', {
                                        key: 'content-' + index,
                                        className: 'bonus-card-content'
                                    }, [
                                        createElement('h3', {
                                            key: 'title-' + index,
                                            className: 'bonus-card-title'
                                        }, bonus.title || 'Бонус без названия')
                                    ])
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
