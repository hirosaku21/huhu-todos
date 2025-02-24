const instance = {
    el: {
        deleteButtons: [...document.querySelectorAll('button[type="submit"]')].filter(button => button.textContent.includes('削除')),
    },

    /**
     * 初期化
     */
    initialize: function() {
        this._disableButtonAfterClick();
    },

    // 二重クリック防止
    _disableButtonAfterClick: function() {
        // タッチデバイスかどうかの判別
        let eventType = 'ontouchstart' in window ? 'touchstart' : 'click';

        this.el.deleteButtons.forEach((button) => {
            button.addEventListener(`${eventType}`, (event) => {
                console.log(event, button);
                event.preventDefault();
                button.disabled = true;
                button.classList.remove('bg-indigo-400');
                button.classList.add('bg-gray-400');
                button.closest('form').submit();
            });
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    instance.initialize();
});
