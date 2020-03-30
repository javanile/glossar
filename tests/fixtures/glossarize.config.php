<?php

$languages = ['en', 'it'];

glossarize()->check('missing', function($source) use ($languages) {
    foreach ($languages as $language) {
        $source->scan('lang/'.$language)->strictStringLanguage($language);
    }
});

glossarize()->check('missing2', function($source) {
    $source->strictSourceCode();
});

glossarize()->check('missing3', function($source) {
    foreach ($languages as $language) {
        $source->strictScope($language, 'src/', 'lang/'.$language);
    }
});

glossarize()->check('missing3', function($source) use ($languages) {
    foreach ($languages as $language) {
        $source->strictScope($language, 'src/', 'lang/'.$language);
    }
});
