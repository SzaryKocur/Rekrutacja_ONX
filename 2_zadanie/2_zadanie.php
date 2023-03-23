<?php 
  class TextInput {
    protected $value = '';

    public function add($text) {
        $this->value .= $text;
    }

    public function getValue() {
        return $this->value;
    }
}

  class NumericInput extends TextInput {
      public function add($text) {
          if (is_numeric($text)) {
              parent::add($text);
          }
      }
  }

  // Przykład użycia

  $input = new NumericInput();

$input->add('1');
$input->add('a');
$input->add('2');
$input->add('3');

echo $input->getValue(); // Wyświetli "123"
