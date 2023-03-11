import {Pizza, PizzaSize, PizzaStuffing, Topping} from './pizza.js'

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


const pizza1 = new Pizza(stuffings[0], PizzaSize.small);
pizza1.addTopping(toppings[0])
pizza1.addTopping(toppings[1])
console.log(`price: ${pizza1.getPrice()}, calories: ${pizza1.getCalories()}`)

