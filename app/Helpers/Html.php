<?php
// String Limiter by word
define("STRING_DELIMITER", " ");
function word_limiter($str, $limit) {
    $str = strip_tags($str); // Updated from Ivan Dimov
    if (stripos($str, STRING_DELIMITER)) {
        $ex_str = explode(STRING_DELIMITER, $str);
        if (count($ex_str) > $limit) {
            $str_s = '';
            for ($i = 0; $i < $limit; $i++) {
                $str_s.=$ex_str[$i] . " ";
            }
            return $str_s;
        } else {
            return $str;
        }
    } else {
        return $str;
    }
}