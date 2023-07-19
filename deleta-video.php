<?php

declare(strict_types=1);

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$pdo->exec('DELETE FROM videos WHERE ID = 4');
$pdo->exec('DELETE FROM videos WHERE ID = 5');
$pdo->exec('DELETE FROM videos WHERE ID = 6');
$pdo->exec('DELETE FROM videos WHERE ID = 7');
$pdo->exec('DELETE FROM videos WHERE ID = 8');
$pdo->exec('DELETE FROM videos WHERE ID = 9');
$pdo->exec('DELETE FROM videos WHERE ID = 10');
$pdo->exec('DELETE FROM videos WHERE ID = 11');
$pdo->exec('DELETE FROM videos WHERE ID = 12');