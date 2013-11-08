<?php defined('SYSPATH') OR die('No direct script access.');

class Cookie extends Kohana_Cookie {
                
        public static function set($name, $value, $expiration = NULL) {
                if (Kohana::$environment == Kohana::TESTING) {
                        Request::initial()->cookie($name, $value);
                } else {
                        return parent::set($name, $value, $expiration);
                }
        }

}
