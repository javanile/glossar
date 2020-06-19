<?php

namespace Javanile\Glossar\Rudiments;

trait sfacfvc GlossaryAnalysis
{
    /**
     *
     */
    public function glossaryAnalysis()
    {
        $files = $this->getFiles();
        $parser = $this->getConfig()->getParser();
        $spellChecker = $this->getConfig()->getSpellChecker();
        $stopOnFailure = $this->get('stop-on-failure');
        $ignoredWords = ['this', 'is'];

        $allWords = [];
        foreach ($files as $file) {
            #echo "=== {$file['relative']} ===\n";
            $words = $parser->getGlossaryWords($file['filename']);
            foreach ($words as $word => $records) {
                if (in_array($word, $ignoredWords)) {
                    continue;
                }
                foreach ($records as $record) {
                    if (strlen($word) == 1 ) {
                        echo "Word '{$word}' is too short in file '{$file['relative']}' on lines '{$record['line']}'\n";
                        var_dump($record);
                        if ($stopOnFailure) {
                            return 1;
                        }
                    }
                    if (strlen($word) < 3 && $record['type'] != 'string' && $record['span'] == 1) {
                        echo "Word '{$word}' is too short in file '{$file['relative']}' on lines '{$record['line']}'\n";
                        var_dump($record);
                        if ($stopOnFailure) {
                            return 1;
                        }
                    }
                }
                if (empty($allWords[$word])) {
                    $allWords[$word] = [];
                }
                $allWords[$word] = array_merge($allWords[$word], $records);
            }
        }

        uasort($allWords, function ($lines1, $lines2) {
            return count($lines1) > count($lines2);
        });

        foreach ($allWords as $word => $lines) {
            $count = count($lines);
            echo "$word ($count)\n";
        }
    }
}
