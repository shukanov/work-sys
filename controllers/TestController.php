<?php

namespace app\controllers;
// a

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use DocxMerge\DocxMerge;
use Dompdf\Dompdf;

class TestController extends Controller
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
//        $dm = new DocxMerge();
//        $dm->merge( [
//            "/www/work-sys/htdocs/web/staff-salary/staff-salary-type-icons/kniga.docx",
//            "/www/work-sys/htdocs/web/staff-salary/staff-salary-type-icons/page_break.docx",
//            "/www/work-sys/htdocs/web/staff-salary/staff-salary-type-icons/album.docx"
//        ], "/tmp/result.docx" );

        $wordPdf = \PhpOffice\PhpWord\IOFactory::load("/www/work-sys/htdocs/web/staff-salary/staff-salary-type-icons/testDoc".".docx");

        //$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordPdf, 'HTML');

        //$objWriter->save("/www/work-sys/htdocs/web/staff-salary/staff-salary-type-icons/album".".html");
        //\PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        \PhpOffice\PhpWord\Settings::setPdfRendererPath(Yii::getAlias('@vendor') . '/mpdf/mpdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererName(\PhpOffice\PhpWord\Settings::PDF_RENDERER_MPDF);
        //\PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        //ini_set("pcre.backtrack_limit", "5000000");

        //$html = file_get_contents("/www/work-sys/htdocs/web/staff-salary/staff-salary-type-icons/album".".html");
        //$mpdf = new \Mpdf\Mpdf();
        //$mpdf->WriteHTML($html);
        //$mpdf->Output("/www/work-sys/htdocs/web/staff-salary/staff-salary-type-icons/albumCheck.pdf", 'F');

        $pdfWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordPdf , 'PDF');
        $pdfWriter->save("/www/work-sys/htdocs/web/staff-salary/staff-salary-type-icons/testDoc".".pdf");


//        $office = new OfficeToPdf(
//            "/www/work-sys/htdocs/web/staff-salary/staff-salary-type-icons/kniga.docx",
//            Yii::getAlias('@webroot') . '/staff-salary/staff-salary-type-icons/',
//            true);
//        $success_row = $office->convertToPdf();

        return \Yii::$app->response->sendFile("/www/work-sys/htdocs/web/staff-salary/staff-salary-type-icons/testDoc".".pdf");
    }

    public function actionRko() {
        $loadPath = Yii::getAlias('@webroot') . '/uploads/' . 'Template.docx';
        $savePath = Yii::getAlias('@webroot') . '/uploads/' . 'Template_full.docx';

        $PHPWord = new \PhpOffice\PhpWord\PhpWord();
        $document = $PHPWord->loadTemplate($loadPath); //шаблон
        $document->setValue('last_name', 'Никоненко'); //фамилия
        $document->setValue('first_name', 'Сергей');// имя
        $document->setValue('second_name', 'Васильевич');// отчество
        $document->setValue('salary', '12345678'); //зарплата
        $document->saveAs($savePath);

        return \Yii::$app->response->sendFile($savePath);
    }
}
