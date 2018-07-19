<?php
//namespace App\Helpers;

/*
|--------------------------------------------------------------------------
| Common global functions related to text processing
|--------------------------------------------------------------------------
|
| This file contains common global functions related to text processing
| in application wide
|
 */

if (!function_exists('formatUrlsInText')) {
    /**
     * Convert any URL in text to URL in tag A
     *
     * @author  xnohat
     *
     * @param   any $text
     * @return  $text but all url converted to tag A
     */

    function formatUrlsInText($text)
    {
        $text = preg_replace('$(https?://[a-z0-9_./?=&#-]+)(?![^<>]*>)$i', ' <a style="word-break: break-all" href="$1" target="_blank">$1</a> ', $text." ");
        $text = preg_replace('$(www\.[a-z0-9_./?=&#-]+)(?![^<>]*>)$i', '<a style="word-break: break-all" href="http://$1" target="_blank">$1</a> ', $text." ");

        return $text;            
    }
}

if (!function_exists('makeURLFromTitle')) {
    /**
     * Convert Post Title to URL friendly
     *
     * @author  xnohat
     *
     * @param   any $str
     * @return  friendly url string
     */

    function makeURLFromTitle($str)
    {
        $dungsan=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ"
        ,"ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ","ì","í","ị","ỉ","ĩ",
        "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
        ,"ờ","ớ","ợ","ở","ỡ",
        "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
        "ỳ","ý","ỵ","ỷ","ỹ",
        "đ",
        "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
        ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
        "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
        "Ì","Í","Ị","Ỉ","Ĩ",
        "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
        ,"Ờ","Ớ","Ợ","Ở","Ỡ",
        "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
        "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
        "Đ","ê","ù","à");

        $tohop=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ"
        ,"ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ","ì","í","ị","ỉ","ĩ",
        "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
        ,"ờ","ớ","ợ","ở","ỡ",
        "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
        "ỳ","ý","ỵ","ỷ","ỹ",
        "đ",
        "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
        ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
        "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
        "Ì","Í","Ị","Ỉ","Ĩ",
        "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
        ,"Ờ","Ớ","Ợ","Ở","Ỡ",
        "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
        "Ỳ","Ý","Ỵ","ỷ","Ỹ",
        "Đ","ê","ù","à");

        $khongDau=array("a","a","a","a","a","a","a","a","a","a","a"
        ,"a","a","a","a","a","a",
        "e","e","e","e","e","e","e","e","e","e","e",
        "i","i","i","i","i",
        "o","o","o","o","o","o","o","o","o","o","o","o"
        ,"o","o","o","o","o",
        "u","u","u","u","u","u","u","u","u","u","u",
        "y","y","y","y","y",
        "d",
        "A","A","A","A","A","A","A","A","A","A","A","A"
        ,"A","A","A","A","A",
        "E","E","E","E","E","E","E","E","E","E","E",
        "I","I","I","I","I",
        "O","O","O","O","O","O","O","O","O","O","O","O"
        ,"O","O","O","O","O",
        "U","U","U","U","U","U","U","U","U","U","U",
        "Y","Y","Y","Y","Y",
        "D","e","u","a");

        $specialchar = array(',','<','>',';','&','*','~','/','"','[',']','#','?','`','–','.',"'",'"','"','!','“','”',':','.'); // recheck when apply this rule, may conflict with standard URL because it trim all char like ? and # and /

        $str = str_replace($specialchar,'',$str); //strip special chars
        $str = str_replace($dungsan,$khongDau,$str); //strip Vietnamse unicode non-composite
        $str = str_replace($tohop,$khongDau,$str); //strip Vietnamse unicode composite
        $str = preg_replace("/[^ \w]+/", '', $str); //strip special chars - all non word and non space characters
        $str = preg_replace("/\s+/", ' ', $str); //strip double space
        $str = str_replace(" ","-",$str); // convert space to - char
        $str = preg_replace("#-+#", "-", $str); //sctrip double - -
        $str = convert_emoji_ascii($str); //convert emoji to ascii
        $str = strtolower($str); //lowercase URL
        if($str != ''){
            return $str;
        }else{ //if url make are null (ex: special char deleted all)
            return 'p';
        }
    }

}


