<?php

$languages = [ 'en', 'it' ];

glossarize()->check('missing', function($code) {
    foreach ($languages as $language) {
        $code->scan('lang/'.$language)->strictStringLanguage($language);
    }
});

glossarize()->check('missing2', function($code) {
    $code->strictSourceCode(['src/']);
});

glossarize()->check('missing3', function($code) {
    foreach ($languages as $language) {
        $code->strictScope($language, 'src/', 'lang/'.$language);
    }
});

glossarize()->check('missing3', function($code) {
    foreach ($languages as $language) {
        $code->strictScope($language, 'src/', 'lang/'.$language);
    }
});
