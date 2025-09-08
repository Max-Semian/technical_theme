/**
 * Gutenberg Container Block Editor Enhancements
 */
(function() {
    'use strict';

    // Функция для подсчета блоков в контейнере
    function updateBlockCount() {
        const containers = document.querySelectorAll('.wp-block[data-type="acf/gutenberg-container-advanced"]');
        
        containers.forEach(container => {
            const innerBlocks = container.querySelectorAll('.wp-block[data-type]:not([data-type="acf/gutenberg-container-advanced"])');
            const titleElement = container.querySelector('.container-title');
            const maxBlocks = container.getAttribute('data-max-blocks');
            
            if (titleElement && titleElement.textContent.includes('(')) {
                // Обновляем существующий счетчик
                titleElement.textContent = titleElement.textContent.replace(/\(\d+ блоков?\)/, `(${innerBlocks.length} блоков)`);
            } else if (titleElement && innerBlocks.length > 0) {
                // Добавляем счетчик если его нет
                titleElement.textContent += ` (${innerBlocks.length} блоков)`;
            }
            
            // Проверяем лимит блоков
            if (maxBlocks && parseInt(maxBlocks) > 0) {
                const appender = container.querySelector('.wp-block-appender');
                if (innerBlocks.length >= parseInt(maxBlocks)) {
                    if (appender) {
                        appender.style.display = 'none';
                    }
                } else {
                    if (appender) {
                        appender.style.display = 'block';
                    }
                }
            }
        });
    }

    // Функция для добавления индикатора типа контейнера
    function addContainerTypeIndicator() {
        const containers = document.querySelectorAll('.gutenberg-container');
        
        containers.forEach(container => {
            if (container.querySelector('.container-type-indicator')) {
                return; // Индикатор уже добавлен
            }
            
            const containerType = container.classList.contains('container-type-card') ? 'Карточка' :
                                container.classList.contains('container-type-section') ? 'Секция' : 'Обычный';
            
            const indicator = document.createElement('div');
            indicator.className = 'container-type-indicator';
            indicator.textContent = containerType;
            indicator.style.cssText = `
                position: absolute;
                top: -10px;
                right: 10px;
                background: var(--global-violet, #311067);
                color: white;
                padding: 2px 8px;
                font-size: 10px;
                border-radius: 3px;
                z-index: 10;
                opacity: 0.8;
            `;
            
            container.style.position = 'relative';
            container.appendChild(indicator);
        });
    }

    // Обработчик изменений в редакторе
    function handleEditorChanges() {
        updateBlockCount();
        addContainerTypeIndicator();
    }

    // Инициализация при загрузке страницы
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', handleEditorChanges);
    } else {
        handleEditorChanges();
    }

    // Отслеживание изменений в DOM (для динамических обновлений)
    const observer = new MutationObserver(function(mutations) {
        let shouldUpdate = false;
        
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1 && 
                        (node.classList && node.classList.contains('wp-block') || 
                         node.querySelector && node.querySelector('.wp-block'))) {
                        shouldUpdate = true;
                    }
                });
            }
        });
        
        if (shouldUpdate) {
            setTimeout(handleEditorChanges, 100);
        }
    });

    // Начинаем наблюдение за изменениями
    if (document.body) {
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }

    // Добавляем стили для улучшения UX
    const style = document.createElement('style');
    style.textContent = `
        .gutenberg-container .wp-block-appender {
            transition: opacity 0.3s ease;
        }
        
        .gutenberg-container .wp-block-appender:hover {
            opacity: 1 !important;
        }
        
        .container-type-indicator {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        }
        
        .gutenberg-container[data-max-blocks] .block-limit-warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 8px 12px;
            border-radius: 4px;
            margin: 8px 0;
            font-size: 12px;
        }
    `;
    document.head.appendChild(style);

})();