if (!function_exists('makeHashTag')) {
    /**
     * Convert String to HashTag
     *
     * @author  xnohat
     *
     * @param   any $str
     * @return  string HashTag
     */

    function makeHashTag($str)
    {
        $dungsan=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ"
        ,"ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ","ì","í","ị","ỉ","ĩ",
        "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
        ,"ờ","ớ","ợ","ở","ỡ",
        "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
        "ỳ","ý","ỵ","ỷ","ỹ",
        "đ",
        "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
        ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
        "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
        "Ì","Í","Ị","Ỉ","Ĩ",
        "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
        ,"Ờ","Ớ","Ợ","Ở","Ỡ",
        "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
        "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
        "Đ","ê","ù","à");

        $tohop=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ"
        ,"ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ","ì","í","ị","ỉ","ĩ",
        "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
        ,"ờ","ớ","ợ","ở","ỡ",
        "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
        "ỳ","ý","ỵ","ỷ","ỹ",
        "đ",
        "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
        ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
        "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
        "Ì","Í","Ị","Ỉ","Ĩ",
        "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
        ,"Ờ","Ớ","Ợ","Ở","Ỡ",
        "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
        "Ỳ","Ý","Ỵ","ỷ","Ỹ",
        "Đ","ê","ù","à");

        $khongDau=array("a","a","a","a","a","a","a","a","a","a","a"
        ,"a","a","a","a","a","a",
        "e","e","e","e","e","e","e","e","e","e","e",
        "i","i","i","i","i",
        "o","o","o","o","o","o","o","o","o","o","o","o"
        ,"o","o","o","o","o",
        "u","u","u","u","u","u","u","u","u","u","u",
        "y","y","y","y","y",
        "d",
        "A","A","A","A","A","A","A","A","A","A","A","A"
        ,"A","A","A","A","A",
        "E","E","E","E","E","E","E","E","E","E","E",
        "I","I","I","I","I",
        "O","O","O","O","O","O","O","O","O","O","O","O"
        ,"O","O","O","O","O",
        "U","U","U","U","U","U","U","U","U","U","U",
        "Y","Y","Y","Y","Y",
        "D","e","u","a");

        $specialchar = array(',','<','>',';','&','*','~','/','"','[',']','#','?','`','–','_','.',"'",'"','"','!','“','”',':','.'); // recheck when apply this rule, may conflict with standard hashtag because it trim all char like ? and # and /

        $str = str_replace($specialchar,'',$str); //strip special chars
        $str = str_replace($dungsan,$khongDau,$str); //strip Vietnamse unicode non-composite
        $str = str_replace($tohop,$khongDau,$str); //strip Vietnamse unicode composite
        $str = preg_replace("/[^ \w]+/", '', $str); //strip special chars - all non word and non space characters
        $str = preg_replace("/\s+/", ' ', $str); //strip double space
        $str = str_replace(" ","_",$str); // convert space to - char
        $str = preg_replace("#_+#", "_", $str); //sctrip double - -
        $str = "#".strtolower($str); //lowercase hashtag
        return $str;
    }

}

if (!function_exists('convUnicode')) {
    /**
     * Convert content from Unicode Composite to Unicode
     *
     * @author  xnohat
     *
     * @param   any $str
     * @return  friendly url string
     */

    function convUnicode($str)
    {
        $dungsan=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ"
        ,"ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ","ì","í","ị","ỉ","ĩ",
        "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
        ,"ờ","ớ","ợ","ở","ỡ",
        "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
        "ỳ","ý","ỵ","ỷ","ỹ",
        "đ",
        "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
        ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
        "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
        "Ì","Í","Ị","Ỉ","Ĩ",
        "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
        ,"Ờ","Ớ","Ợ","Ở","Ỡ",
        "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
        "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
        "Đ","ê","ù","à");

        $tohop=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ"
        ,"ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ","ì","í","ị","ỉ","ĩ",
        "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
        ,"ờ","ớ","ợ","ở","ỡ",
        "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
        "ỳ","ý","ỵ","ỷ","ỹ",
        "đ",
        "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
        ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
        "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
        "Ì","Í","Ị","Ỉ","Ĩ",
        "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
        ,"Ờ","Ớ","Ợ","Ở","Ỡ",
        "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
        "Ỳ","Ý","Ỵ","ỷ","Ỹ",
        "Đ","ê","ù","à");

        return str_replace($tohop,$dungsan,$str);
    }

}


