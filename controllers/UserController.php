<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class UserController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionProfile()
    {
        $user = Yii::$app->user->identity;

        // устанавлеваем данные мета-тегов
        $this->setMeta('Профиль пользователя ' . $user->username,
            'Профиль пользователя ' . $user->username);

        return $this->render('profile', compact('user'));
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_at = time();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success',
                "Профиль № $model->id изменен.");

            return $this->redirect(['profile']);
        }

        $user = Yii::$app->user->identity;

        // устанавлеваем данные мета-тегов
        $this->setMeta('Редактировать пользователя ' . $user->username,
            'Редактировать пользователя ' . $user->username);

        return $this->render('update', compact('user'));
    }

    public function actionChangePassword($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->post() &&
            Yii::$app->request->post('password') === Yii::$app->request->post('password_confirm')) {

            $model->setPassword(Yii::$app->request->post('password'));
            $model->generateAuthKey();
            $model->updated_at = time();

            if ($model->save()) {
                Yii::$app->session->setFlash('success',
                    "Смена пароля № $model->id проведена успешно.");

                return $this->redirect(['profile']);
            }

            Yii::$app->session->setFlash('error',
                "Пароли не совпадают!");
        }

        $user = Yii::$app->user->identity;

        // устанавлеваем данные мета-тегов
        $this->setMeta('Сменить пароль ' . $user->username,
            'Сменить пароль ' . $user->username);

        return $this->render('change-password', compact('user'));
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}