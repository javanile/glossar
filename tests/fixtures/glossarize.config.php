<?php

glossarize()->init(function ($source) {
    $source->set('languages', ['en', 'it']);
    $source->set('spellchecker', 'hunspell');
});

/*
glossarize()->default(function($source) {
    foreach ($source->get('languages') as $lang) {
        $source
            ->scan('lang/array/'.$lang)
            ->ignoreWords(['workflow'])
            ->arrayValuesLanguageIs($lang);
    }
});
*/
glossarize()->check('Expected array string values language', function ($source) {
    foreach ($source->get('languages') as $lang) {
        $source
            ->scan('lang/array/'.$lang)
           // ->ignore(['workflow'])
            ->expectedArrayValuesLanguageIs($lang);
    }
});
/*
glossarize()->check('Expected strict source code', function($source) {
    $source->scan('src')->strictSourceCode();
});

glossarize()->check('Array keys are used', function($source) {
    foreach ($source->get('languages') as $lang) {
        $source
            ->scan('lang/array/'.$lang)
            ->arrayKeysAreUsedInto('src');
    }
});

glossarize()->check('Expected matched strings are array keys', function($source) {
    foreach ($source->get('languages') as $lang) {
        $source
            ->scan('src')
            ->matchedStringsAreArrayKeysInto('/^LBL_[A-Za-z]+$/', 'lang/array/'.$lang);
    }
});

/*
glossarize()->check('Search Whore Words', function($source) {
    $source->scan('src')->searchWhoreWords();
});

glossarize()->check('Search Bads Words', function($source) {
    $source->scan('src')->searchBadWords([
        'malware', ''
    ]);
});

/*
glossarize()->check('Expected array string values language', function($source) {
    foreach ($source->get('languages') as $lang) {
        $source->scan('lang/plain/'.$lang)->expectedStringsLanguageIs($lang);
    }
});
*/

/*
*
 *
 */
/*
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