/** 
 * Truncates text.
 *
 * Cuts a string to the length of $length and replaces the last characters
 * with the ending if the text is longer than length.
 *
 * @param string $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
 * @return string Trimmed string.
 */
function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = false) {
 if ($considerHtml) {
  // if the plain text is shorter than the maximum length, return the whole text
  if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
   return $text;
  }

  // splits all html-tags to scanable lines
  preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

  $total_length = strlen($ending);
  $open_tags = array();
  $truncate = '';

  foreach ($lines as $line_matchings) {
   // if there is any html-tag in this line, handle it and add it (uncounted) to the output
   if (!empty($line_matchings[1])) {
    // if it’s an “empty element” with or without xhtml-conform closing slash (f.e.)
    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
    // do nothing
    // if tag is a closing tag (f.e.)
    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
     // delete tag from $open_tags list
     $pos = array_search($tag_matchings[1], $open_tags);
     if ($pos !== false) {
      unset($open_tags[$pos]);
     }
     // if tag is an opening tag (f.e. )
    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
     // add tag to the beginning of $open_tags list
     array_unshift($open_tags, strtolower($tag_matchings[1]));
    }
    // add html-tag to $truncate’d text
    $truncate .= $line_matchings[1];
   }

   // calculate the length of the plain text part of the line; handle entities as one character
   $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
   if ($total_length+$content_length > $length) {
    // the number of characters which are left
    $left = $length - $total_length;
    $entities_length = 0;
    // search for html entities
    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
     // calculate the real length of all entities in the legal range
     foreach ($entities[0] as $entity) {
      if ($entity[1]+1-$entities_length <= $left) {
       $left--;
       $entities_length += strlen($entity[0]);
      } else {
       // no more characters left
       break;
      }
     }
    }
    $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
    // maximum lenght is reached, so get off the loop
    break;
   } else {
    $truncate .= $line_matchings[2];
    $total_length += $content_length;
   }

   // if the maximum length is reached, get off the loop
   if($total_length >= $length) {
    break;
   }
  }
 } else {
  if (strlen($text) <= $length) {
   return $text;
  } else {
   $truncate = substr($text, 0, $length - strlen($ending));
  }
 }

 // if the words shouldn't be cut in the middle...
 if (!$exact) {
  // ...search the last occurance of a space...
  $spacepos = strrpos($truncate, ' ');
  if (isset($spacepos)) {
   // ...and cut the text in this position
   $truncate = substr($truncate, 0, $spacepos);
  }
 }

 // add the defined ending to the text
 $truncate .= $ending;

 if($considerHtml) {
  // close all unclosed html-tags
  foreach ($open_tags as $tag) {
   $truncate .= '';
  }
 }

return $truncate;

}



/**
 * Get human readable time difference between 2 dates
 *
 * Return difference between 2 dates in year, month, hour, minute or second
 * The $precision caps the number of time units used: for instance if
 * $time1 - $time2 = 3 days, 4 hours, 12 minutes, 5 seconds
 * - with precision = 1 : 3 days
 * - with precision = 2 : 3 days, 4 hours
 * - with precision = 3 : 3 days, 4 hours, 12 minutes
 * 
 * From: http://www.if-not-true-then-false.com/2010/php-calculate-real-differences-between-two-dates-or-timestamps/
 *
 * @param mixed $time1 a time (string or timestamp)
 * @param mixed $time2 a time (string or timestamp)
 * @param integer $precision Optional precision 
 * @return string time difference
 */
