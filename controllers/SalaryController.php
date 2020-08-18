<?php

namespace app\controllers;

use Yii;
use app\models\Staff;
use app\models\StaffSalary;
use app\models\StaffSalarySearch;
use app\models\Docx;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use DocxMerge\DocxMerge;

use app\models\StaffSalaryExtras;
use app\models\User;

use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Response;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Salary;

use yii\helpers\Json;

/**
 * StaffSalaryController implements the CRUD actions for StaffSalary model.
 */
class SalaryController extends Controller
{
    public function behaviors() 
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all StaffSalary models.
     * @return mixed
     */
    public function actionIndex()
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

        $countSalaries = StaffSalary::find()
            ->where(['or', ['time_job_start_approve' => 0], ['time_job_end_approve' => 0], ['position_approve' => 0]])
            ->orWhere(['or', ['time_job_start_approve' => null], ['time_job_end_approve' => null], ['position_approve' => null]])
            // ->orWhere(['time_job_end_approve' => 0])
            // ->orWhere(['position_approve' => 0])
            ->count();

        if ($countSalaries != 0) {
            
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
                $dataProvider = $searchModel->searchNotApproved(Yii::$app->request->getQueryParams());
                // non-ajax - render the grid by default
                return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model' => $searchModel
                ]);
            }
            //return $this->render('grid');
        } elseif ($countSalaries == 0) {

            return $this->render('#', [
                'dataProvider' => $dataProvider,
                'model' => $searchModel
            ]);
        }
    }

    public function actionSalaryGrid()
    {
        $staffAllAndSalaries = [];

        $dateStart = Yii::$app->request->get('date_start') . ' ' . '00:00:00';
        $dateEnd = Yii::$app->request->get('date_end') . ' ' . '23:59:59';

        $staffAll = Staff::find()->select(['id_staff', 'last_name', 'first_name'])->all();

        foreach ($staffAll as $staff) {
            $staffAndSalaries = [];

            $salaries = StaffSalary::find()->where([
                'id_staff' => $staff->id_staff,
            ])
            ->andWhere([
                '>=', 'time_job_end', $dateStart
            ])
            ->andWhere([
                '<=', 'time_job_end', $dateEnd
            ])
            ->all();

            if (!empty($salaries)) {
                $staffAndSalaries['staff'] = $staff;
                $staffAndSalaries['salaries'] = $salaries;

                $staffAllAndSalaries[] = $staffAndSalaries;
            }
        }

        $staffAllAndSalary = [];

        foreach ($staffAllAndSalaries as $staffAndSalaries) {
            $staffAndSalary = [];

            $staffAndSalary['last_name'] = $staffAndSalaries['staff']->last_name;
            $staffAndSalary['first_name'] = $staffAndSalaries['staff']->first_name;
            $staffAndSalary['second_name'] = $staffAndSalaries['staff']->second_name;

            $summ = Salary::calculateSalary($staffAndSalaries['salaries']);

            $staffAndSalary['summ'] = round($summ);

            $staffAllAndSalary[] = $staffAndSalary;
        }

        return $this->render('salary-grid', [
            'staffAllAndSalary' => $staffAllAndSalary,
        ]);
    }

    public function actionEditApprove()
    {

        $editableKey = Yii::$app->request->post('editableKey');
        $editableIndex = Yii::$app->request->post('editableIndex');
        $editableAttribute = Yii::$app->request->post('editableAttribute');
        $data = Yii::$app->request->post('StaffSalary');

        $model = StaffSalary::findOne($editableKey);

        if ($editableAttribute == 'time_job_start_approve') {

            $model->time_job_start_approve = $data[$editableIndex]['time_job_start_approve'];
            $model->update();

            return $model->time_job_start_approve;
        } elseif ($editableAttribute == 'time_job_end_approve') {

            $model->time_job_end_approve = $data[$editableIndex]['time_job_end_approve'];
            $model->update();

            return $model->time_job_end_approve;
        } elseif ($editableAttribute == 'position_approve') {

            $model->position_approve = $data[$editableIndex]['position_approve'];
            $model->update();

            return $model->position_approve;
        }
    }


}
