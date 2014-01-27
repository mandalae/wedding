<?php
class Util {

    public function truncateText($str, $length, $elipsis = '..'){
        if (strlen($str) > $length){
            return substr($str, 0, $length) . $elipsis;
        }
        return $str;
    }
    
    public static function seoSafe($str){
        $spaceCharacter = '-';
        
		// Make all links lowercase
		$str = strtolower(utf8_encode($str));

		$trans = array(
		    "Æ" => "ae", "Ø" => "oe", "Å" => "aa",
			"æ" => "ae", "ø" => "oe", "å" => "aa",
			"á" => "a",	"é" => "e",	"ë" => "e",	"ñ" => "n",
			"ö" => "o",	"ü" => "u",	"ß" => "s", "à" => "a",
			"á" => "a", "â" => "a", "ã" => "a", "ä" => "a",
			"ç" => "c", "è" => "e", "é" => "e", "ê" => "e",
			"ë" => "e", "ì" => "i", "í" => "i", "î" => "i",
			"ï" => "i", "ð" => "o", "ñ" => "n", "ò" => "o",
			"ó" => "o", "ô" => "o", "õ" => "o", "ö" => "o",
			"ù" => "u", "ú" => "u", "û" => "u", "ü" => "u",
			"ý" => "y", "ÿ" => "y", "²" => "2", "&" => "og");

		$str = strtr($str, $trans);

		$str = preg_replace('/(\W){1,}/', $spaceCharacter, $str);
		$str = preg_replace('/[^a-zA-Z0-9_-]+/i', '', $str);

		$str = trim($str, '-');

		$str = htmlentities($str);

		return $str;
    }
    
    public function toTag($str){
        $str = str_replace(" ", "", $str);
        $str = str_replace("_", "", $str);
        return $str;
    }

    
}