<?php
//1
$a = -100;
$b = -55;

function evaluate($v1, $v2) {
    if ($v1 >= 0 && $v1 >= 0) {
        return $v1 - $v2;
    } elseif ($v1 < 0 && $v2 < 0) {
        return $v1 * $v2;
    } else {
        return $v1 + $v2;
    }
}

echo $a, ' ', $b, ' -> ', evaluate($a, $b), '<hr/>';

//2
$a = 12;

printUpTo15($a);

function printUpTo15($value): void {
    switch ($value <= 15 && $value > 0) {
        case true:
            {
                echo $value, ' ';
                printUpTo15($value + 1);
            }
        break;
    }
}

echo '<hr/>';

//3
$a = 5;
$b = 10;

function add($a, $b) {
    return $a + $b;
}

function subtract($a, $b) {
    return $a - $b;
}

function multiply($a, $b) {
    return $a * $b;
}

function divide($a, $b) {
    return $a / $b;
}

echo "$a + $b", '=', add($a, $b), '<br/>';
echo "$a - $b", '=', subtract($a, $b), '<br/>';
echo "$a * $b", '=', multiply($a, $b), '<br/>';
echo "$a / $b", '=', divide($a, $b), '<br/>';

echo '<hr/>';

//4
function mathOperation($arg1, $arg2, $operation) {
    switch ($operation) {
        case 'add':
            return add($arg1, $arg2);
        case 'subtract':
            return subtract($arg1, $arg2);
        case 'multiply':
            return multiply($arg1, $arg2);
        case 'divide':
            return divide($arg1, $arg2);
    }
}

echo  "$a + $b", '=', mathOperation($a, $b, 'add'), '<hr/>';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lesson17</title>
</head>
<body>
<?php echo date('Y') ?>
<?php require('date.php') ?>
<?php echo str_replace("{{year}}", date('Y'), file_get_contents('date.html')) ?>
<hr/>
</body>
</html>

<?php
//6
function power($val, $pow) {
    if ($pow > 0){
        return  $val * power($val, $pow - 1);
    }
    return $val;
}

echo '2^10=', power(2, 10), '<hr/>';
?>
