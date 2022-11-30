export const TicTacToe = {
  // Элемент с полями в дом дереве
  el: null,

  // Булевое значение закончилась ли игра
  isGameEnd: false,

  // Булевое значение
  // true если текущий ход у X
  // false если текущий ход у O
  isXTurn: true,

  // Матрица 3 на 3 с информацией о полях
  matrix: [
    [null, null, null],
    [null, null, null],
    [null, null, null],
  ],

  // массив победных комбинаций
  // состоит из массивов вида [row, col]
  // если все 3 значения равны, то игра окончена
  wonCombinations: [
    [[1, 1], [1, 2], [1, 3]],
    [[2, 1], [2, 2], [2, 3]],
    [[3, 1], [3, 2], [3, 3]],
    [[1, 1], [2, 2], [3, 3]],
    [[1, 3], [2, 2], [3, 1]],
    [[1, 1], [2, 1], [3, 1]],
    [[1, 2], [2, 2], [3, 2]],
    [[1, 3], [2, 3], [3, 3]],
  ],

  /**
   * Функция инициализации элементов и запуска игры
   * @returns {object} - текущий объект
   */
  init({el, onMove}) {
    this.el = el
    this.onMove = onMove
    this.boxes = el.querySelectorAll('.tic-tac-toe__ceil')

    return this
  },

  /**
   * Инициализация слушателя клика и вызов колбэка текущего хода
   */
  startGame() {
    this.initListeners()
    this.onMove(this.isXTurn)
  },

  /**
   * Функция инициализации слушателей события клика по ячейке
   */
  initListeners() {
    this.boxes.forEach(box => {
      box.addEventListener('click', event => {
        // проверка не закончилась ли игра и не пустой ли блок
        if (this.isGameEnd || !this.isBlockEmpty(event.target))
          return

        // изменение значения элемента в матрице
        this.setBlockValue(event.target)
        // изменение значения элемента в дом дереве
        this.setBlockDom(event.target)

        this.checkIfGameEnded();
      })
    })
  },

  checkIfGameEnded() { //todo rename
    // проверка на победу
    if (this.checkForWin()) {
      this.isGameEnd = true;
      setTimeout(() => alert('Победил ' + this.getCurrentTurnValue()))
      return;
    }

    // проверка на наличие пустых блоков
    if (!this.checkHasEmptyBlocks()) {
      this.isGameEnd = true;
      setTimeout(() => alert('Ничья'))
      return
    }

    // изменить значение текущего хода в объекте
    this.changeTurnValue()
    // изменить значение текущего хода в дом дереве
    this.onMove && this.onMove(this.isXTurn)
  },

  /**
   * Проверка на наличие пустых блоков
   * @returns {boolean} - true если есть пустые блоки, false - если нет
   */
  checkHasEmptyBlocks() {
    return this.matrix.some(x=>x.some(y=>y === null));
  },

  /**
   * Сброс данных и очищение дом дерева
   */
  restartGame() {
    this.boxes.forEach(x=>{
        this.setBlockDom(x, true)
        this.setBlockValue(x, true)
    })
    this.isGameEnd = false;
  },

  /**
   * Проверка пустой ли блок
   * @param {HTMLDivElement} target - ячейка в дом дереве
   * @returns {boolean} - true если блок пустой
   */
  isBlockEmpty(target) {
    const [row, col] = this.getBlockPosition(target)

    return this.matrix[row - 1][col - 1] === null;
  },

  /**
   * Получение позиции блока из dataset
   * @param {HTMLDivElement} target - ячейка в дом дереве
   * @returns {array} - массив со строкой и колонкой target вида [row, col]
   */
  getBlockPosition(target) {
    const {row, col} = target.dataset

    return [row, col]
  },

  /**
   * Изменение значения элемента в матрице
   * Определяет значение [row, col] ячейки, после чего устанавливает
   * значение в матрице для соответствующего поля
   * @param {HTMLDivElement} target - ячейка в дом дереве
   * @param {boolean?} clear - если true - отчистить ячейку в матрице
   */
  setBlockValue(target, clear) {
    const [row, col] = this.getBlockPosition(target)
      this.matrix[row - 1][col - 1] = clear?null:this.getCurrentTurnValue();
  },

  /**
   * Изменение значения элемента в дом дереве
   * Определяет текущий ход, после чего устанавливает
   * значение в дом дереве
   * @param {HTMLDivElement} target - ячейка в дом дереве
   * @param {boolean?} clear - если true - отчистить target
   */
  setBlockDom(target, clear) {
    target.textContent = clear ? '' : this.getCurrentTurnValue();
  },

  /**
   * Получение строки с текущем ходом
   * @returns {string} Текущий ход 'X' или 'O'
   */
  getCurrentTurnValue() {
    return this.isXTurn?'X':'0';
  },

  /**
   * Изменение текущего хода в данных
   */
  changeTurnValue() {
    this.isXTurn = !this.isXTurn;
  },

  /**
   * Проверка победных комбинаций
   * @returns {boolean} - true если кто-то победил
   */
  checkForWin() {
    for (let i = 0; i < this.wonCombinations.length; i++) {
      const [first, second, third] = this.wonCombinations[i]


      if (
        this.matrix[first[0] - 1][first[1] - 1] &&
        this.matrix[first[0] - 1][first[1] - 1] === this.matrix[second[0] - 1][second[1] - 1] &&
        this.matrix[third[0] - 1][third[1] - 1] === this.matrix[second[0] - 1][second[1] - 1]
      ) {
        return true
      }
    }

    return false
  }
}