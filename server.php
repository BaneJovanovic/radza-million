<?php

require_once 'radza-million.php';
$radzaMillion = new RadzaMilion();


if (isset($_POST['generate-form-submit']) && $_POST['generate-form-submit'] == 1) {

    echo json_encode($radzaMillion->generateButtonClickResult($_POST));
}

if (isset($_POST['analyze-form-submit']) && $_POST['analyze-form-submit'] == 1) {

    echo json_encode($radzaMillion->analyzeButtonClickResult($_POST));
}

