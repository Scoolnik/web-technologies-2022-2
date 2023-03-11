export class Pizza {
    /**
     * @param {PizzaStuffing} stuffing
     * @param {PizzaSizeVariant} size
     * @param {Topping[] | undefined}[toppings]
     */
    constructor(stuffing, size, toppings) {
        this.stuffing = stuffing;
        this.size = size;
        this.toppings = toppings || [];
    }

    addTopping(topping) {
        this.toppings.push(topping)
    }

    removeTopping(topping) {
        const index = this.toppings.indexOf(topping);
        this.toppings.splice(index, 1);
    }

    getPrice() {
        return this.#calculate('price');
    }

    getCalories() {
        return this.#calculate('calories');
    }

    #calculate(propName) {
        return this.stuffing[propName] + this.size[propName] + this.toppings.reduce((sum, x) => sum += x['get' + capitalizeFirstLetter(propName)](this.size), 0);
    }
}

export class PizzaStuffing {
    name;
    price;
    calories;

    constructor(name, price, calories) {
        this.name = name;
        this.price = price;
        this.calories = calories;
    }
}

export class PizzaSizeVariant {
    constructor(id, name, basePrice, baseCalories) {
        this.id = id;
        this.name = name;
        this.price = basePrice;
        this.calories = baseCalories;
    }
}


export const PizzaSize = {
    small: new PizzaSizeVariant(1, 'Маленькая', 100, 100),
    big : new PizzaSizeVariant(2, 'Большая', 200, 200),
}

export class Topping {
    name;
    #price;
    #calories;

    constructor(name, basePrice, baseCalories) {
        this.name = name;
        this.#price = basePrice;
        this.#calories = baseCalories;
    }

    getPrice(pizzaSizeVariant) {
        if (pizzaSizeVariant.id === PizzaSize.small.id)
            return this.#price;
        return this.#price * 2;
    }

    getCalories(pizzaSizeVariant) {
        return this.#calories;
    }
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
