<?php

namespace app\controllers;

use Yii;
use app\models\Files;
use app\models\FilesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use DocxMerge\DocxMerge;

/**
 * FilesController implements the CRUD actions for Files model.
 */
class FilesController extends Controller
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
     * Lists all Files models.
     * @return mixed
     */
    public function actionIndex($error = '')
    {
        $data = '';

        $searchModel = new FilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (!empty($error)) {
            $data = $error;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'error' => $data,
        ]);
    }

    /**
     * Displays a single Files model.
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
     * Creates a new Files model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Files();
        $data = Yii::$app->request->post('Files');

        $currentTime = Files::getCurrentDateTime();

        if ($model->load($data,'') && $model->save()) {
            $model->temp_file = UploadedFile::getInstance($model, 'temp_file');

            if ($model->temp_file) {

                $nameUrl = '/uploads/FilesFiles/' . uniqid() . '.' . $model->temp_file->extension;

                $model->temp_file->saveAs(Yii::getAlias('@webroot') . $nameUrl);
                $model->file = $nameUrl;

                $model->temp_file = null;
            }

            $model->datetime = $currentTime;

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Files model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post('Files');

        $createTime = $model->datetime;

        if ($model->load($data, '') && $model->save()) {
            $model->temp_file = UploadedFile::getInstance($model, 'temp_file');

            if ($model->temp_file) {
                $nameUrl = '/uploads/FilesFiles/' . uniqid() . '.' . $model->temp_file->extension;

                $model->temp_file->saveAs(Yii::getAlias('@webroot') . $nameUrl);
                $model->file = $nameUrl;

                $model->temp_file = null;
            }

            $model->datetime = $createTime;

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Files model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDownloadFiles()
    {
        $savePath = '';

        $downloadType = Yii::$app->request->post('download_type');
        $filename = Yii::$app->request->post('filename');
        $selectedFilesIdsNotDecoded = json_decode(Yii::$app->request->post('selectionArray'));
        $selectedFilesIds = [];

        if (!empty($selectedFilesIdsNotDecoded)) {
            foreach ($selectedFilesIdsNotDecoded as $notDecodedFileId) {
                if (current(get_object_vars($notDecodedFileId)) == true) {
                    $selectedFilesIds[] = key(get_object_vars($notDecodedFileId));
                }
            }
            asort($selectedFilesIds);


            $selectedFiles = Files::find();

            foreach ($selectedFilesIds as $fileId) {
                $selectedFiles->orWhere(['id' => $fileId]);
            }

            $selectedFiles = $selectedFiles->all();

            foreach ($selectedFiles as $file) {
                if (strpos($file->file, '.doc') == false &&
                    strpos($file->file, '.docx') == false) {
                    $downloadType = 2;
                }
                if (!file_exists(Yii::getAlias('@webroot') . $file->file)) {
                    return $this->redirect(['index', 'error' => 'Файл ' . Yii::getAlias('@webroot') . $file->file . ' ' . 'не существует.']);
                }
            }

            if ($downloadType == 1) {
                $savePath = $this->mergeFiles($selectedFiles, $filename);
            } elseif ($downloadType == 2) {
                $savePath = $this->makeArchiveOfFiles($selectedFiles);
            }

            return \Yii::$app->response->sendFile($savePath);
        } else {
            return $this->redirect(['index']);
        }
    }

    protected function mergeFiles($selectedFiles, $filename)
    {
        $filesPaths = [];

        if (empty($filename)) {
            $filename = uniqid($more_entropy = true);
        }

        foreach ($selectedFiles as $file) {
            $filesPaths[] = Yii::getAlias('@webroot') . $file->file;
        }

        $savePath = Yii::getAlias('@webroot') . "/uploads/FilesFiles/MergedDocs/" . $filename . ".docx";


        //$dm = new DocxMerge();
        //$dm->merge( $filesPaths, $savePath );

        $docxMerge = \Jupitern\Docx\DocxMerge::instance()
            // add array of files to merge
            ->addFiles($filesPaths)
            // output filepath and pagebreak param
            ->save($savePath, true);

        return $savePath;
    }

    protected function makeArchiveOfFiles($selectedFiles)
    {
        $filesPaths = [];

        foreach ($selectedFiles as $file) {
            $oneFile = [];

            $oneFile['path'] = Yii::getAlias('@webroot') . $file->file;
            $oneFile['name'] = $file->header;

            $files[] = $oneFile;
        }

        $zipName = uniqid($more_entropy = true) .'.zip';
        $savePath = Yii::getAlias('@webroot') . "/uploads/FilesFiles/Archives/" . $zipName;

        $zip = new \ZipArchive();

        if ($zip->open($savePath, \ZipArchive::CREATE) !== TRUE) {
            exit("Невозможно открыть <$zipName>\n");
        }

        foreach ($files as $file) {
            if (!empty($file['name'])) {
                $localName = $file['name'] . '.docx';
            } else {
                $localName = uniqid($more_entropy = true) . '.docx';
            }

            $zip->addFile($file['path'], $localname = $localName);
        }

        $zip->close();

        return $savePath;
    }
    
    /**
     * Finds the Files model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Files the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Files::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
