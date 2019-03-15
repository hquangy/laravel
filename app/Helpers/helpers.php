<?php
use Carbon\Carbon;
use Illuminate\Support\Str;

// datetime
function date_ft($date)
{
    return date('d/m/Y', strtotime($date));
}

function date_ft_full($date)
{
    return date('d/m/Y H:i:s', strtotime($date));
}

function diffForHumans($date)
{
    return Carbon::createFromTimeStamp(strtotime($date))->diffForHumans();
}

function diffForHumansVN($date, $last_word = 'trước')
{
    $date_diff = diffForHumans($date);

    $date_diff = str_replace([' seconds ago', ' second ago'], ' giây '.$last_word, $date_diff);
    $date_diff = str_replace([' minutes ago', ' minute ago'], ' phút '.$last_word, $date_diff);
    $date_diff = str_replace([' hours ago', ' hour ago'], ' giờ '.$last_word, $date_diff);
    $date_diff = str_replace([' days ago', ' day ago'], ' ngày '.$last_word, $date_diff);
    $date_diff = str_replace([' months ago', ' month ago'], ' tháng '.$last_word, $date_diff);

    if (preg_match('(years|year)', $date_diff)) {
        $date_diff = date_ft($date);
    }

    return $date_diff;
}

/*
    show date like: Thứ sáu, ngày 12/2/2017
*/
function getDateVN($date)
{
    $search  = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
    $replace = ['Chủ nhật', 'Thứ hai', 'Thứ ba','Thứ tư','Thứ năm','Thứ sáu', 'Thứ bảy'];
    $day = date('D', strtotime($date));
    return str_replace($search, $replace , $day) . ', ngày ' . date('d/m/Y', strtotime($date));
}

// string
if (!function_exists('mb_ucwords'))
{
    function mb_ucwords($str)
    {
        return mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
    }
}

function mb_ucfirst($string, $encoding = 'UTF-8')
{
    $string = mb_strtolower($string);
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);

    return mb_strtoupper($firstChar, $encoding).$then;
}

if (!function_exists('mb_ucwords'))
{
    function mb_ucwords($str)
    {
        return mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
    }
}

function removeTag($str, $tag) 
{
    $str = preg_replace("#\<".$tag."(.*)/".$tag.">#iUs", "", $str);
    return $str;
}

function getFileInfo($file)
{
    $path_parts = pathinfo('/www/htdocs/inc/lib.inc.php');
    $path_parts = pathinfo($file);
    echo $path_parts['dirname'], "\n";
    echo $path_parts['basename'], "\n";
    echo $path_parts['extension'], "\n";
    echo $path_parts['filename'], "\n"; // since PHP 5.2.0
}

function getIdFormUrl($url)
{
    $needle =  explode('-',explode('.', $url)[0]);

    $id = $needle[count($needle)-1];
    unset($needle[count($needle) - 1]);
    $slug = implode($needle, '-');
    return 
    [
        'slug' => $slug,
        'id' => $id,
    ];
}

function word_limit($string, $length = 20, $extension = '...')
{
    return strip_tags(Str::words($string, $length, $extension));
}

function word_limit_striptag($string, $length = 10, $extension = '...')
{
    return Str::words(strip_tags($string, '<p></p>'), $length, $extension);
}

function eclean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}