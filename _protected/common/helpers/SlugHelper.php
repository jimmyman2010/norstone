<?php
/**
 * Created by PhpStorm.
 * User: Jimmy
 * Date: 6/15/2015
 * Time: 9:54 PM
 */

namespace common\helpers;

/**
 * Class SlugHelper
 * @package common\helpers
 */
class SlugHelper {

    protected function my_str_split($string)
    {
        $slen=strlen($string);
        for($i=0; $i<$slen; $i++)
        {
            $sArray[$i]=$string{$i};
        }
        return $sArray;
    }

    protected function noDiacritics($string)
    {
        //cyrylic transcription
        $cyrylicFrom = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
        $cyrylicTo   = array('A', 'B', 'W', 'G', 'D', 'Ie', 'Io', 'Z', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Ch', 'C', 'Tch', 'Sh', 'Shtch', '', 'Y', '', 'E', 'Iu', 'Ia', 'a', 'b', 'w', 'g', 'd', 'ie', 'io', 'z', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'ch', 'c', 'tch', 'sh', 'shtch', '', 'y', '', 'e', 'iu', 'ia');

        $from = array("Á", "À", "Â", "Ä", "Ă", "Ā", "Ã", "Å", "Ą", "Æ", "Ć", "Ċ", "Ĉ", "Č", "Ç", "Ď", "Đ", "Ð", "É", "È", "Ė", "Ê", "Ë", "Ě", "Ē", "Ę", "Ə", "Ġ", "Ĝ", "Ğ", "Ģ", "á", "à", "â", "ä", "ă", "ā", "ã", "å", "ą", "æ", "ć", "ċ", "ĉ", "č", "ç", "ď", "đ", "ð", "é", "è", "ė", "ê", "ë", "ě", "ē", "ę", "ə", "ġ", "ĝ", "ğ", "ģ", "Ĥ", "Ħ", "I", "Í", "Ì", "İ", "Î", "Ï", "Ī", "Į", "Ĳ", "Ĵ", "Ķ", "Ļ", "Ł", "Ń", "Ň", "Ñ", "Ņ", "Ó", "Ò", "Ô", "Ö", "Õ", "Ő", "Ø", "Ơ", "Œ", "ĥ", "ħ", "ı", "í", "ì", "i", "î", "ï", "ī", "į", "ĳ", "ĵ", "ķ", "ļ", "ł", "ń", "ň", "ñ", "ņ", "ó", "ò", "ô", "ö", "õ", "ő", "ø", "ơ", "œ", "Ŕ", "Ř", "Ś", "Ŝ", "Š", "Ş", "Ť", "Ţ", "Þ", "Ú", "Ù", "Û", "Ü", "Ŭ", "Ū", "Ů", "Ų", "Ű", "Ư", "Ŵ", "Ý", "Ŷ", "Ÿ", "Ź", "Ż", "Ž", "ŕ", "ř", "ś", "ŝ", "š", "ş", "ß", "ť", "ţ", "þ", "ú", "ù", "û", "ü", "ŭ", "ū", "ů", "ų", "ű", "ư", "ŵ", "ý", "ŷ", "ÿ", "ź", "ż", "ž");
        $to   = array("A", "A", "A", "A", "A", "A", "A", "A", "A", "AE", "C", "C", "C", "C", "C", "D", "D", "D", "E", "E", "E", "E", "E", "E", "E", "E", "G", "G", "G", "G", "G", "a", "a", "a", "a", "a", "a", "a", "a", "a", "ae", "c", "c", "c", "c", "c", "d", "d", "d", "e", "e", "e", "e", "e", "e", "e", "e", "g", "g", "g", "g", "g", "H", "H", "I", "I", "I", "I", "I", "I", "I", "I", "IJ", "J", "K", "L", "L", "N", "N", "N", "N", "O", "O", "O", "O", "O", "O", "O", "O", "CE", "h", "h", "i", "i", "i", "i", "i", "i", "i", "i", "ij", "j", "k", "l", "l", "n", "n", "n", "n", "o", "o", "o", "o", "o", "o", "o", "o", "o", "R", "R", "S", "S", "S", "S", "T", "T", "T", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "W", "Y", "Y", "Y", "Z", "Z", "Z", "r", "r", "s", "s", "s", "s", "B", "t", "t", "b", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "w", "y", "y", "y", "z", "z", "z");

        $vietFrom = array(
            'á','é','í','ó','ú','ý','Á','É','Í','Ó','Ú','Ý',
            'à','è','ì','ò','ù','ỳ','À','È','Ì','Ò','Ù','Ỳ',
            'ả','ẻ','ỉ','ỏ','ủ','ỷ','Ả','Ẻ','Ỉ','Ỏ','Ủ','Ỷ',
            'ã','ẽ','ĩ','õ','ũ','ỹ','Ã','Ẽ','Ĩ','Õ','Ũ','Ỹ',
            'ạ','ẹ','ị','ọ','ụ','ỵ','Ạ','Ẹ','Ị','Ọ','Ụ','Ỵ',
            'â','ê','ô','ư','Â','Ê','Ô','Ư',
            'ấ','ế','ố','ứ','Ấ','Ế','Ố','Ứ',
            'ầ','ề','ồ','ừ','Ầ','Ề','Ồ','Ừ',
            'ẩ','ể','ổ','ử','Ẩ','Ể','Ổ','Ử',
            'ậ','ệ','ộ','ự','Ậ','Ệ','Ộ','Ự'
        );
        $vietTo = array(
            'a','e','i','o','u','y','A','E','I','O','U','Y',
            'a','e','i','o','u','y','A','E','I','O','U','Y',
            'a','e','i','o','u','y','A','E','I','O','U','Y',
            'a','e','i','o','u','y','A','E','I','O','U','Y',
            'a','e','i','o','u','y','A','E','I','O','U','Y',
            'a','e','o','u','A','E','O','U',
            'a','e','o','u','A','E','O','U',
            'a','e','o','u','A','E','O','U',
            'a','e','o','u','A','E','O','U',
            'a','e','o','u','A','E','O','U'
        );

        $from = array_merge($from, $cyrylicFrom, $vietFrom);
        $to   = array_merge($to, $cyrylicTo, $vietTo);

        $newstring=str_replace($from, $to, $string);
        return $newstring;
    }

    public static function makeSlugs($string, $maxlen=0)
    {
        $newStringTab=array();
        $string=strtolower(self::noDiacritics($string));
        if(function_exists('str_split'))
        {
            $stringTab=str_split($string);
        }
        else
        {
            $stringTab=self::my_str_split($string);
        }

        $numbers=array("0","1","2","3","4","5","6","7","8","9","-");
        //$numbers=array("0","1","2","3","4","5","6","7","8","9");

        foreach($stringTab as $letter)
        {
            if(in_array($letter, range("a", "z")) || in_array($letter, $numbers))
            {
                $newStringTab[]=$letter;
                //print($letter);
            }
            elseif($letter==" ")
            {
                $newStringTab[]="-";
            }
        }

        if(count($newStringTab))
        {
            $newString=implode($newStringTab);
            if($maxlen>0)
            {
                $newString=substr($newString, 0, $maxlen);
            }

            $newString = self::removeDuplicates('--', '-', $newString);
        }
        else
        {
            $newString='';
        }

        return $newString;
    }


    protected function checkSlug($sSlug)
    {
        if(preg_match ("/^[a-zA-Z0-9]+[a-zA-Z0-9\_\-]*$/", $sSlug))
        {
            return true;
        }

        return false;
    }

    protected function removeDuplicates($sSearch, $sReplace, $sSubject)
    {
        $i=0;
        do{

            $sSubject=str_replace($sSearch, $sReplace, $sSubject);
            $pos=strpos($sSubject, $sSearch);

            $i++;
            if($i>100)
            {
                die('removeDuplicates() loop error');
            }

        }while($pos!==false);

        return $sSubject;
    }

}