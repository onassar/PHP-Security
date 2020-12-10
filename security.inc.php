<?php

    /**
     * convertEncoding
     * 
     * Converts from one specific encoding to another.
     * 
     * @related <http://web.onassar.com/blog/2012/12/02/multibyte-error-with-character-set-encoding/>
     * @access  public
     * @param   mixed $mixed
     * @param   string $from
     * @param   string $to (default: UTF-8)
     * @return  mixed
     */
    function convertEncoding($mixed, $from, $to = 'UTF-8')
    {
        if (is_array($mixed) === true) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = convert($value, $from, $to);
            }
            return $mixed;
        }
        return mb_convert_encoding($mixed, $to, $from);
    }

    /**
     * decode
     * 
     * @see     http://php.net/manual/en/function.get-html-translation-table.php#73410
     * @note    In PHP 5.4.x, can use get_html_translation_table along with
     *          ENT_HTML5 for more robust decoding (eg. &apos; entity)
     * @access  public
     * @param   mixed $mixed
     * @return  mixed
     */
    function decode($mixed)
    {
        if (is_array($mixed) === true) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = decode($value);
            }
            return $mixed;
        }
        $decoded = html_entity_decode($mixed, ENT_QUOTES, 'UTF-8');
        return str_replace(
            array('&apos;'),
            array('\''),
            $decoded
        );
    }

    /**
     * encode
     * 
     * @access  public
     * @param   mixed $mixed
     * @param   bool $doubleEncode (default: true)
     * @return  mixed
     */
    function encode($mixed, $doubleEncode = true)
    {
        if (is_array($mixed) === true) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = encode($value, $doubleEncode);
            }
            return $mixed;
        }
        return htmlentities($mixed, ENT_QUOTES, 'UTF-8', $doubleEncode);
    }

    /**
     * encodeURIComponent
     * 
     * @see     http://stackoverflow.com/questions/1734250/what-is-the-equivalent-of-javascripts-encodeuricomponent-in-php
     * @access  public
     * @param   string $str
     * @return  string
     */
    function encodeURIComponent($str) {
        $revert = array(
            '%21'=>'!',
            '%2A'=>'*',
            '%27'=>"'",
            '%28'=>'(',
            '%29'=>')'
        );
        return strtr(rawurlencode($str), $revert);
    }

    /**
     * slugify
     * 
     * Turns a string into a URL-friendly string (alphanumeric), ignoring
     * non-english characters (for now).
     * 
     * @access  public
     * @param   string $str
     * @param   bool $limit. (default: 100)
     * @param   bool $lowercase. (default: true)
     * @return  string
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