function get_date_diff( $time1, $time2, $precision = 2 ) {
  // If not numeric then convert timestamps
  if( !is_int( $time1 ) ) {
    $time1 = strtotime( $time1 );
  }
  if( !is_int( $time2 ) ) {
    $time2 = strtotime( $time2 );
  }
  // If time1 > time2 then swap the 2 values
  if( $time1 > $time2 ) {
    list( $time1, $time2 ) = array( $time2, $time1 );
  }
  // Set up intervals and diffs arrays
  $intervals = array( 'year', 'month', 'day', 'hour', 'minute', 'second' );
  $diffs = array();
  foreach( $intervals as $interval ) {
    // Create temp time from time1 and interval
    $ttime = strtotime( '+1 ' . $interval, $time1 );
    // Set initial values
    $add = 1;
    $looped = 0;
    // Loop until temp time is smaller than time2
    while ( $time2 >= $ttime ) {
      // Create new temp time from time1 and interval
      $add++;
      $ttime = strtotime( "+" . $add . " " . $interval, $time1 );
      $looped++;
    }
    $time1 = strtotime( "+" . $looped . " " . $interval, $time1 );
    $diffs[ $interval ] = $looped;
  }
  $count = 0;
  $times = array();
  foreach( $diffs as $interval => $value ) {
    // Break if we have needed precission
    if( $count >= $precision ) {
      break;
    }
    // Add value and interval if value is bigger than 0
    if( $value > 0 ) {
      if( $value != 1 ){
        $interval .= "s";
      }
      // Add value and interval to times array
      $times[] = $value . " " . $interval;
      $count++;
    }
  }
  // Return string with times
  return implode( ", ", $times );
}


/*
Convert new line character to P tag
*/
function nl2p($string, $line_breaks = true, $xml = true) {

$string = str_replace(array('<p>', '</p>', '<br>', '<br />'), '', $string);

// It is conceivable that people might still want single line-breaks
// without breaking into a new paragraph.
if ($line_breaks == true)
    return '<p>'.preg_replace(array("/([\n]{2,})/i", "/([^>])\n([^<])/i"), array("</p>\n<p>", '$1<br'.($xml == true ? ' /' : '').'>$2'), trim($string)).'</p>';
else 
    return '<p>'.preg_replace(
    array("/([\n]{2,})/i", "/([\r\n]{3,})/i","/([^>])\n([^<])/i"),
    array("</p>\n<p>", "</p>\n<p>", '$1<br'.($xml == true ? ' /' : '').'>$2'),

    trim($string)).'</p>'; 
}

/*
Remove all emoji icon in string
*/
function remove_emoji($text){
      return preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $text);
}


/**
 * Convert Emoji to Ascii and reverse
 *
 * @author  xnohat
 *
 * @param   any $text
 * @param   bool $reverseflag (from ascii to emoji)
 * @return  text with emoji converted to ascii (and in reverse) AND remove all non-convertable emoji
 */
