<?php

$app = include __DIR__ . '/../src/App/bootstrap.php'; // bootstrap zwraca instancję aplikacji, ma dołączać pliki do projektu
                                                      // klasa app jest pobierana z frameworka

$app -> run();
?>