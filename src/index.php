<?php
//1
function getValueName($value) {
    if ($value == 0)
        return 'это ноль';
    return $value % 2 == 0 ? 'чётное число' : 'нечётное число';
}

function printRange($start, $end) {
    $value = $start;
    do {
        echo $value, ' – ', getValueName($value), '.</br>';
        $value++;
    } while ($value <= $end);
}
printRange(0, 10);

echo '<hr>';

//2
$regions = array(
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
    'Рязанская область' => ['Рязань'],
);

function printCities($regions) {
    foreach ($regions as $region => $cities) {
        echo $region . ":<br>" . implode(", ", $cities) . ".<br>";
    }
}

printCities($regions);
echo '<hr>';


//3

$rusToTranslit = array(
    'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
    'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I',
    'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
    'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
    'У' => 'U', 'Ф' => 'F', 'Х' => 'KH', 'Ц' => 'TS', 'Ч' => 'CH',
    'Ш' => 'SH', 'Щ' => 'SHCH', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '',
    'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
    'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
    'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
    'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
    'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
    'у' => 'u', 'ф' => 'f', 'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch',
    'ш' => 'sh', 'щ' => 'shch', 'ъ' => '', 'ы' => 'y', 'ь' => '',
    'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
);

function getTranslit($str) {
    global $rusToTranslit;
    echo strtr($str, $rusToTranslit);
}

getTranslit('Привет, мир');
echo '<hr>';

//4
$menu = [
    [
        'label' => '1',
        'link' => '#',
    ],
    [
        'label' => '2',
        'link' => '#',
        'list' => [
            [
                'label' => '2.1',
                'link' => '#',
                'list' => [
                    [
                        'label' => '2.1.1',
                        'link' => '#',
                    ]
                ]
            ]
        ]
    ]
];

function menuToHTML($menu) {
    $result = '<ul>';
    foreach ($menu as $key => $value) {
        $result .= "<li>";
        $result .= array_key_exists('link', $value) && $value['link'] != '' ?
            "<a href={$value['link']}> {$value['label']} </a>" :
            $value['label'];
        $result .= array_key_exists('list', $value)? menuToHTML($value['list']) : '';
        $result .= "</li>";
    }

    return $result . "</ul>";
}

echo menuToHTML($menu);
