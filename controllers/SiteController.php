<?php

namespace app\controllers;

use app\models\StaffSalary;
use app\models\StaffSalaryExtras;
use app\models\User;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use yii\helpers\Json;


//include_once('../../staff/job.class.php');

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
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
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    // public function actionEditExpand()
    // {
    //     echo print_r(155,true);
    //     exit();
    // }

    public function actionExpandView()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        // your default model and dataProvider generated by gii
        $searchModel = new StaffSalaryExtras;
        $id_salary = Yii::$app->request->post('expandRowKey');
        $dataProvider = $searchModel->search($id_salary);

        $searchModel -> addLog($id_salary, " открыты детали смены", "expand");

//        $log = [
//            'StaffSalaryExtras' => [
//                'id_salary' => $id_salary,
//                'id_staff' => Yii::$app->user->identity->id_staff,
//                'datetime' => date('Y-m-d H:i:s'),
//                'comment' => Yii::$app->user->identity->last_name . ' '. Yii::$app->user->identity->first_name . ' открыл детали смены',
//                'type' => 'edit',
//            ]
//        ];
//
//        if ($searchModel->load($log)) {
//            // can save model or do something before saving model
//            $searchModel->save();
//        }

        return $this->renderAjax('expand-view', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionExpandWindowView()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $id_salary = Yii::$app->request->get('id_salary');
        $salary = StaffSalary::find()->where([
            'id_salary' => $id_salary,
        ])->one();


        // your default model and dataProvider generated by gii
        $searchSalaryModel = new StaffSalaryExtras;
        $dataProvider = $searchSalaryModel->searchSmallPagination($id_salary);

        $searchSalaryModel -> addLog($id_salary, " открыты детали смены", "expand");

//        $log = [
//            'StaffSalaryExtras' => [
//                'id_salary' => $id_salary,
//                'id_staff' => Yii::$app->user->identity->id_staff,
//                'datetime' => date('Y-m-d H:i:s'),
//                'comment' => Yii::$app->user->identity->last_name . ' '. Yii::$app->user->identity->first_name . ' открыл детали смены',
//                'type' => 'edit',
//            ]
//        ];
//
//        if ($searchModel->load($log)) {
//            // can save model or do something before saving model
//            $searchModel->save();
//        }

        $this->layout = 'withoutNavBar';
        return $this->renderAjax('expand-view', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchSalaryModel,
            'id_salary' => $id_salary,
            'id_staff' => $salary->id_staff,
        ]);
    }
    

    public function actionGrid()
    {                        
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = new User();

     //   echo '<pre>';
     //   VarDumper::dump($user->getPermissions());

        // your default model and dataProvider generated by gii
        $searchModel = new StaffSalary();
//
//       VarDumper::dump(Yii::$app->request->isAjax);
//       VarDumper::dump(Yii::$app->request->isPost);
//       VarDumper::dump(Yii::$app->request);
        $hasEditable = Yii::$app->request->post('hasEditable');

        if (Yii::$app->request->isAjax && !$hasEditable) {

            $id_salary = Yii::$app->request->post('id_salary');
            $post = ['StaffSalary' => $_POST];
            $model = StaffSalary::findOne($id_salary);

            if ($model->load($post)) {

                foreach ($model->attributes as $key => $val){
                   if($model->isAttributeChanged($key)) {
                        //$model->getAttributeLabel($key);
                        $old = $model->oldAttributes[$key];
                        StaffSalaryExtras::addLog($id_salary, " изменено [".$model->getAttributeLabel($key).'] с '.$old.' на '.$val);
                   }
                }

                $model->save();
                //getAttributeLabel();
                // can save model or do something before saving model
            }

            $errors = false;
            
            if ($model->hasErrors()) {
                $errors = $model->errors;
                if ($errors) {
                    foreach ($errors as $key => $errors_by_col) {
                        foreach ($errors_by_col as $line) {
                            $text[] = '<b>'.$key.'</b>: '.$line;
                        }
                    }
                    $text = implode("<br>", $text). $get;
                }
                $out = Json::encode(['error'=>$text]);
            }else {
                $out = Json::encode(['success'=>true]);
            }
            //VarDumper::dump( $errors);

            //Yii::$app->session->setFlash('success', '2CUSTOM TITLE | noty success'.rand(1,1000));
//            echo '<pre>';
//            VarDumper::dump( $post);
//            VarDumper::dump( $errors, 3 , true);
//            VarDumper::dump( $model, 3 , true);
//            echo '</pre>';
//
//            exit;

            //$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
            return $out;

            return $this->render('grid', [
                'dataProvider' => $dataProvider,
                'model' => $searchModel,
                'errors' => $errors,
                'findOneModel' => $model->attributes
            ]);

        //    VarDumper::dump($_GET['StaffSalary']);
        }
        // validate if there is a editable input saved via AJAX
        else if ($hasEditable) {

            //$model = StaffSalary::find()->indexBy('id_staff'); // where `id` is your primary key
            //VarDumper::dump($model);
            //echo '<br><br><br>';

            // instantiate your book model for saving
            $id_salary = Yii::$app->request->post('editableKey');
            $model = StaffSalary::findOne($id_salary);

            // store a default json response as desired by editable
            $out = Json::encode(['output'=>'', 'message'=>'']);

            // fetch the first entry in posted data (there should only be one entry
            // anyway in this array for an editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
/*
            VarDumper::dump( $id_salary);
            echo '<br><br><br>';

            VarDumper::dump( $_POST);
            echo '<br><br><br>';
*/
            //VarDumper::dump( $model);
            //echo '<br><br><br>';

            $posted = current($_POST['StaffSalary']);
            $post = ['StaffSalary' => $posted];
            //VarDumper::dump( $post);

            // load model like any single model validation
            if ($model->load($post)) {

                foreach ($model->attributes as $key => $val){
                    if($model->isAttributeChanged($key)) {
                        //$model->getAttributeLabel($key);
                        $old = $model->oldAttributes[$key];
                        StaffSalaryExtras::addLog($id_salary, " изменено [".$model->getAttributeLabel($key).'] с '.$old.' на '.$val);
                    }
                }

                $model->save();

                // custom output to return to be displayed as the editable grid cell
                // data. Normally this is empty - whereby whatever value is edited by
                // in the input by user is updated automatically.
                $output = '';

                // specific use case where you need to validate a specific
                // editable column posted when you have more than one
                // EditableColumn in the grid view. We evaluate here a
                // check to see if buy_amount was posted for the Book model
                if (isset($posted['time_job_start'])) {
                    //  $output = $post[$editableAttribute];
                    $output = Yii::$app->formatter->asDate($posted['time_job_start'], 'php:H:i');
                }
                if (isset($posted['time_job_end'])) {
                    //  $output = $post[$editableAttribute];
                    $output = Yii::$app->formatter->asDate($posted['time_job_end'], 'php:H:i');
                }
                //elseif (isset($posted['buy_amount'])) {   // selective validation by attribute
                 //   $fmt = Yii::$app->formatter;
                 //   return $fmt->asDate($value, 'php:Y-m-d');// return formatted value if desired
                //}
                // similarly you can check if the name attribute was posted as well
                // if (isset($posted['name'])) {
                // $output = ''; // process as you need
                // }
                $out = Json::encode(['output'=>$output, 'message'=>'']);
            }
            // return ajax json encoded response and exit
            return $out;
        }
        else {
            $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
            // non-ajax - render the grid by default
            return $this->render('grid', [
                'dataProvider' => $dataProvider,
                'model' => $searchModel
            ]);
        }
        //return $this->render('grid');
    }
    
    public function actionRasp()
    {                        
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        return $this->render('rasp');
    }
}
