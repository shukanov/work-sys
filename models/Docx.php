<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Docx extends Model
{
    public static function merge($filesPath, $mergeFilePath)
    {
        $mergedTbsZip = new TbsZip();
        $mergedTbsZip->Open($filesPath[0]);
        
        $content = $mergedTbsZip->FileRead('word/document.xml');
        $positionEnd = strpos($content, '</w:body>');
        if ($positionEnd===false) exit("Tag </w:body> not found in document 1.");

        $contentEndPosition = $positionEnd;


        $tbsZip = new TbsZip();

        foreach ($filesPath as $key=>$path) {
            $fileContent = '';

            if ($key != 0) {
                $tbsZip->Open($path);
                $fileContent = $tbsZip->FileRead('word/document.xml');
                $tbsZip->Close();

                $positionBody = strpos($fileContent, '<w:body');
                if ($positionBody===false) exit("Tag <w:body> not found in document 1.");

                // Extract the content of the first document

                $positionStart = strpos($fileContent, '>', $positionBody);
                $fileContent = substr($fileContent, $positionStart+1);
                $positionEnd = strpos($fileContent, '</w:body>');
                if ($positionEnd===false) exit("Tag </w:body> not found in document 1.");
                $fileContent = substr($fileContent, 0, $positionEnd);

                $content = substr_replace($content, $fileContent, $contentEndPosition, 0);

                //$fileContent = '123';

                $mergedTbsZip->FileReplace('word/document.xml', $content, TBSZIP_STRING);
            }
        }
        
        $mergedTbsZip->Flush(TBSZIP_FILE, 'staff-salary/staff-salary-type-icons/merged1.docx');

        $mergedTbsZip->close();
    }
}