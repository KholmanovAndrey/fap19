<?php
/**
 * Created by PhpStorm.
 * User: Kholmanov
 * Date: 08.04.2019
 * Time: 18:58
 */

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class AppAdminController extends Controller {

    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'controllers' => ['user'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['canAdmin'],
                    ],
                ],
            ],
        ];
    }

}