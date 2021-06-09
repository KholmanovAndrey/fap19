<?php

namespace app\controllers;

use app\models\Contact;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Product;
use app\models\Article;

class SiteController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'request-password-reset', 'reset-password'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['signup', 'request-password-reset', 'reset-password'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $last_product = Product::find()->with('category')->where(['publication' => 1])->orderBy('id DESC, position')->limit(8)->all();
        $about = Article::find()->where(['id' => 1, 'publication' => 1])->one();
        $last_article = Article::find()->where(['publication' => 1])->orderBy('id DESC, position')->limit(4)->all();

        return $this->render('index', compact('last_product', 'about', 'last_article'));
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Sign up action.
     *
     * @return Response|string
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset(){
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success',
                    'Проверьте электронную почту для получения дальнейших инструкций.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error',
                    'К сожалению, мы не можем сбросить пароль для электронной почты.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token){
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен.');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout(){
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact(){
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }

        $contact = Contact::findOne(1);

        return $this->render('contact', [
            'model' => $model,
            'contact' => $contact,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $about = Article::find()->where(['id' => 1, 'publication' => 1])->one();

        return $this->render('about', compact('about'));
    }

    public function actionAddAdmin() {
//        $model = User::find()->where(['username' => 'admin'])->one();
//        if (empty($model)) {
//            $user = new User();
//            $user->username = 'admin';
//            $user->email = 'admin@admin.ru';
//            $user->setPassword('admin');
//            $user->generateAuthKey();
//            if ($user->save()) {
//                Yii::$app->session->setFlash('success',
//                    "Пользователь $user->username добавлен.");
//                echo "Пользователь $user->username добавлен.";
//            }
//        }
    }

    public function actionRole(){
//        $role = Yii::$app->authManager->createRole('admin');
//        $role->description = 'Администратор';
//        Yii::$app->authManager->add($role);
//
//        $role = Yii::$app->authManager->createRole('content');
//        $role->description = 'Контент менеджер';
//        Yii::$app->authManager->add($role);
//
//        $role = Yii::$app->authManager->createRole('seller');
//        $role->description = 'Продавец';
//        Yii::$app->authManager->add($role);
//
//        $role = Yii::$app->authManager->createRole('shopper');
//        $role->description = 'Покупатель';
//        Yii::$app->authManager->add($role);
//
//        $role = Yii::$app->authManager->createRole('banned');
//        $role->description = 'Заблокированный пользователь';
//        Yii::$app->authManager->add($role);
//
//        $permit = Yii::$app->authManager->createPermission('canAdmin');
//        $permit->description = 'Право на вход в админку';
//        Yii::$app->authManager->add($permit);
//
//        $role_admin = Yii::$app->authManager->getRole('admin');
//        $role_content = Yii::$app->authManager->getRole('content');
//        $permit = Yii::$app->authManager->getPermission('canAdmin');
//        Yii::$app->authManager->addChild($role_admin, $permit);
//        Yii::$app->authManager->addChild($role_content, $permit);
//
//        $userRole = Yii::$app->authManager->getRole('admin');
//        Yii::$app->authManager->assign($userRole, 1);

        return 1111;
    }
}
