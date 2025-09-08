/* Общий JavaScript для блоков в редакторе */
(function() {
    'use strict';
    
    // Общие функции для всех блоков темы casino
    window.ACFBlocksTheme = window.ACFBlocksTheme || {};
    
    // Инициализация общих функций
    window.ACFBlocksTheme.init = function() {
        console.log('ACF Blocks Theme: Editor scripts loaded');
    };
    
    // Запуск при загрузке
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', window.ACFBlocksTheme.init);
    } else {
        window.ACFBlocksTheme.init();
    }
})();
