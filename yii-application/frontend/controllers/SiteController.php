<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\FicharForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
     * @return mixed
     */
    public function actionIndex()
    {
    	
		 if (Yii::$app->user->isGuest) {
       		// return $this->redirect(['site/fichar']);
       		 return $this->redirect(['site/login']);
		 }
		 else {
			 return $this->redirect(['aviso/index']);
		 }
    }
	
	
	
	public function actionListin($estacion)
    {
    	
		\Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
		$connection = \Yii::$app->db; 
		$query = new \yii\db\Query; 
		$insql = $connection->createCommand("SELECT id, username, nombre, apellidos, movil, movilPersonal, a.codigoEstacion codigoEstacion FROM tickadas.fichajes f
		inner join (
		select idUser, max(fechaHora) fechaHora from fichajes where fechaHora between concat(CURDATE(), ' 00:00:00') AND CONCAT(CURDATE(), ' 23:59:59')    group by idUser
		)drvtbl on f.idUSer=drvtbl.idUSer and f.fechaHora=drvtbl.fechaHora 
		inner join asignar a on f.idUser=a.idUser 
		inner join user u on u.id = f.idUser
		where  f.idAccion<>2 and a.predeterminada = 1 " . ($estacion==''? "" : " and a.codigoEstacion =$estacion ") );  
		
		return $insql->queryAll();

/*
    	\Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
		
		$usuarios = User::find()->select(['id', 'username','nombre', 'apellidos', 'movil', 'movilPersonal'])->all();

		return $usuarios ;*/
    }	/**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionFichar()
    {

    	$model = new FicharForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->Fichar()) {
            	
            Yii::$app->user->login(User::findByUsername($model->username), 0);
			
			return $this->redirect(['aviso/index']);
            
        } else {
           return $this->render('index', [
                'model' => $model,
            ]);
        }
    }
	
	 /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionLoguedoIndex()
    {
    	return $this->redirect('aviso/index');
        //return $this->render('indexLogeado');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->render('indexLogueado', [
            //    'model' => $model,
            //]);
            return $this->redirect(['aviso/index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

       return $this->redirect(['site/fichar']);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
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
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
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
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
