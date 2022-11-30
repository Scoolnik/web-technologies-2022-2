function pickPropArray(objects, propName) {
    return objects.map((x) => x[propName]).filter((x) => x !== undefined);
}

const students = [
    {name: 'Павел', age: 20},
    {name: 'Иван', age: 20},
    {name: 'Эдем', age: 20},
    {name: 'Денис', age: 20},
    {name: 'Виктория', age: 20},
    {age: 40},
]

const result = pickPropArray(students, 'name')

console.log(result) // [ 'Павел', 'Иван', 'Эдем', 'Денис', 'Виктория' ]


function createCounter() {
    let count = 0;
    return () => console.log(++count);
}

const counter1 = createCounter()
counter1() // 1
counter1() // 2

const counter2 = createCounter()
counter2() // 1
counter2() // 2


function spinWords(str) {
    return str.split(' ').map((x) => x.length < 5 ? x : x.split("").reverse().join("")).join(' ');
}

const result1 = spinWords("Привет от Legacy")
console.log(result1) // тевирП от ycageL

const result2 = spinWords("This is a test")
console.log(result2) // This is a test


function solveTask4(nums, target) {
    for (let i = 0; i < nums.length; i++)
        for (let j = i + 1; j < nums.length; j++)
            if (nums[i] + nums[j] === target)
                return [i, j]
}

console.log(solveTask4([2, 7, 11, 15], 9));

function getLongestCommonPart(strs) {
    let part = '';
    let longestPart = part;
    let isCommon = (arr, part) => arr.every((x) => x.includes(part));

    for (let i = 0; i < strs[0].length; i++) {
        part = '';
        for (let j = i; j < strs[0].length; j++) {
            let tmp = part + strs[0][j];
            if (!isCommon(strs.slice(1), tmp))
                break;
            part = tmp;
        }
        longestPart = part.length > longestPart.length ? part : longestPart;
    }
    return longestPart.length > 1 ? longestPart : '';
}

console.log(getLongestCommonPart(["цветок", "поток", "хлопок"]));
console.log(getLongestCommonPart(["собака", "гоночная машина", "машина"]));