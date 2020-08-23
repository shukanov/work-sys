<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Locations;

class UploadPhoto extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;
    public $strong;
    public function rules()
    {
        return [   [['imageFiles'], 'default', 'value' => null],
        ];
    }

    public function upload($per,$id)
    {
        $strong = NULL;
        if ($this->validate()) {
            if($this->imageFiles == '')
            {
                return true;
            }
            else{
                foreach ($this->imageFiles as $file)
                {
                    while($strong==NULL)
                    {
                        $bytes=openssl_random_pseudo_bytes(20,$cstrong);
                    }
                    $hex= bin2hex($bytes);
                    $path=$per . /*$file->baseName */$hex.uniqid(). '.' . $file->extension;
                    $image = new Locations();
                    $image->photo='/'.$path;
                    $image->id_location=$id;
                    $image->save();
                    $file->saveAs($path);
                }
                return true;
            }
        }
        else {
            return false;
        }
    }
}
