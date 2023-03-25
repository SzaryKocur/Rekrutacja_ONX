<?php
    class Thesaurus {
        private $words;
      
        public function __construct($words) {
          $this->words = $words;
        }
      
        public function getSynonyms($word) {
          if (array_key_exists($word, $this->words)) {
            return json_encode(array("word" => $word, "synonyms" => $this->words[$word]));
          } else {
            return json_encode(array("word" => $word, "synonyms" => array()));
          }
        }
      }
      

      // Przykład użycia

      $thesaurus = new Thesaurus(array("market" => array("trade"), "small" => array("little", "compact")));
      echo $thesaurus->getSynonyms("small"); // '{"word":"small","synonyms":["little","compact"]}'
      echo $thesaurus->getSynonyms("asleast"); // '{"word":"asleast","synonyms":[]}'
      