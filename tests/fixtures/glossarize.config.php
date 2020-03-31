<?php

glossarize()->init(function($source) {
    $source->set('languages', ['en', /*'it'*/]);
});

glossarize()->check('Expected array string values language is', function($source) {
    foreach ($source->get('languages') as $lang) {
        $source->scan('lang/array/'.$lang)->expectedArrayValuesLanguageIs($lang);
    }
});

/*
glossarize()->check('Expected array string values language is', function($source) {
    foreach ($source->get('languages') as $lang) {
        $source->scan('lang/'.$lang)->expectedStringsLanguageIs($lang);
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
*/
