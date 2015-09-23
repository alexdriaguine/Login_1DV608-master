<?php

namespace common;

class SessionHandler implements ILoginStateHandler, ITempMessageHandler {

    private static $isLoggedInName = "SessionHandler::IsLoggedIn";
    private static $messageKey = "SessionHandler::TempMessage";

    public function __construct() {
        session_start();
    }

    public function setMessage($value) {
        $this->setData(self::$messageKey, $value);
    }

    public function getMessage() {
        return $this->getAndUnset(self::$messageKey);
    }

    public function setLoggedIn() {
        $this->setData(self::$isLoggedInName, true);
    }

    public function getLoggedIn() {
        if ($this->exists(self::$isLoggedInName)) {
            return $this->getData(self::$isLoggedInName);
        }
        return false;
    }

    public function setLoggedOut() {
        $this->unsetData(self::$isLoggedInName);
    }

    private function setData($key, $value) {
        $_SESSION[$key] = $value;
    }

    private function getData($key) {
        if ($this->exists($key)) {
            return $_SESSION[$key];
        }
        return null;
    }

    private function unsetData($key) {
        if ($this->exists($key)) {
            unset($_SESSION[$key]);
        }
    }

    private function getAndUnset($key) {
        $tempData = $this->getData($key);
        $this->unsetData($key);
        return $tempData;
    }

    private function exists($key) {
        return isset($_SESSION[$key]);
    }

}