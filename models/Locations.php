<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "locations".
 *
 * @property int $id_location
 * @property string|null $location
 * @property int|null $chat_id
 * @property string|null $short_name
 * @property string|null $alternative_names
 * @property string|null $official_name
 * @property string|null $address
 * @property string|null $2gis
 * @property int|null $first_shift_min_for_late
 * @property int|null $second_shift_min_for_late
 * @property int|null $approve_min_for_delay
 * @property string|null $s_workweek_from
 * @property string|null $s_workweek_to
 * @property string|null $s_saturday_from
 * @property string|null $s_saturday_to
 * @property string|null $s_sunday_from
 * @property string|null $s_sunday_to
 * @property int|null $sort
 * @property bool|null $show_in_reg
 * @property bool|null $show_in_salary
 * @property string|null $last_online
 * @property bool|null $pre_order
 * @property bool|null $delivery
 * @property string|null $photo
 *
 * @property Staff[] $staff
 */
class Locations extends \yii\db\ActiveRecord
{
    public $images; 

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chat_id', 'first_shift_min_for_late', 'second_shift_min_for_late', 'approve_min_for_delay', 'sort'], 'integer'],
            [['s_workweek_from', 's_workweek_to', 's_saturday_from', 's_saturday_to', 's_sunday_from', 's_sunday_to', 'last_online', 'images'], 'safe'],
            [['show_in_reg', 'show_in_salary', 'pre_order', 'delivery'], 'boolean'],
            [['location', 'address', 'photo'], 'string', 'max' => 50],
            [['short_name'], 'string', 'max' => 5],
            [['alternative_names', 'official_name', '2gis'], 'string', 'max' => 100],
            [['location'], 'unique'],
            [['short_name'], 'unique'],
            [['images'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_location' => 'Код локации',
            'location' => 'Название локации',
            'chat_id' => 'ID Чата',
            'short_name' => 'Сокращённое имя',
            'alternative_names' => 'Альтернативное название',
            'official_name' => 'Официальное название',
            'address' => 'Адрес',
            '2gis' => '2ГИС',
            'first_shift_min_for_late' => '1-ая смена мин. за опоздание',
            'second_shift_min_for_late' => '2-ая смена мин. за опоздание',
            'approve_min_for_delay' => 'Утвердить мин. задержки',
            's_workweek_from' => 'Рабочая неделя от',
            's_workweek_to' => 'До',
            's_saturday_from' => 'Суббота от',
            's_saturday_to' => 'Суббота по',
            's_sunday_from' => 'Воскресенье с',
            's_sunday_to' => 'Воскресенье по',
            'sort' => 'Сортировка',
            'show_in_reg' => 'Показать регистрацию',
            'show_in_salary' => 'Показать в зарплате',
            'last_online' => 'Последний онлайн',
            'pre_order' => 'Предзаказ',
            'delivery' => 'Доставка',
            'photo' => 'Фото',
            'images' => 'Картинка',
        ];
    }

<<<<<<< Updated upstream
=======
    public static function getMapFullName()
    {
        $locationsIdFullNamePairs = [];
        $locationsList = Locations::find()->all();

        foreach ($locationsList as $location) {
            $name = $location->location;

            $staffSalaryIdFullNamePairs[$location->id_location] = $name;
        }

        return $staffSalaryIdFullNamePairs;
    }

>>>>>>> Stashed changes
    // public function upload()
    // {

    //         $nameUrl = 'uploads/' . $this->images->baseName . '.' . $this->images->extension;
    //         $this->images->saveAs($nameUrl);
    //         return $nameUrl;
    // }

      
    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasMany(Staff::className(), ['id_location' => 'id_location']);
    }
}
