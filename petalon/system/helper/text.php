<?php

class Helper_Text {

   /** ----------------------------------------------
   /** Limit number words in the string.
   /**
   /** @param   string  $string - String to trim
   /** @param   integer $limit - Limit number words
   /** @param   string  $ending - Ending the result string
   /** @return  string --- Return truncated string
   /** ----------------------------------------------*/
   static public function limitWords($string = NULL, $limit = NULL, $ending = '...')
   {
       $limit = (int) $limit;

       $words = preg_split('#(?<=\s|[\x{2000}-\x{200A}])#ue', $string);

       if (trim($string) === '' OR sizeof($words) <= $limit) {

           return $string;

       } else {

           $output = '';

           for ($i = 0; $i < $limit; $i++) {

               if ($i < $limit - 1) {

                   $output .= $words[$i] . ' ';

               } else {

                   $output .= $words[$i] . $ending;
               }
           }

           return $output;
       }
   }


   /** ----------------------------------------------
   /** Limit number characters in string without words crash.
   /**
   /** @param   string  $string - String to trim
   /** @param   integer $limit - Limit number characters
   /** @param   string  $ending - Ending the result string
   /** @return  string --- Return truncated string
   /** ----------------------------------------------*/
   static public function limitChars($string = NULL, $limit = NULL, $ending = '...')
   {
       $limit = (int) $limit;

       if (trim($string) === '' OR fUTF8::len($string) <= $limit) {

           return $string;

       } else {

	       $words      = preg_split('#(?<=\s|[\x{2000}-\x{200A}])#ue', $string);
           $word_count = sizeof($words);

		   $output     = '';
           $output_len = 0;

           for ($i = 0; $i < $word_count; $i++) {

               if ($output_len < $limit) {

                   $output    .= $words[$i];
                   $output_len = fUTF8::len($output);
		       }
		   }

           $output .= $ending;

		   return $output;
       }
   }


   private function __construct() { }

}