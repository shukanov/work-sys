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

/**
 * StaffSalaryController implements the CRUD actions for StaffSalary model.
 */
class StaffSalaryController extends Controller
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
        $searchModel = new StaffSalarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('site/grid', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StaffSalary model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new StaffSalary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StaffSalary();
        $data = Yii::$app->request->post('StaffSalary');

        $staffList = Staff::getMapFullName();

        if ($model->load($data, '') && (($model->salary != 0) || ($model->rate != 0))) {

            if ($model->useSalary == true) {

                $model->rate = null;
            } else {

                $model->salary = null;
            }

            // echo print_r($model, true);
            // exit();

            if ($model->save()) {

                return $this->redirect(['view', 'id' => $model->id_salary]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'staffList' => $staffList,
            ]);
        }
    }

    /**
     * Updates an existing StaffSalary model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post('StaffSalary');

        if ($model->load($data, '')) {

            if ($model->useSalary == true) {

                $model->rate = null;
            } else {

                $model->salary = null;
            }

            if ($model->update()) {

                return $this->redirect(['view', 'id' => $model->id_salary]);
            }
            
            return var_dump($model->errors);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StaffSalary model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        $model = $this->findModel($id);

        $model->is_deleted = 1;
        $model->update();

        return $this->redirect(['site/grid']);
    }

    public function actionRestore($id)
    {
        // $this->findModel($id)->delete();
        $model = $this->findModel($id);

        $model->is_deleted = 0;
        $model->update();

        return $this->redirect(['site/grid']);
    }

    public function actionDownloadFiles()
    {
        $dm = new DocxMerge();

        Docx::merge([
            "/www/work-sys/htdocs/web/staff-salary/staff-salary-type-icons/1.docx",
            "/www/work-sys/htdocs/web/staff-salary/staff-salary-type-icons/2.docx",
        ], Yii::getAlias('@webroot') . "/staff-salary/staff-salary-type-icons/3.docx");

        // $typeOfDownload = Yii::$app->request->post('downloadType');
        // $selectedSalaryIds = Yii::$app->request->post('selection');

        // $selectedSalary = StaffSalary::find();

        // foreach($selectedSalaryIds as $id) {
        //     $selectedSalary = $selectedSalary->orWhere(['=', 'id_salary', $id]);
        // }

        // $selectedSalary = $selectedSalary->all();

        //echo print_r($selectedSalary, true);
        //exit();

        return Yii::$app->response->sendFile(Yii::getAlias('@webroot') . "/staff-salary/staff-salary-type-icons/merged1.docx");
    }

    
    /**
     * Finds the StaffSalary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StaffSalary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StaffSalary::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
