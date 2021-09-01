<?php

class RevertCharacters
{
    // Переворот строки на латинице (используется ctype_upper(), так проще, но с кириллицей не прокатит)
    private function mbStrrevLat($str)
    {
        $r = '';
        $strlen = mb_strlen($str);
        for ($i = $strlen; $i >= 0; $i--) {
            $symbol = mb_substr($str, $i, 1);
            if (ctype_upper(mb_substr($str, $strlen - ($i + 1), 1))) {
                $symbol = mb_strtoupper($symbol);
            } else {
                $symbol = mb_strtolower($symbol);
            }
            $r .= $symbol;
        }

        return $r;
    }

    // Переворот строки на кириллице (без использования ctype_upper(), более универсальная функция)
    private function mbStrrevCyr($str)
    {
        $r = '';
        $strlen = mb_strlen($str);
        for ($i = $strlen; $i >= 0; $i--) {
            $symbol = mb_substr($str, $i, 1);
            $symbolOrig = mb_substr($str, $strlen - ($i + 1), 1);
            $symbolRegister = ($symbolOrig == mb_strtoupper($symbolOrig)) ? 'upper' : 'lower';
            $symbol = ($symbolRegister == 'upper') ? mb_strtoupper($symbol) : mb_strtolower($symbol);
            $r .= $symbol;
        }

        return $r;
    }

    public function revertCharacters($string)
    {
        // разбиваем строку на слова по пробелу, запятой, точкой, восклицательному и вопросительному знакам, а также кавычке
        $origWords = preg_split("/[\s,.!?\']+/", $string, -1, PREG_SPLIT_OFFSET_CAPTURE|PREG_SPLIT_NO_EMPTY);

        foreach ($origWords as $origWord) {
            // переворачиваем каждое слово
            $reverseWord = [$this->mbStrrevCyr($origWord[0]), $origWord[1], strlen($origWord[0])];
            // зная местоположение и длину слова в строке, вставляем его обратно в строку
            $string = substr_replace($string, $reverseWord[0], $reverseWord[1], $reverseWord[2]);
        }

        return $string;
    }
}
