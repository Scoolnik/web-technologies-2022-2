if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init)
} else {
    init()
}

function init() {
    const data = {
        name: 'Каталог товаров',
        hasChildren: true,
        items: [
            {
                name: 'Мойки',
                hasChildren: true,
                items: [
                    {
                        name: 'Ulgran1',
                        hasChildren: true,
                        items: [
                            {
                                name: 'SMT1',
                                hasChildren: false,
                                items: []
                            },
                            {
                                name: 'SMT2',
                                hasChildren: false,
                                items: []
                            }
                        ]
                    },
                    {
                        name: 'Ulgran2',
                        hasChildren: true,
                        items: [
                            {
                                name: 'SMT3',
                                hasChildren: false,
                                items: []
                            },
                            {
                                name: 'SMT4',
                                hasChildren: false,
                                items: []
                            }
                        ]
                    }
                ]
            },{
                name: 'Фильтры',
                hasChildren: true,
                items: [
                    {
                        name: 'Ulgran3',
                        hasChildren: true,
                        items: [
                            {
                                name: 'SMT5',
                                hasChildren: false,
                                items: []
                            },
                            {
                                name: 'SMT6',
                                hasChildren: false,
                                items: []
                            }
                        ]
                    }
                ]
            }
        ]
    }


    const items = new ListItems(document.getElementById('list-items'), data)


    items.render()
    items.init()

    /*console.log(items.renderTest(data));*/

    function ListItems(elements, data) {
        this.elements = elements;
        this.data = data;

        this.init = function () {
            const parents = this.elements.querySelectorAll('[data-parent]');
            parents.forEach(parent => {
                const open = parent.querySelector('[data-open]');
                open.addEventListener('click', () => this.toggleItems(parent));
            });
        }

        this.render = function () {
            this.elements.insertAdjacentHTML('beforeend', this.renderElement(this.data))
        }

        this.renderElement = function (element) {
            let html = '';
            html += '<div class="list-item list-item_open" data-parent>';
            html += this.renderElementInfo(element);
            html += '<div class="list-item__items">';
            element.items.forEach(item => html += this.renderElement(item));
            html+='</div>';
            html+='</div>';
            return html;
            //проверка всех элементов на hasChildren
            //если hasChildren, то запускаем renderParent
            //если !hasChildren, то запускаем renderChildren
            //возвращает рендер родительского элемента
        }

        this.renderElementInfo = function (element) {
            let html = '<div class="list-item__inner">';
            html += '<img class="list-item__arrow" src="img/chevron-down.png" alt="chevron-down" data-open>';
            html += '<img class="list-item__folder" src="img/folder.png" alt="folder">';
            html += `<span>${element.name}</span>`;
            html += '</div>';
            return html;
        }

        this.toggleItems = function (parent) {
            parent.classList.toggle('list-item_open')
        }

/*        this.renderTest = function (data) {
            return `
            <div class="test">${data.name}</div>
            `
        }*/
    }

}
