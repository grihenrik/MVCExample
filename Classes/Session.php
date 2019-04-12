<?php
/**
 * class for session handling
 *
 * @author turunent
 */
class Session
{
    public function __set($key, $val)
    {
        if (isset($key)&&!empty($key)){
            $_SESSION[$key] = $val;
        }
        return 0;
    }
    public function __get($key)
    {
        if (isset($key)&&array_key_exists($key,$_SESSION)){
            return $_SESSION[$key];
        }
        return 0;
    }
}
