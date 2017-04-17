<?php
namespace app\controllers\user;

use dektrium\user\controllers\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    public function actionDelete($id)
    {
        var_dump($id); die();
    }
}  ?>
