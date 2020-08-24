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
        if (empty(Yii::$app->request->get('page'))) {
            unset($_COOKIE['selectedRowsOnPages']);
            setcookie('selectedRowsOnPages', null, -1, '/');
        }

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

        //return true;

        $downloadType = Yii::$app->request->post('download_type');
        $filename = Yii::$app->request->post('filename');
        $data = Yii::$app->request->post();
        $id_staff = $data['FilesSearch']['id_staff'];
        $selectedFilesIdsNotDecoded = json_decode(Yii::$app->request->post('selectionArray'));
        $selectedFilesIds = [];

<<<<<<< Updated upstream
        if (!empty($id_staff)) {
            if (!empty($selectedFilesIdsNotDecoded)) {
                foreach ($selectedFilesIdsNotDecoded as $notDecodedFileId) {
                    if (current(get_object_vars($notDecodedFileId)) == true) {
                        $selectedFilesIds[] = key(get_object_vars($notDecodedFileId));
                    }
=======
        if (!empty($selectedFilesIdsNotDecoded) && !empty($downloadType)) {
            foreach ($selectedFilesIdsNotDecoded as $notDecodedFileId) {
                if (current(get_object_vars($notDecodedFileId)) == true) {
                    $selectedFilesIds[] = key(get_object_vars($notDecodedFileId));
>>>>>>> Stashed changes
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
                    $savePath = $this->mergeFiles($selectedFiles, $filename, $id_staff);
                } elseif ($downloadType == 2) {
                    $savePath = $this->makeArchiveOfFiles($selectedFiles);
                }

                return \Yii::$app->response->sendFile($savePath);
            } else {
                return $this->redirect(['index']);
            }
        } else {

                return $this->redirect(['index', 'error' => 'Вы не указали пользователя. Введите фамилию в колонке "ФИО"']);
        }
    }

    protected function mergeFiles($selectedFiles, $filename, $id_staff)
    {
        $filesPaths = [];
        $date = date('Y-m-d H:i:s');
        $filenameServer = uniqid($more_entropy = true);

        if (empty($filename)) {
            $filename = uniqid($more_entropy = true);
        }

        foreach ($selectedFiles as $file) {
            exec('libreoffice --convert-to pdf "'.Yii::getAlias('@webroot') . $file->file.'" --outdir  "'.Yii::getAlias('@webroot') .'"/uploads/FilesFiles/');
            
            $arrayfileNamePDF = explode(".", $file->file);
            $arrayfileNamePDF[1] = 'pdf';
            $fileNamePDF = implode(".", $arrayfileNamePDF);
            
            $filesPaths[] = Yii::getAlias('@webroot') . $fileNamePDF;
        }

        $savePath = Yii::getAlias('@webroot') . "/uploads/FilesFiles/MergedPDF/" . $filenameServer . ".pdf";
        $modelName = "/uploads/FilesFiles/MergedPDF/" . $filenameServer . ".pdf";

        $pdf = new \Clegginabox\PDFMerger\PDFMerger;

        foreach ($filesPaths as $path) {

            $pdf->addPDF($path, 'all');
        }

        // echo print_r($filesPaths, true);
        // exit();

        $pdf->merge('file', $savePath); // generate the file

        foreach ($filesPaths as $path) {

            unlink($path);
        }

        $data = [
            'id_staff' => $id_staff,
            'type' => 'pdf',
            'datetime' => $date,
            'file' => $modelName,
            'header' => $filename,
            'comment' => 'Объединение из docx',
        ];

        $model = Files::createFiles($data);

        // $model->id_staff = $id_staff;
        // $model->type = 'pdf';
        // $model->datetime = $date;
        // $model->file = $modelName;
        // $model->header = $filename;
        // $model->comment = 'Объединение из docx';

        $model->save();

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
