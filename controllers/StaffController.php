<?php

namespace app\controllers;

use Yii;
use app\models\Staff;
use app\models\StaffSalary;
use app\models\StaffSearch;
use app\models\FilesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * StaffController implements the CRUD actions for Staff model.
 */
class StaffController extends Controller
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
     * Lists all Staff models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Staff model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $searchModel = new FilesSearch();
        $dataProvider = $searchModel->searchStaff(Yii::$app->request->queryParams, $id);
        
        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Staff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $data = Yii::$app->request->post('Staff');

        $model = new Staff();

        if ($model->load($data, '') && $model->save()) {
            $model->passport_first_page_file = UploadedFile::getInstance($model, 'passport_first_page_file');
            $model->passport_second_page_file = UploadedFile::getInstance($model, 'passport_second_page_file');

            if ($model->passport_first_page_file) {

                $nameUrl = 'uploads/StaffPhoto/PassportFirstPages/' . uniqid() . '.' . $model->passport_first_page_file->extension;

                $model->passport_first_page_file->saveAs($nameUrl);
                $model->passport_first_page = $nameUrl;

                $model->passport_first_page_file = null;
            }

            if ($model->passport_second_page_file) {

                $nameUrl = 'uploads/StaffPhoto/PassportSecondPages/' . uniqid() . '.' . $model->passport_second_page_file->extension;

                $model->passport_second_page_file->saveAs($nameUrl);
                $model->passport_second_page = $nameUrl;

                $model->passport_second_page_file = null;
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id_staff]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Staff model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $data = Yii::$app->request->post('Staff');

        $model = $this->findModel($id);
        $searchModel = new FilesSearch();
        $dataProvider = $searchModel->searchStaff(Yii::$app->request->queryParams, $id);

        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]); 

        if (!empty($data)) {
            if ($model->load($data, '') && $model->update()) {
                $model->passport_first_page_file = UploadedFile::getInstance($model, 'passport_first_page_file');
                $model->passport_second_page_file = UploadedFile::getInstance($model, 'passport_second_page_file');

                if ($model->passport_first_page_file) {

                    $nameUrl = 'uploads/StaffPhoto/PassportFirstPages' . uniqid() . '.' . $model->passport_first_page_file->extension;

                    $model->passport_first_page_file->saveAs($nameUrl);
                    $model->passport_first_page = $nameUrl;

                    $model->passport_first_page_file = null;
                }

                if ($model->passport_second_page_file) {

                    $nameUrl = 'uploads/StaffPhoto/PassportSecondPages' . uniqid() . '.' . $model->passport_second_page_file->extension;

                    $model->passport_second_page_file->saveAs($nameUrl);
                    $model->passport_second_page = $nameUrl;

                    $model->passport_first_page_file = null;
                }

                $model->save();
                return $this->redirect(['view', 'id' => $model->id_staff]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Deletes an existing Staff model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the Staff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Staff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Staff::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
