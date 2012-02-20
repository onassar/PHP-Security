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
        return htmlentities($mixed, ENT_QUOTES, 'UTF-8', false);
    }
