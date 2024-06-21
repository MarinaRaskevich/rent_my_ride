<?php
require __DIR__ . '/../helpers/http_helper.php';
$title = "Réservation";

renderView('booking', compact('title'));
