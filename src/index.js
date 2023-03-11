import {Pizza, PizzaSize, PizzaSizeVariant, PizzaStuffing, Topping} from './pizza.js'

const stuffings = [
    new PizzaStuffing('Маргарита', 500, 300),
    new PizzaStuffing('Пепперони', 800, 400),
    new PizzaStuffing('Баварская', 700, 450),
]

const toppings = [
    new Topping('Сливочная моцарелла',50, 50),
    new Topping('Сырный борт', 150, 50),
    new Topping('Чеддер и пармезан',  150, 50),
]

const stuffingsContainer = document.getElementById('stuffings-selector')

function createCard(text) {
    const element = document.createElement('div')
    element.classList.add('btn', 'btn-light', 'card', 'text-center')
    const img = document.createElement('image')
    img.classList.add('card-img-top')
    img.style.height = '100px'
    const body = document.createElement('div')
    const textBlock = document.createElement('p')
    body.classList.add('card-body')
    textBlock.innerText = text;
    textBlock.classList.add('card-text')
    body.append(textBlock)
    element.append(img, body)
    return element;
}

for (const stuffing of stuffings) {
    const element = createCard(stuffing.name);
    element.addEventListener('click', () => setPizzaStuffing(stuffing))
    stuffingsContainer.append(element)
}


const sizesContainer = document.getElementById('size-selector')
for (const size of Object.values(PizzaSize)) {
    const element = document.createElement('label')
    element.classList.add('btn', 'btn-light')
    const inputElement = document.createElement('input')
    inputElement.type = 'radio'
    inputElement.classList.add('btn-check')
    element.innerText = size.name;
    element.append(inputElement)
    sizesContainer.append(element)
    element.addEventListener('click', () => setPizzaSize(size))
}

const toppingsContainer = document.getElementById('toppings-selector')
for (const topping of toppings) {
    const element = createCard(topping.name);
    element.classList.add('shadow-sm')
    element.setAttribute('data-bs-toggle', 'button')
    element.addEventListener('click', ()=>togglePizzaTopping(topping, element.getAttribute('aria-pressed')=== 'true'))
    toppingsContainer.append(element)
}

let currentPizza = new Pizza(stuffings[0], PizzaSize.small)
onPizzaConfigChanged();

function togglePizzaTopping(topping, isSelectedNow) {
    if (isSelectedNow)
        currentPizza.addTopping(topping)
    else
        currentPizza.removeTopping(topping)
    onPizzaConfigChanged();
}

function setPizzaStuffing(stuffing) {
    const toppings = currentPizza.toppings;
    currentPizza = new Pizza(stuffing, currentPizza.size)
    toppings.forEach(x=>currentPizza.addTopping(x))
    onPizzaConfigChanged();
}

function setPizzaSize(size) {
    const toppings = currentPizza.toppings;
    currentPizza = new Pizza(currentPizza.stuffing, size)
    toppings.forEach(x=>currentPizza.addTopping(x))
    onPizzaConfigChanged();
}

function onPizzaConfigChanged() {
    const pizzaInfoElement = document.getElementById('pizza-info')
    pizzaInfoElement.innerText = `${currentPizza.getPrice()}Р (${currentPizza.getCalories()} Ккал)`
}