function convert_emoji_ascii($text,$reverseflag = false){

    $ascii = array(    
    'o/'      ,
    '</3'     ,
    '<3'      ,
    '8-D'     ,
    '8D'      ,
    ':-D'     ,
    '=-3'     ,
    '=-D'     ,
    '=3'      ,
    '=D'      ,
    'B^D'     ,
    'X-D'     ,
    'XD'      ,
    'x-D'     ,
    'xD'      ,
    ':\')'    ,
    ':\'-)'   ,
    ':-))'    ,
    '8)'      ,
    ':)'      ,
    ':-)'     ,
    ':3'      ,
    ':D'      ,
    ':]'      ,
    ':^)'     ,
    ':c)'     ,
    ':o)'     ,
    ':}'      ,
    ':っ)'     ,
    '=)'      ,
    '=]'      ,
    '0:)'     ,
    '0:-)'    ,
    '0:-3'    ,
    '0:3'     ,
    '0;^)'    ,
    'O:-)'    ,
    '3:)'     ,
    '3:-)'    ,
    '}:)'     ,
    '}:-)'    ,
    '*)'      ,
    '*-)'     ,
    ':-,'     ,
    ';)'      ,
    ';-)'     ,
    ';-]'     ,
    ';D'      ,
    ';]'      ,
    ';^)'     ,
    ':-|'     ,
    ':|'      ,
    ':('      ,
    ':-('     ,
    ':-<'     ,
    ':-['     ,
    ':-c'     ,
    ':<'      ,
    ':['      ,
    ':c'      ,
    ':{'      ,
    ':っC'     ,
    '%)'      ,
    '%-)'     ,
    ':-P'     ,
    ':-b'     ,
    ':-p'     ,
    ':-Þ'     ,
    ':-þ'     ,
    ':P'      ,
    ':b'      ,
    ':p'      ,
    ':Þ'      ,
    ':þ'      ,
    ';('      ,
    '=p'      ,
    'X-P'     ,
    'XP'      ,
    'd:'      ,
    'x-p'     ,
    'xp'      ,
    ':-||'    ,
    ':@'      ,
    ':-.'     ,
    ':-/'     ,
    ':/'      ,
    ':L'      ,
    ':S'      ,
    ':\\'     ,
    '=/'      ,
    '=L'      ,
    '=\\'     ,
    ':\'('    ,
    ':\'-('   ,
    '^5'      ,
    '^<_<'    ,
    'o/\\o'   ,
    '|-O'     ,
    '|;-)'    ,
    ':###..'  ,
    ':-###..' ,
    'D-\':'   ,
    'D8'      ,
    'D:'      ,
    'D:<'     ,
    'D;'      ,
    'D='      ,
    'DX'      ,
    'v.v'     ,
    '8-0'     ,
    ':-O'     ,
    ':-o'     ,
    ':O'      ,
    ':o'      ,
    'O-O'     ,
    'O_O'     ,
    'O_o'     ,
    'o-o'     ,
    'o_O'     ,
    'o_o'     ,
    ':$'      ,
    '#-)'     ,
    ':#'      ,
    ':&'      ,
    ':-#'     ,
    ':-&'     ,
    ':-X'     ,
    ':X'      ,
    ':-J'     ,
    ':*'      ,
    ':^*'     ,
    'ಠ_ಠ'    ,
    '*\\0/*'  ,
    '\\o/'    ,
    ':>'      ,
    '>.<'     ,
    '>:('     ,
    '>:)'     ,
    '>:-)'    ,
    '>:/'     ,
    '>:O'     ,
    '>:P'     ,
    '>:['     ,
    '>:\\'    ,
    '>;)'     ,
    '>_>^'    ,
    );    

    $emoji = array(    
    '👋',
    '💔',
    '💗',
    '😁',
    '😁',
    '😁',
    '😁',
    '😁',
    '😁',
    '😁',
    '😁',
    '😁',
    '😁',
    '😁',
    '😁',
    '😂',
    '😂',
    '😃',
    '😄',
    '😄',
    '😄',
    '😄',
    '😄',
    '😄',
    '😄',
    '😄',
    '😄',
    '😄',
    '😄',
    '😄',
    '😄',
    '😇',
    '😇',
    '😇',
    '😇',
    '😇',
    '😇',
    '😈',
    '😈',
    '😈',
    '😈',
    '😉',
    '😉',
    '😉',
    '😉',
    '😉',
    '😉',
    '😉',
    '😉',
    '😉',
    '😐',
    '😐',
    '😒',
    '😒',
    '😒',
    '😒',
    '😒',
    '😒',
    '😒',
    '😒',
    '😒',
    '😒',
    '😖',
    '😖',
    '😜',
    '😜',
    '😜',
    '😜',
    '😜',
    '😜',
    '😜',
    '😜',
    '😜',
    '😜',
    '😜',
    '😜',
    '😜',
    '😜',
    '😜',
    '😜',
    '😜',
    '😠',
    '😠',
    '😡',
    '😡',
    '😡',
    '😡',
    '😡',
    '😡',
    '😡',
    '😡',
    '😡',
    '😢',
    '😢',
    '😤',
    '😤',
    '😤',
    '😫',
    '😫',
    '😰',
    '😰',
    '😱',
    '😱',
    '😱',
    '😱',
    '😱',
    '😱',
    '😱',
    '😱',
    '😲',
    '😲',
    '😲',
    '😲',
    '😲',
    '😲',
    '😲',
    '😲',
    '😲',
    '😲',
    '😲',
    '😳',
    '😵',
    '😶',
    '😶',
    '😶',
    '😶',
    '😶',
    '😶',
    '😼',
    '😽',
    '😽',
    '🙅',
    '🙆',
    '🙆',
    '😄',
    '😡',
    '😠',
    '😈',
    '😈',
    '😡',
    '😲',
    '😜',
    '😒',
    '😡',
    '😈',
    '😤',
     );

    if($reverseflag == false){
        return remove_emoji(str_replace($emoji,$ascii,$text));
    }else{
        return str_replace($ascii,$emoji,$text);
    }

}