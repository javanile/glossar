<?php

glossar()->init(function($source) {
    $source->set('languages', ['en', 'it']);
    $source->set('spellChecker', 'hunspell');
});

glossar()->rudiments([
    ''
]);

/*
// Override default command
glossar()->default(function($source) {
    foreach ($source->get('languages') as $lang) {
        $source
            ->scan('lang/array/'.$lang)
            ->ignoreWords(['workflow'])
            ->arrayValuesLanguageIs($lang);
    }
});
*/
glossar()->check('Expected array string values language', function ($source) {
    foreach ($source->get('languages') as $lang) {
        $source
            ->scan('lang/array/'.$lang)
           // ->ignore(['workflow'])
            ->expectedArrayValuesLanguageIs($lang);
    }
});
/*
glossar()->check('Expected strict source code', function($source) {
    $source->scan('src')->strictSourceCode();
});

glossar()->check('Array keys are used', function($source) {
    foreach ($source->get('languages') as $lang) {
        $source
            ->scan('lang/array/'.$lang)
            ->arrayKeysAreUsedInto('src');
    }
});

glossar()->check('Expected matched strings are array keys', function($source) {
    foreach ($source->get('languages') as $lang) {
        $source
            ->scan('src')
            ->matchedStringsAreArrayKeysInto('/^LBL_[A-Za-z]+$/', 'lang/array/'.$lang);
    }
});

/*
glossar()->check('Search Whore Words', function($source) {
    $source->scan('src')->searchWhoreWords();
});

glossar()->check('Search Bads Words', function($source) {
    $source->scan('src')->searchBadWords([
        'malware', ''
    ]);
});

/*
glossar()->check('Expected array string values language', function($source) {
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
glossar()->check('missing3', function($source) {
    foreach ($languages as $language) {
        $source->strictScope($language, 'src/', 'lang/'.$language);
    }
});

glossar()->check('missing3', function($source) use ($languages) {
    foreach ($languages as $language) {
        $source->strictScope($language, 'src/', 'lang/'.$language);
    }
});
*/
