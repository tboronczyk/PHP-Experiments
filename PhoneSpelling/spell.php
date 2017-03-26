#! /usr/bin/php
<?php
// Output all of the possible letter combinations that a given phone number
// could represent.

$number = $_SERVER['argv'][1];

define('KEYPAD', [
    1 => [null],
    2 => ['A', 'B', 'C'],
    3 => ['D', 'E', 'F'],
    4 => ['G', 'H', 'I'],
    5 => ['J', 'K', 'L'],
    6 => ['M', 'N', 'O'],
    7 => ['P', 'Q', 'R', 'S'],
    8 => ['T', 'U', 'V'],
    9 => ['W', 'X', 'Y', 'Z'],
    0 => [null]
]);

$db = new PDO('sqlite::memory:');
foreach (KEYPAD as $digit => $letters) {
    $db->query("CREATE TABLE key_$digit (letter char(1))");
    $db->query("INSERT INTO key_$digit (letter) VALUES ('" .
        join("'), ('", $letters) . "')");
}

$fields = $tables = [];
foreach (str_split($number) as $pos => $digit) {
   $fields[] = "k$pos.letter";
   $tables[] = "key_$digit AS k$pos";
}
$result = $db->query(
    'SELECT ' . join(', ', $fields) . ' FROM ' . join(' CROSS JOIN ' , $tables)
);

$results = array_map('join', $result->fetchAll(PDO::FETCH_NUM));
print_r($results);
