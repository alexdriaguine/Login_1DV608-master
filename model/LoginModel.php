<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-09-16
 * Time: 15:45
 */

namespace model;


class LoginModel {
    private static $username = "Admin";
    private static $password = "Password";
    private static $isLoggedInName = "isLoggedIn";

    public function authenticateUser(\model\User $user) {
        if ($user->getUsername() !== self::$username || $user->getPassword() !== self::$password)
            throw new \Exception("Wrong name or password");

        $this->loginUser();
    }

    private function loginUser() {
        // TODO: move session to view?? or own class maybe
        $_SESSION[self::$isLoggedInName] = true;
    }

    public function logoutUser() {
        // TODO: move session to view?? or own class maybe
        if (isset($_SESSION[self::$isLoggedInName])) {
            unset($_SESSION[self::$isLoggedInName]);
        }
    }

    public function userIsLoggedIn() {
        // TODO: move session to view?? or own class maybe
        if (isset($_SESSION[self::$isLoggedInName])) {
            return $_SESSION[self::$isLoggedInName];
        }
        return false;
    }
}