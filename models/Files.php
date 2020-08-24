<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property int|null $id_location
 * @property int|null $id_staff
 * @property int|null $id_salary
 * @property string|null $type
 * @property string|null $file
 * @property int|null $i
 * @property string $datetime
 */
class Files extends \yii\db\ActiveRecord
{
    public $temp_file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_location', 'id_staff', 'id_salary', 'i'], 'integer'],
            [['datetime'], 'safe'],
            [['type'], 'string', 'max' => 50],
            [['file'], 'string', 'max' => 150],
            [['temp_file'], 'file', 'skipOnEmpty' => true],
            [['header'], 'string', 'max' => 255],
            [['storage_life'], 'date', 'format' => 'yyyy-MM-dd'],
            [['comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_location' => 'Локация',
            'id_staff' => 'Id Staff',
            'id_salary' => 'ID Зарплаты',
            'type' => 'Тип',
            'file' => 'File',
            'i' => 'I',
            'datetime' => 'Время создания',
            'temp_file' => 'Временный файл',
            'header' => 'Заголовок файла',
            'storage_life' => 'Дата истечения срока годности файла',
            'comment' => 'Текстовый комментарий к файлу',
        ];
    }

    public function isChecked()
    {
        if (array_key_exists('selectedRowsOnPages', $_COOKIE)) {
            $selectedRows = json_decode($_COOKIE['selectedRowsOnPages']);

            foreach ($selectedRows as $selectedRow) {
                if (key(get_object_vars($selectedRow)) == $this->id) {
                    if (current(get_object_vars($selectedRow)) == 1) {
                        return true;
                    } elseif (current(get_object_vars($selectedRow)) == 0) {
                        return false;
                    }
                }
            }
        }

        return false;
    }

    public function getLocations()
    {
        return $this->hasOne(Locations::className(), ['id_location' => 'id_location']);
    }

    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id_staff' => 'id_staff']);
    }

    public function getSalary()
    {
        return $this->hasMany(StaffSalary::className(), ['id_salary' => 'id_salary']);
    }

    public static function getCurrentDateTime($timezoneGMT = 3)
    {
        return gmdate('Y-m-d H:i:s', time() + 3600*($timezoneGMT+date("I")));
    }

<<<<<<< Updated upstream
    public static function createFiles($data) {
        $model = new Files();

        // указаны не все поля !!!
        $model->id_staff = $data['id_staff'];
        $model->type = $data['type'];
        $model->datetime = $data['datetime'];
        $model->file = $data['file'];
        $model->header = $data['header'];
        $model->comment = $data['comment'];

        return $model;
    }

=======
>>>>>>> Stashed changes
}
