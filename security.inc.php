<?php

    /**
     * decode
     * 
     * @access public
     * @param  mixed $mixed
     * @return mixed
     */
    function decode($mixed)
    {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = decode($value);
            }
            return $mixed;
        }
        return html_entity_decode($mixed, ENT_QUOTES, 'UTF-8');
    }

    /**
     * encode
     * 
     * @see     <http://web.onassar.com/blog/2012/12/02/multibyte-error-with-character-set-encoding/>
     * @access public
     * @param  mixed $mixed
     * @return mixed
     */
    function encode($mixed)
    {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = encode($value);
            }
            return $mixed;
        }
        if (mb_check_encoding($mixed, 'ISO-8859-1')) {
            $mixed = iconv('ISO-8859-1', 'UTF-8', $mixed);
        }
        return htmlentities($mixed, ENT_QUOTES, 'UTF-8', false);
    }

    /**
     * slugify
     * 
     * Turns a string into a url-friendly string (alphabumeric).
     * 
     * @access public
     * @param  String $str
     * @param  Boolean $limit. (default: 100)
     * @param  Boolean $lowercase. (default: true)
     * @return String
     */
    function slugify($str, $limit = 100, $lowercase = true)
    {
        $str = decode($str);
        $str = trim($str);
        if ($lowercase === true) {
            $str = strtolower($str);
        }
        $str = str_replace('\'', '', $str);
        $str = str_replace('&amp;', '&', $str);
        $str = str_replace('&', '-and-', $str);
        $str = preg_replace('/[^a-zA-Z0-9-]/', ' ', $str);
        $str = str_replace('-', ' ', $str);
        $str = preg_replace('/[\s]{2,}/', ' ', $str);
        $str = trim($str);
        $str = str_replace(' ', '-', $str);
        $str = substr($str, 0, $limit);
        return $str;
    }
