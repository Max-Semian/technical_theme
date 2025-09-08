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

        registerBlockType('acf-blocks-theme/recommended-pages', {
            edit: function(props) {
                var attributes = props.attributes;
                var setAttributes = props.setAttributes;
                var clientId = props.clientId;
                
                // Ensure recommendedPages array exists
                if (!attributes.recommendedPages || !Array.isArray(attributes.recommendedPages)) {
                    setAttributes({ 
                        recommendedPages: [
                            {
                                title: 'Sports Betting',
                                backgroundImage: '',
                                imageId: 0,
                                url: '#',
                                gradientOverlay: 'linear-gradient(135deg, rgba(62, 242, 209, 0.8) 0%, rgba(49, 16, 103, 0.8) 100%)'
                            }
                        ]
                    });
                    return createElement('div', null, 'Загрузка...');
                }
                
                var blockProps = useBlockProps ? useBlockProps({
                    className: 'recommended-pages-block',
                    style: {
                        '--recommended-pages-bg-color': attributes.backgroundColor
                    }
                }) : {
                    className: 'recommended-pages-block',
                    style: {
                        '--recommended-pages-bg-color': attributes.backgroundColor
                    }
                };

                // Function to add new page
                var addNewPage = function() {
                    var newPages = [...attributes.recommendedPages, {
                        title: 'Новая страница',
                        backgroundImage: '',
                        imageId: 0,
                        url: '#',
                        gradientOverlay: 'linear-gradient(135deg, rgba(62, 242, 209, 0.8) 0%, rgba(49, 16, 103, 0.8) 100%)'
                    }];
                    setAttributes({ recommendedPages: newPages });
                };

                // Function to remove page
                var removePage = function(index) {
                    if (attributes.recommendedPages.length > 1) {
                        var newPages = attributes.recommendedPages.filter(function(_, i) {
                            return i !== index;
                        });
                        setAttributes({ recommendedPages: newPages });
                    }
                };

                // Function to update page
                var updatePage = function(index, field, value) {
                    console.log('updatePage called:', { index: index, field: field, value: value });
                    var newPages = [...attributes.recommendedPages];
                    newPages[index] = { ...newPages[index], [field]: value };
                    console.log('Setting new pages:', newPages);
                    setAttributes({ recommendedPages: newPages });
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
                                key: 'bg-color-wrapper',
                                style: { marginBottom: '20px' }
                            }, [
                                createElement('p', { 
                                    key: 'bg-label',
                                    style: { margin: '0 0 8px 0', fontWeight: 'bold' }
                                }, __('Цвет фона', 'acf-blocks-theme')),
                                createElement(ColorPicker, {
                                    key: 'bg-color',
                                    color: attributes.backgroundColor,
                                    onChangeComplete: function(color) {
                                        setAttributes({ backgroundColor: color.hex });
                                    }
                                })
                            ])
                        ]),
                        createElement(PanelBody, {
                            key: 'pages-settings',
                            title: __('Настройки страниц', 'acf-blocks-theme'),
                            initialOpen: false
                        }, [
                            createElement(Button, {
                                key: 'add-page',
                                isPrimary: true,
                                onClick: addNewPage,
                                style: { marginBottom: '20px' }
                            }, __('+ Добавить страницу', 'acf-blocks-theme')),
                            
                            ...attributes.recommendedPages.map(function(page, index) {
                                return createElement('div', {
                                    key: 'page-' + index,
                                    style: {
                                        border: '1px solid #ddd',
                                        borderRadius: '4px',
                                        padding: '15px',
                                        marginBottom: '15px',
                                        backgroundColor: '#f9f9f9'
                                    }
                                }, [
                                    createElement('h4', {
                                        key: 'page-title-' + index,
                                        style: { margin: '0 0 10px 0' }
                                    }, __('Страница ' + (index + 1), 'acf-blocks-theme')),
                                    
                                    createElement(TextControl, {
                                        key: 'title-' + index,
                                        label: __('Заголовок', 'acf-blocks-theme'),
                                        value: page.title,
                                        onChange: (function(currentIndex) {
                                            return function(value) {
                                                updatePage(currentIndex, 'title', value);
                                            };
                                        })(index)
                                    }),

                                    createElement(TextControl, {
                                        key: 'url-' + index,
                                        label: __('URL ссылки', 'acf-blocks-theme'),
                                        value: page.url,
                                        onChange: (function(currentIndex) {
                                            return function(value) {
                                                updatePage(currentIndex, 'url', value);
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
                                        }, __('Фоновое изображение', 'acf-blocks-theme')),
                                        
                                        page.backgroundImage ? 
                                            createElement('div', {
                                                key: 'image-preview-' + index,
                                                style: { marginBottom: '10px' }
                                            }, [
                                                createElement('img', {
                                                    key: 'img-' + index,
                                                    src: page.backgroundImage,
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
                                                            console.log('Removing image for index:', currentIndex);
                                                            updatePage(currentIndex, 'backgroundImage', '');
                                                            updatePage(currentIndex, 'imageId', 0);
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
                                                        console.log('Media selected:', media.url, 'for index:', currentIndex);
                                                        updatePage(currentIndex, 'backgroundImage', media.url);
                                                        updatePage(currentIndex, 'imageId', media.id);
                                                    };
                                                })(index),
                                                allowedTypes: ['image'],
                                                value: page.imageId,
                                                render: function(obj) {
                                                    return createElement(Button, {
                                                        onClick: obj.open,
                                                        isPrimary: !page.backgroundImage,
                                                        isSecondary: !!page.backgroundImage
                                                    }, page.backgroundImage ? __('Изменить изображение', 'acf-blocks-theme') : __('Выбрать изображение', 'acf-blocks-theme'));
                                                }
                                            })
                                        ])
                                    ]),

                                    createElement(TextControl, {
                                        key: 'gradient-' + index,
                                        label: __('Градиентный оверлей (CSS)', 'acf-blocks-theme'),
                                        value: page.gradientOverlay,
                                        onChange: (function(currentIndex) {
                                            return function(value) {
                                                updatePage(currentIndex, 'gradientOverlay', value);
                                            };
                                        })(index),
                                        help: __('Пример: linear-gradient(135deg, rgba(62, 242, 209, 0.8) 0%, rgba(49, 16, 103, 0.8) 100%)', 'acf-blocks-theme')
                                    }),

                                    attributes.recommendedPages.length > 1 ? 
                                        createElement(Button, {
                                            key: 'remove-page-' + index,
                                            isDestructive: true,
                                            isSmall: true,
                                            onClick: (function(currentIndex) {
                                                return function() { 
                                                    removePage(currentIndex); 
                                                };
                                            })(index),
                                            style: { marginTop: '10px' }
                                        }, __('Удалить страницу', 'acf-blocks-theme')) : null
                                ]);
                            })
                        ])
                    ]),

                    createElement('div', blockProps, [
                        createElement('div', {
                            key: 'container',
                            className: 'recommended-pages-container'
                        }, [
                            attributes.blockTitle ? 
                                createElement('h2', {
                                    key: 'title',
                                    className: 'recommended-pages-title'
                                }, attributes.blockTitle) : null,

                            createElement('div', {
                                key: 'grid',
                                className: 'recommended-pages-grid'
                            }, attributes.recommendedPages.map(function(page, index) {
                                return createElement('div', {
                                    key: 'page-preview-' + index,
                                    className: 'recommended-page-item editor-preview',
                                    style: {
                                        backgroundImage: page.backgroundImage ? 'url(' + page.backgroundImage + ')' : 'none'
                                    }
                                }, [
                                    createElement('div', {
                                        key: 'overlay-' + index,
                                        className: 'recommended-page-overlay',
                                        style: {
                                            background: page.gradientOverlay
                                        }
                                    }),
                                    createElement('div', {
                                        key: 'content-' + index,
                                        className: 'recommended-page-content'
                                    }, [
                                        createElement('h3', {
                                            key: 'page-title-' + index,
                                            className: 'recommended-page-title'
                                        }, page.title)
                                    ]),
                                    !page.backgroundImage ? 
                                        createElement('div', {
                                            key: 'placeholder-' + index,
                                            className: 'recommended-page-placeholder'
                                        }, '🎯') : null
                                ]);
                            }))
                        ])
                    ])
                ]);
            },

            save: function() {
                return null; // Server-side rendered block
            }
        });
    }
})();
