<?php

namespace app\controllers;

use Yii;
use app\models\StaffSalaryExtras;
use app\models\StaffSalaryExtrasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UrlManager;
use yii\helpers\Url;


/**
 * StaffSalaryExtrasController implements the CRUD actions for StaffSalaryExtras model.
 */
class StaffSalaryExtrasController extends Controller
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
     * Lists all StaffSalaryExtras models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StaffSalaryExtrasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all StaffSalaryExtras models.
     * @return mixed
     */
    public function actionIndexWithoutNavBar()
    {
        $searchModel = new StaffSalaryExtrasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $id_salary = Yii::$app->request->queryParams['id_salary'];

        $this->layout = 'withoutNavBar';

        $this->redirect(['site/expand-window-view', 'id_salary' => $id_salary]);
    }

    /**
     * Displays a single StaffSalaryExtras model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single StaffSalaryExtras model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewWithoutNavBar($id)
    {
        $model = $this->findModel($id);

        $this->layout = 'withoutNavBar';

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StaffSalaryExtras model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $data = Yii::$app->request->post('StaffSalaryExtras');

        $model = new StaffSalaryExtras();

        if ($model->load($data, '') && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_extra]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new StaffSalaryExtras model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateWithoutNavBar()
    {
        $data = Yii::$app->request->post('StaffSalaryExtras');

        $id_salary = Yii::$app->request->queryParams['id_salary'];
        $id_staff = Yii::$app->request->queryParams['id_staff'];
        $id_location = Yii::$app->request->queryParams['id_location'];

        $model = new StaffSalaryExtras();

        $this->layout = 'withoutNavBar';

        if ($model->load($data, '')) {
            $model->timestamp = date('Y-m-d H:i:s');
            if ($model->save()) {
                return $this->redirect(['view-without-nav-bar', 'id' => $model->id_extra, 'id_salary' => $model->id_salary]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'id_salary' => $id_salary,
                'id_staff' => $id_staff,
                'id_location' => $id_location,
            ]);
        }
    }

    /**
     * Updates an existing StaffSalaryExtras model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $data = Yii::$app->request->post('StaffSalaryExtras');

        $model = $this->findModel($id);

        $this->layout = 'withoutNavBar';

        if ($model->load($data, '') && $model->update()) {
            return $this->redirect(['view', 'id' => $model->id_extra]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdateWithoutNavBar($id)
    {
        $data = Yii::$app->request->post('StaffSalaryExtras');

        $model = $this->findModel($id);

        $this->layout = 'withoutNavBar';

        if ($model->load($data, '') && $model->update()) {
            return $this->redirect(['view-without-nav-bar', 'id' => $model->id_extra]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StaffSalaryExtras model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteWithoutNavBar($id)
    {
        $model = $this->findModel($id);
        $id_salary = $model->id_salary;

        $model->delete();

        $this->layout = 'withoutNavBar';

        return $this->redirect(['index-without-nav-bar', 'id_salary' => $id_salary]);
    }

    public function actionEditExpand()
    {
        $id_extra = Yii::$app->request->post('editableKey');
        $index = Yii::$app->request->post('editableIndex');
        $summ = Yii::$app->request->post('StaffSalaryExtras');

        $model = $this->findModel($id_extra);

        if (!empty($model)) {
            $model->summ = $summ[$index]['summ'];
            $model->update();
        }

        return $model->summ;
    }

    
    /**
     * Finds the StaffSalaryExtras model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StaffSalaryExtras the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StaffSalaryExtras::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
