<?php 

function stripslashes_if_gpc_magic_quotes( $string ) {
    if(get_magic_quotes_gpc()) {
        return stripslashes($string);
    } else {
        return stripslashes($string);
    }
}


function PHP_slashes($string,$type='add')
{
    if ($type == 'add')
    {
        if (get_magic_quotes_gpc())
        {
            return $string;
        }
        else
        {
            if (function_exists('addslashes'))
            {
                return addslashes($string);
            }
            else
            {
                return mysql_real_escape_string($string);
            }
        }
    }
    else if ($type == 'strip')
    {
        return stripslashes($string);
    }
    else
    {
        die('error in PHP_slashes (mixed,add | strip)');
    }
}

?>