window.addEventListener('DOMContentLoaded', function () {
    function getMenuItems() {
        return document.getElementsByClassName('menu-item');
    }

    function showNestedItem(menuID, nivel) {
        for (const item of items) {
            if (item.dataset.padreId === menuID) {
                if(item.classList.contains('invisible')){
                    item.classList = `menu-item link-l${item.dataset.nivel}`;
                    item.innerHTML = `<i class="${item.dataset.icon} mr-2"></i> ${item.dataset.titulo}`;
                } else {
                    item.classList = `menu-item invisible invisible-c`;
                    item.innerHTML = ``;
                };
            } else {
                if (item.dataset.nivel > nivel) {
                    item.classList = `menu-item invisible invisible-c`;
                    item.innerHTML = ``;
                }
            }
        }
    }


    var items = getMenuItems();

    for (const item of items) {
        item.addEventListener('click', function () {
            showNestedItem(item.dataset.menuId, item.dataset.nivel);
        })
    }
})