<?php

namespace controller;


use model\User;

class LoginController {

    private $loginModel;
    private $loginView;
    private $sessionModel;
    public function __construct(\model\LoginModel $loginModel, \model\SessionModel $sessionModel,
                                \view\LoginView $loginView) {
        $this->loginModel = $loginModel;
        $this->sessionModel = $sessionModel;
        $this->loginView = $loginView;
    }

    /**
     * @return bool - if the user is logged in or not
     */
    public function doLoginAction() {

        if ($this->loginModel->userIsLoggedIn() && $this->loginView->didUserPressLogout()) {
                $this->loginView->setMessage("Bye bye!", true);
                $this->loginModel->logoutUser();
        } else {
            if ($this->loginView->didUserPressLogin()) {
                try {
                    $user = $this->loginView->getUser();
                    $this->loginModel->authenticateUser($user);
                    $this->loginView->setMessage("Welcome", true);
                } catch(\UsernameMissingException $e) {
                    $this->loginView->setMessage($e->getMessage()); // TODO: change logic so view handles message output
                } catch(\PasswordMissingException $e) {
                    $this->loginView->setMessage($e->getMessage()); // TODO: change logic so view handles message output
                } catch (\WrongCredentialsException $e) {
                    $this->loginView->setMessage($e->getMessage()); // TODO: change logic so view handles message output
                }
            }
        }

        return $this->loginModel->userIsLoggedIn();
    }

    public function getView() {
        return $this->loginView;
    }


}