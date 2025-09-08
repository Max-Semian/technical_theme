(function(blocks, element, blockEditor) {
    var el = element.createElement;
    var InnerBlocks = blockEditor.InnerBlocks;

    blocks.registerBlockType('acf-blocks/simple-container', {
        title: 'Простой контейнер',
        icon: 'editor-table',
        category: 'layout',
        description: 'Простой контейнер для любых Gutenberg блоков',
        
        // Разрешаем вложенные блоки
        supports: {
            align: ['wide', 'full'],
            anchor: true
        },

        // Атрибуты блока
        attributes: {
            containerTitle: {
                type: 'string',
                default: ''
            },
            backgroundColor: {
                type: 'string',
                default: 'transparent'
            },
            padding: {
                type: 'string',
                default: 'medium'
            }
        },

        // Редактор
        edit: function(props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            return el('div', 
                { 
                    className: 'simple-gutenberg-container-editor',
                    style: {
                        border: '2px dashed #007cba',
                        borderRadius: '8px',
                        padding: '20px',
                        margin: '10px 0',
                        backgroundColor: attributes.backgroundColor,
                        minHeight: '100px'
                    }
                },
                [
                    // Заголовок контейнера (опционально)
                    el('div', { className: 'container-controls', style: { marginBottom: '15px' } },
                        [
                            el('input', {
                                type: 'text',
                                placeholder: 'Заголовок контейнера (опционально)',
                                value: attributes.containerTitle,
                                onChange: function(event) {
                                    setAttributes({ containerTitle: event.target.value });
                                },
                                style: {
                                    width: '100%',
                                    padding: '8px',
                                    border: '1px solid #ccc',
                                    borderRadius: '4px',
                                    marginBottom: '10px'
                                }
                            }),
                            el('select', {
                                value: attributes.padding,
                                onChange: function(event) {
                                    setAttributes({ padding: event.target.value });
                                },
                                style: { marginRight: '10px', padding: '5px' }
                            }, [
                                el('option', { value: 'small' }, 'Малый отступ'),
                                el('option', { value: 'medium' }, 'Средний отступ'),
                                el('option', { value: 'large' }, 'Большой отступ')
                            ])
                        ]
                    ),
                    
                    // Область для вложенных блоков
                    el('div', { 
                        className: 'inner-blocks-area',
                        style: {
                            minHeight: '60px',
                            border: '1px dashed #ccc',
                            borderRadius: '4px',
                            padding: '10px'
                        }
                    },
                        el(InnerBlocks, {
                            // Разрешаем ВСЕ типы блоков
                            allowedBlocks: null, // null означает все блоки
                            template: false,
                            renderAppender: InnerBlocks.ButtonBlockAppender
                        })
                    )
                ]
            );
        },

        // Сохранение (фронтенд)
        save: function(props) {
            var attributes = props.attributes;
            
            var containerClass = 'simple-gutenberg-container padding-' + attributes.padding;
            
            return el('div', 
                { 
                    className: containerClass,
                    style: {
                        backgroundColor: attributes.backgroundColor
                    }
                },
                [
                    // Заголовок, если есть
                    attributes.containerTitle ? 
                        el('h3', { className: 'container-title' }, attributes.containerTitle) : null,
                    
                    // Содержимое
                    el('div', { className: 'container-content' },
                        el(InnerBlocks.Content)
                    )
                ]
            );
        }
    });

})(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor
);
