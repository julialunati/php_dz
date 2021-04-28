<?php

namespace Project\Account\Controller;

use Project\Core\Controller\AbstractController;
use Project\Account\Model\OrderCollection;
use Project\Account\View\UserAccount;
use Project\Account\View\AdminAccount;
use Project\Account\Model\Auth;
 

class Account extends AbstractController
{
    public function indexAction()
    {
        $view = new UserAccount();
        $orderCollection = new OrderCollection();

        $view
            ->setData([
                'orders' => $orderCollection->getByAttribute(['user_id' => Auth::getUserId()])->getArray(),
                'login' => $_SESSION['login']
            ])
            ->show();;

        //если пользователь выходить из личного кабинета
        if (isset($_POST['logout'])) {
            unset($_SESSION['login']);
            header("Location: ../");
            exit();
        }
    }

    //админовский аккаунт
    public function AdminAction()
    {
        $view = new AdminAccount();
        $orderCollection = new OrderCollection();

        $view
            ->setData(
                [
                    'orders' => $orderCollection->getAll()->getArray(),
                    'login' => $_SESSION['login']
                ]
            )
            ->show();

        //если пользователь выходить из личного кабинета
        if (isset($_POST['logout'])) {
            unset($_SESSION['login']);
            header("Location: ../");
            exit();
        }
    }

    public function changeAction()
    {

        $req = new OrderCollection();
        // $obj = $_POST;
        $id = $_POST['id'];
        $status = $_POST['status'];
        if ($req->updateStatus($id, $status)) {
            echo json_encode(array('success' => 1));
        } else {
            echo json_encode(array('success' => 0));
        }
    }
}
