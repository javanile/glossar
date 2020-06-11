<?php

namespace Javanile\Glossar\Rudiments;

trait GlossaryAnalysis
{
    /**
     *
     */
    public function glossaryAnalysis()
    {
        $files = $this->getFiles();
        $parser = $this->getConfig()->getParser();
        $spellChecker = $this->getConfig()->getSpellChecker();

        $allWords = [];
        foreach ($files as $file) {
            //echo "=== {$relativePath} ===\n";
            $words = $parser->getGlossaryWords($file['filename']);
            foreach ($words as $word => $lines) {
                if (empty($allWords[$word])) {
                    $allWords[$word] = [];
                }
                $allWords[$word] = array_merge($allWords[$word], $lines);
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
