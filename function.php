<?php

/**
 * wordParse 
 * receive one section of html and return all separated words
 * @param string $html 
 * @access public
 * @return array
 */
function wordParse($html) {
    if (!is_string($html)) {
        exit('bad param '.$html);
    }

    /**
     *  strip html tags
     */
    $stripedSource = strip_tags($html);

    /**
     *  remove escape chars
     */
    $stripedSource = str_replace(
            array('&gt;','&lt;','&quot;','&amp;','&nbsp;'),
            array(' ', ' ', ' ', ' ', ' '),
            $stripedSource
            );


    /**
     *  strtolower
     */
    $stripedSource = strtolower($stripedSource);

    /**
     *  remove non a-z - breakLine chars
     */
    $stripedSource = preg_replace('/[^a-z-]/s',' ',$stripedSource);
    $arrSource = explode(' ', $stripedSource);
    /**
     *   arrPond  the => 3
     */
    $arrPond = array();


    foreach ($arrSource as $k => $v) {
        if (strlen($v) < 3) {
            // remove common word shorter than 3 chars such as a , an
            unset($arrSource[$k]);
        } else {
            if (isset($arrPond[$v])) {
                $arrPond[$v] = $arrPond[$v]+1;
            } else {
                $arrPond[$v] = 1;
            }
        }
    }

    return $arrPond;

}

