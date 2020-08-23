<?php
                  
namespace app\models;   
use yii\db\ActiveRecord;

/**
* Book model class
*/
class Demo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'buy_amount'], 'required'],
            [['name', 'buy_amount'], 'safe'],
            [['buy_amount'], 'number', 'min'=>0, 'max'=>5000]
        ];
    }
}
