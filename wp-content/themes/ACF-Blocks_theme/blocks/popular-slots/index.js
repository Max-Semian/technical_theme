(function() {
    'use strict';

    // Проверяем доступность WordPress API
    if (typeof wp === 'undefined' || !wp.blocks || !wp.blocks.registerBlockType) {
        console.error('WordPress blocks API not available');
        return;
    }

    var __ = wp.i18n.__;
    var registerBlockType = wp.blocks.registerBlockType;
    var createElement = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var useState = wp.element.useState;
    var useEffect = wp.element.useEffect;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var useBlockProps = wp.blockEditor.useBlockProps;
    var PanelBody = wp.components.PanelBody;
    var TextControl = wp.components.TextControl;
    var Button = wp.components.Button;
    var MediaUpload = wp.blockEditor.MediaUpload;
    var MediaUploadCheck = wp.blockEditor.MediaUploadCheck;

    console.log('Popular Slots Block: Starting registration');

    registerBlockType('acf-blocks-theme/popular-slots', {
            edit: function(props) {
                var attributes = props.attributes;
                var setAttributes = props.setAttributes;
                var clientId = props.clientId;

                // Initialize slots if empty - используем немедленную инициализацию
                if (!attributes.slots || !Array.isArray(attributes.slots) || attributes.slots.length === 0) {
                    var defaultSlots = [
                        {
                            title: 'Slot Game 1',
                            image: '',
                            imageId: 0,
                            demoUrl: '#',
                            playUrl: '#'
                        },
                        {
                            title: 'Slot Game 2',
                            image: '',
                            imageId: 0,
                            demoUrl: '#',
                            playUrl: '#'
                        },
                        {
                            title: 'Slot Game 3',
                            image: '',
                            imageId: 0,
                            demoUrl: '#',
                            playUrl: '#'
                        },
                        {
                            title: 'Slot Game 4',
                            image: '',
                            imageId: 0,
                            demoUrl: '#',
                            playUrl: '#'
                        },
                        {
                            title: 'Slot Game 5',
                            image: '',
                            imageId: 0,
                            demoUrl: '#',
                            playUrl: '#'
                        },
                        {
                            title: 'Slot Game 6',
                            image: '',
                            imageId: 0,
                            demoUrl: '#',
                            playUrl: '#'
                        },
                        {
                            title: 'Slot Game 7',
                            image: '',
                            imageId: 0,
                            demoUrl: '#',
                            playUrl: '#'
                        },
                        {
                            title: 'Slot Game 8',
                            image: '',
                            imageId: 0,
                            demoUrl: '#',
                            playUrl: '#'
                        }
                    ];
                    
                    // Асинхронно устанавливаем атрибуты
                    setTimeout(function() {
                        setAttributes({ 
                            slots: defaultSlots,
                            blockTitle: attributes.blockTitle || 'Популярные слоты'
                        });
                    }, 0);
                    
                    // Возвращаем временную заглушку
                    return createElement('div', { 
                        style: { 
                            padding: '20px', 
                            backgroundColor: '#f0f0f0', 
                            border: '1px solid #ccc',
                            textAlign: 'center'
                        } 
                    }, 'Загрузка блока "Популярные слоты"...');
                }

                // Используем текущие слоты из атрибутов
                var currentSlots = attributes.slots;

                // Обновляем URL изображений для слотов, у которых есть imageId но нет image
                if (currentSlots && currentSlots.length > 0) {
                    var needsUpdate = false;
                    var updatedSlots = [];
                    
                    for (var i = 0; i < currentSlots.length; i++) {
                        var slot = currentSlots[i];
                        if (slot.imageId && slot.imageId !== 0 && !slot.image) {
                            // Попробуем получить URL через REST API WordPress
                            if (typeof wp !== 'undefined' && wp.media && wp.media.model && wp.media.model.Attachment) {
                                var attachment = new wp.media.model.Attachment({ id: slot.imageId });
                                attachment.fetch().then(function(response) {
                                    console.log('Fetched image URL for ID ' + slot.imageId + ':', response.source_url);
                                });
                            }
                            
                            // Временно создаем URL используя attachment ID
                            var tempUrl = '/wp-content/uploads/' + slot.imageId + '.jpg'; // placeholder
                            needsUpdate = true;
                            updatedSlots.push({ ...slot, image: tempUrl });
                        } else {
                            updatedSlots.push(slot);
                        }
                    }

                    if (needsUpdate) {
                        console.log('Updating slots with image URLs');
                        setAttributes({ slots: updatedSlots });
                        currentSlots = updatedSlots;
                    }
                }

                console.log('Popular slots block rendered with', currentSlots.length, 'slots:');
                for (var i = 0; i < currentSlots.length; i++) {
                    var slot = currentSlots[i];
                    console.log('Slot ' + (i + 1) + ':', {
                        title: slot.title,
                        image: slot.image,
                        imageId: slot.imageId,
                        hasImage: !!slot.image
                    });
                }

                var blockProps = useBlockProps ? useBlockProps({
                    className: 'popular-slots-block',
                    style: {
                        '--popular-slots-bg-color': attributes.backgroundColor
                    }
                }) : {
                    className: 'popular-slots-block',
                    style: {
                        '--popular-slots-bg-color': attributes.backgroundColor
                    }
                };

                // Function to add new slot
                var addNewSlot = function() {
                    var newSlots = [...currentSlots, {
                        title: 'Новый слот',
                        image: '',
                        imageId: 0,
                        demoUrl: '#',
                        playUrl: '#'
                    }];
                    setAttributes({ slots: newSlots });
                };

                // Function to remove slot
                var removeSlot = function(index) {
                    if (currentSlots.length > 1) {
                        var newSlots = currentSlots.filter(function(_, i) {
                            return i !== index;
                        });
                        setAttributes({ slots: newSlots });
                    }
                };

                // Function to update slot
                var updateSlot = function(index, field, value) {
                    console.log('updateSlot called:', { index: index, field: field, value: value });
                    var newSlots = [...currentSlots];
                    newSlots[index] = { ...newSlots[index], [field]: value };
                    console.log('Setting new slots:', newSlots);
                    setAttributes({ slots: newSlots });
                };

                return createElement(Fragment, null, [
                    createElement(InspectorControls, { key: 'inspector' }, [
                        createElement(PanelBody, {
                            key: 'general-settings',
                            title: __('Общие настройки', 'acf-blocks-theme'),
                            initialOpen: true
                        }, [
                            createElement(TextControl, {
                                key: 'block-title',
                                label: __('Заголовок блока', 'acf-blocks-theme'),
                                value: attributes.blockTitle,
                                onChange: function(value) {
                                    setAttributes({ blockTitle: value });
                                }
                            }),
                            createElement('div', {
                                key: 'add-slot-section',
                                style: { marginTop: '20px' }
                            }, [
                                createElement('p', {
                                    key: 'slots-count',
                                    style: { fontWeight: 'bold', marginBottom: '10px' }
                                }, __('Слотов: ', 'acf-blocks-theme') + currentSlots.length),
                                createElement(Button, {
                                    key: 'add-slot',
                                    isPrimary: true,
                                    onClick: addNewSlot
                                }, __('Добавить слот', 'acf-blocks-theme')),
                                currentSlots.length > 0 ? createElement(Button, {
                                    key: 'remove-slot',
                                    isDestructive: true,
                                    style: { marginLeft: '10px' },
                                    onClick: function() { removeSlot(currentSlots.length - 1); }
                                }, __('Удалить последний', 'acf-blocks-theme')) : null
                            ])
                        ]),

                        // Slots configuration panels
                        currentSlots.map(function(slot, index) {
                            return createElement(PanelBody, {
                                key: 'slot-' + index,
                                title: __('Слот ', 'acf-blocks-theme') + (index + 1) + ': ' + (slot.title || 'Без названия'),
                                initialOpen: false
                            }, [
                                createElement(TextControl, {
                                    key: 'title-' + index,
                                    label: __('Название слота', 'acf-blocks-theme'),
                                    value: slot.title,
                                    onChange: (function(currentIndex) {
                                        return function(value) {
                                            updateSlot(currentIndex, 'title', value);
                                        };
                                    })(index)
                                }),

                                createElement(TextControl, {
                                    key: 'demo-url-' + index,
                                    label: __('Ссылка на демо', 'acf-blocks-theme'),
                                    value: slot.demoUrl,
                                    onChange: (function(currentIndex) {
                                        return function(value) {
                                            updateSlot(currentIndex, 'demoUrl', value);
                                        };
                                    })(index)
                                }),

                                createElement(TextControl, {
                                    key: 'play-url-' + index,
                                    label: __('Ссылка на игру', 'acf-blocks-theme'),
                                    value: slot.playUrl,
                                    onChange: (function(currentIndex) {
                                        return function(value) {
                                            updateSlot(currentIndex, 'playUrl', value);
                                        };
                                    })(index)
                                }),

                                createElement('div', {
                                    key: 'image-wrapper-' + index,
                                    style: { marginBottom: '15px' }
                                }, [
                                    createElement('p', {
                                        key: 'image-label-' + index,
                                        style: { margin: '0 0 8px 0', fontWeight: 'bold' }
                                    }, __('Изображение слота', 'acf-blocks-theme')),
                                    
                                    slot.image ? 
                                        createElement('div', {
                                            key: 'image-preview-' + index,
                                            style: { marginBottom: '10px' }
                                        }, [
                                            createElement('img', {
                                                key: 'img-' + index,
                                                src: slot.image,
                                                style: {
                                                    width: '100%',
                                                    maxWidth: '200px',
                                                    height: 'auto',
                                                    borderRadius: '4px'
                                                }
                                            }),
                                            createElement(Button, {
                                                key: 'remove-img-' + index,
                                                isDestructive: true,
                                                isSmall: true,
                                                onClick: (function(currentIndex) {
                                                    return function() {
                                                        console.log('Removing image for slot:', currentIndex);
                                                        // Удаляем оба поля одновременно
                                                        var newSlots = [...currentSlots];
                                                        newSlots[currentIndex] = { 
                                                            ...newSlots[currentIndex], 
                                                            image: '',
                                                            imageId: 0
                                                        };
                                                        setAttributes({ slots: newSlots });
                                                    };
                                                })(index),
                                                style: { marginTop: '8px' }
                                            }, __('Удалить изображение', 'acf-blocks-theme'))
                                        ]) : null,

                                    createElement(MediaUploadCheck, { key: 'media-check-' + index }, [
                                        createElement(MediaUpload, {
                                            key: 'media-upload-' + index,
                                            onSelect: (function(currentIndex) {
                                                return function(media) {
                                                    console.log('Media selected for slot:', media, 'index:', currentIndex);
                                                    // Обновляем оба поля одновременно
                                                    var newSlots = [...currentSlots];
                                                    newSlots[currentIndex] = { 
                                                        ...newSlots[currentIndex], 
                                                        image: media.url,
                                                        imageId: media.id
                                                    };
                                                    console.log('Setting new slots with image:', newSlots);
                                                    setAttributes({ slots: newSlots });
                                                };
                                            })(index),
                                            allowedTypes: ['image'],
                                            value: slot.imageId,
                                            render: function(obj) {
                                                return createElement(Button, {
                                                    onClick: obj.open,
                                                    isPrimary: !slot.image,
                                                    isSecondary: !!slot.image
                                                }, slot.image ? __('Изменить изображение', 'acf-blocks-theme') : __('Выбрать изображение', 'acf-blocks-theme'));
                                            }
                                        })
                                    ])
                                ])
                            ]);
                        })
                    ]),

                    // Block preview in editor
                    createElement('div', blockProps, [
                        createElement('div', {
                            key: 'container',
                            className: 'popular-slots-container'
                        }, [
                            createElement('h2', {
                                key: 'title',
                                className: 'popular-slots-title'
                            }, attributes.blockTitle || 'Популярные слоты'),

                            createElement('div', {
                                key: 'grid',
                                className: 'popular-slots-grid'
                            }, currentSlots.map(function(slot, index) {
                                return createElement('div', {
                                    key: 'slot-preview-' + index,
                                    className: 'popular-slot-item'
                                }, [
                                    // Контейнер для изображения
                                    createElement('div', {
                                        key: 'image-container-' + index,
                                        className: 'popular-slot-image'
                                    }, [
                                        slot.image ? (function() {
                                            console.log('Rendering slot image:', slot.image, 'for slot:', slot.title);
                                            return createElement('img', {
                                                key: 'img-' + index,
                                                src: slot.image,
                                                alt: slot.title || 'Slot ' + (index + 1),
                                                className: 'slot-image',
                                                onLoad: function() {
                                                    console.log('Image loaded successfully:', slot.image);
                                                },
                                                onError: function() {
                                                    console.error('Failed to load image:', slot.image);
                                                }
                                            });
                                        })() : createElement('div', {
                                            key: 'placeholder-' + index,
                                            className: 'slot-image-placeholder'
                                        }, [
                                            createElement('span', { key: 'icon-' + index }, '🎰'),
                                            createElement('small', {
                                                key: 'text-' + index
                                            }, 'Нет изображения')
                                        ])
                                    ]),

                                    // Контент карточки
                                    createElement('div', {
                                        key: 'content-' + index,
                                        className: 'popular-slot-content'
                                    }, [
                                        createElement('h3', {
                                            key: 'title-' + index,
                                            className: 'popular-slot-title'
                                        }, slot.title || 'Slot ' + (index + 1)),

                                        createElement('div', {
                                            key: 'buttons-' + index,
                                            className: 'popular-slot-buttons'
                                        }, [
                                            createElement('a', {
                                                key: 'demo-btn-' + index,
                                                className: 'slot-btn slot-btn-demo',
                                                href: slot.demoUrl || '#'
                                            }, 'Демо'),
                                            createElement('a', {
                                                key: 'play-btn-' + index,
                                                className: 'slot-btn slot-btn-play',
                                                href: slot.playUrl || '#'
                                            }, 'Играть')
                                        ])
                                    ])
                                ]);
                            }))
                        ])
                    ])
                ]);
            },

            save: function() {
                return null;
            }
        });

    console.log('Popular Slots Block: Registration completed');
})();