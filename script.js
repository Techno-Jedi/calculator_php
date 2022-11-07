function inputValue() {
    let inputOne = document.querySelector(".input-one");
    let numberOne = inputOne.value;
    let inputTwo = document.querySelector(".input-two");
    let numberTwo = inputTwo.value;
    let operation = document.querySelector(".operation");
    let operationsValue = operation.value;
    fetch(`index.php?input-one=${numberOne}&input-two=${numberTwo}&operation=${operationsValue}`)
        .then(response => response.text())
        .then(textResult => {
            let result = document.querySelector(".check")
            result.innerHTML = " Ваш результат: " + textResult
        })
}
