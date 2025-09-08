/**
 * Gutenberg Container Block Editor Script
 * Adds InnerBlocks support to ACF blocks
 */

(function() {
    'use strict';

    // Проверяем, доступен ли wp
    if (typeof wp === 'undefined' || !wp.blocks) {
        return;
    }

    const { registerBlockType } = wp.blocks;
    const { InnerBlocks } = wp.blockEditor || wp.editor;
    const { createElement: el } = wp.element;

    // Настройки для InnerBlocks
    const ALLOWED_BLOCKS = [
        'core/paragraph',
        'core/heading',
        'core/image',
        'core/gallery',
        'core/list',
        'core/quote',
        'core/button',
        'core/buttons',
        'core/columns',
        'core/group',
        'core/spacer',
        'acf/promo-block-universal',
        'acf/nav-block-universal',
        'acf/game-block-universal',
        'acf/advice-block-universal',
        'acf/faq-block-universal',
        'acf/main-title',
        'acf/bonus-card',
        'acf/game-card',
        'acf/review-card'
    ];

    const TEMPLATE = [
        ['core/paragraph', { placeholder: 'Начните добавлять контент в этот контейнер...' }]
    ];

    // Фильтр для модификации ACF блоков
    if (wp.hooks && wp.hooks.addFilter) {
        wp.hooks.addFilter(
            'blocks.registerBlockType',
            'acf-gutenberg-container/add-innerblocks',
            function(settings, name) {
                // Применяем только к нашим контейнерам
                if (name === 'acf/gutenberg-container' || name === 'acf/gutenberg-container-advanced') {
                    return {
                        ...settings,
                        edit: function(props) {
                            const { attributes, setAttributes, clientId } = props;
                            
                            return el('div', {
                                className: 'gutenberg-container-editor'
                            }, [
                                // ACF поля (рендерятся автоматически)
                                el('div', { 
                                    key: 'acf-fields',
                                    className: 'acf-block-fields'
                                }),
                                // InnerBlocks область
                                el('div', {
                                    key: 'inner-blocks',
                                    className: 'gutenberg-container-inner'
                                }, el(InnerBlocks, {
                                    allowedBlocks: ALLOWED_BLOCKS,
                                    template: TEMPLATE,
                                    templateLock: false,
                                    renderAppender: InnerBlocks.ButtonBlockAppender
                                }))
                            ]);
                        },
                        save: function() {
                            return el(InnerBlocks.Content);
                        }
                    };
                }
                return settings;
            }
        );
    }

    // Дополнительные стили для редактора
    const editorStyles = `
        .gutenberg-container-editor {
            border: 2px dashed #64d4b7;
            border-radius: 8px;
            padding: 16px;
            margin: 16px 0;
        }
        
        .gutenberg-container-inner {
            min-height: 100px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
        }
        
        .acf-block-fields {
            margin-bottom: 16px;
        }
        
        .gutenberg-container-editor .wp-block-appender {
            margin: 8px 0;
        }
    `;

    // Добавляем стили
    const styleSheet = document.createElement('style');
    styleSheet.textContent = editorStyles;
    document.head.appendChild(styleSheet);

})();
