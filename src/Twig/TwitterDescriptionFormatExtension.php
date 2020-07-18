<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TwitterDescriptionFormatExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('twitterDescription', [$this, 'format']),
        ];
    }

    public function format($text)
    {
        //first remove all hashtags
        $description = preg_split('/#+[a-zA-Z0-9(_)]{1,} /', $text, -1, PREG_SPLIT_NO_EMPTY);
        $result = [];
        foreach($description as $str) {
            //then split string by newline
            $temp = explode("\n", $str);
            foreach ($temp as $string) {
                //foreach newline if we dont find urls then add it to results
                if (!preg_match("/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/", $string)) {
                   $result[] = $string;
                }
            }
        }
        //concat all results with \n and return
        $description = "";
        foreach($result as $string) {
            if ($string != "" || $string != " ") {
                $description = $description.$string."\n";
            }
        }

        return $description;
    }
}
