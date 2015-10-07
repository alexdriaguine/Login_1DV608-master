<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-02
 * Time: 18:38
 */

namespace controller;


class RegisterController {

    private $registerModel;
    private $registerView;

    public function __construct(\model\RegisterModel $registerModel, \view\RegisterView $registerView) {
        $this->registerModel = $registerModel;
        $this->registerView = $registerView;
    }

    public function doRegisterAction() {
        if ($this->registerView->userPressedRegister()) {
            $registrationCredentials = $this->registerView->getRegistrationCredentials();
            $this->registerView->reloadPage();
        }
    }

    public function getView() {
        return $this->registerView;
    }
}