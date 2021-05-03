<?php

namespace Project\User\Controller;

use Project\Core\Controller\AbstractController;
use Project\User\View\SignIn;
use Project\User\View\AuthErr;
use Project\User\Model\User as UserModel;

class User extends AbstractController
{
    public function IndexAction()
    {
        //отображение страницы аутентификации
        $view = new SignIn();
        $view->show();
        if (isset($_POST['enter'])) {
            //проверяется на уровне js (добавляется required в незаполненные поля и не возможности засабмитить если все не заполнено) 
            //но оставила для наглядности оставила данную проверку тоже
            if (isset($_POST['login']) && $_POST['login'] && isset($_POST['password']) && $_POST['password']) {
                $user = new UserModel();
                $userLogin['login'] = $_POST['login'];
                $userPassword = $_POST['password'];
                //проверка на наличе такого логина в БД (таким образом также чтоб избежать SQL-инъекций)
                // $allowedLogins[] = $user->getAllLogins('login');
                // if (!in_array($userLogin, $allowedLogins)){
                //     header("Location: ../loginerror/");
                // }
                $hash = $user->getHash($userLogin); 
                if (password_verify($userPassword, $hash)) {
                    $_SESSION['login'] = $userLogin['login'];
                    $_SESSION['user_id'] = $user->getId($userLogin);
                    if('admin' == $_SESSION['login']){
                        header("Location: ../admin/");
                        exit();
                    }else{
                        header("Location: ../account/");
                        exit();
                    }
                } else {
                    // throw new \Exception("The password or login is wrong");
                    header("Location: ../authenticationerror/");
                    exit();
                }
            } else {
                //не должен никогда выполниться 
                throw new \Exception("The password or login is missing");
            }
        }
    }

    public function AuthenticationErrorAction()
    {
        $view = new AuthErr();
        $view->setData(['message' => 'The password or login is wrong'])->show();
        //после прочтения сообщения у пользователя будет выбор попробовать ввести пароль еще раз или обратиться в HelpDesk
        exit();
    }

    public function LoginErrorAction()
    {
        $view = new AuthErr();
        $view->setData(['message' => 'There\'s no such login in our system '])->show();
        //после прочтения сообщения у пользователя будет выбор зарегистрироваться или обратиться в HelpDesk
        exit();
    }


}
