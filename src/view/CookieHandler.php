<?php

namespace view;


class CookieHandler {

    public function setCookie($name, $value, $expiresIn) {
        assert(is_string($name));
        assert(is_string($value));
        assert(is_int($expiresIn));


        setcookie($name, $value, time() + 60);
    }

    public function getCookie($name) {
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }
        return null;
    }

    public function deleteCookie($name) {
        if (isset($_COOKIE[$name])) {
            unset($_COOKIE[$name]);
            setcookie($name, null, -1);
        }
    }
}