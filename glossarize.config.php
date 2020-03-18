<?php

$languages = [ 'en', 'it' ];

$exception = [];

glossarize()->define('missing', function($code) {
    foreach ($languages as $language) {
        $code->strictStringLanguage($language, 'lang/'.$language.'/glossarize_'.$language.'.php');
    }
});

glossarize()->define('missing2', function($code) {
    $code->strictSourceCode(['src/']);
});

glossarize()->define('missing3', function($code) {
    foreach ($languages as $language) {
        $code->strictScope($language, 'lang/'.$language.'/glossarize_'.$language.'.php');
    }
});
