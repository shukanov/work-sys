<?php

namespace app\controllers;

use http\Env\Request;
use Yii;
use app\models\Locations;
use app\models\StaffSearch;
use app\models\LocationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\UploadPhoto;

/**
 * LocationController implements the CRUD actions for Locations model.
 */
class LocationsController extends Controller
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
     * Lists all Locations models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LocationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Locations model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerStaff = new \yii\data\ArrayDataProvider([
            'allModels' => $model->staff,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerStaff' => $providerStaff,
        ]);
    }

    /**
     * Creates a new Locations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Locations();
        $providerStaff = new \yii\data\ArrayDataProvider([
            'allModels' => $model->staff,
        ]);
        $data = Yii::$app->request;

        if ($model->load($data->post())) {

            $model->images = UploadedFile::getInstance($model, 'images');

            if ($model->images) {

                $nameUrl = 'uploads/LocationsPhoto/' . $model->images->baseName . uniqid() . '.' . $model->images->extension;

                $model->images->saveAs($nameUrl);
                $model->photo = $nameUrl;

                $model->images = null;
            }


            $model->save();
            return $this->redirect(['view', 'id' => $model->id_location]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'providerStaff' => $providerStaff,
            ]);
        }
    }

    /**
     * Updates an existing Locations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $providerStaff = new \yii\data\ArrayDataProvider([
            'allModels' => $model->staff,
        ]);
        $data = Yii::$app->request->post('Locations');

        // return Yii::getAlias('@webpath');
        // exit();

        if ($model->load($data, '')) {

            $model->images = UploadedFile::getInstance($model, 'images');

            $nameUrl = 'uploads/LocationsPhoto/' . uniqid($more_entropy = true) . '.' . $model->images->extension;
            $model->images->saveAs($nameUrl);

            $model->photo = $nameUrl;

            $model->images = null;
            $model->update();

            return $this->redirect(['view', 'id' => $model->id_location]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'providerStaff' => $providerStaff,
            ]);
        }
    }

    /**
     * Deletes an existing Locations model.
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
     * Finds the Locations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Locations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Locations::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Action to load a tabular form grid
     * for Staff
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddStaff()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Staff');
            if (!empty($row)) {
                $row = array_values($row);
            }
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formStaff', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
