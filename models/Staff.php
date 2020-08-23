<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $id_staff
 * @property string|null $last_name Фамилия
 * @property string|null $first_name Имя
 * @property string|null $second_name Отчество
 * @property int|null $id_telegram Идентификатор телеграм
 * @property int|null $id_location Идентификатор привязанной точки
 * @property bool|null $status Статус профиля
 * @property string|null $state Состояние регистрации
 * @property string|null $date_start Дата начала работы
 * @property bool|null $date_start_approve Подтверждение даты начала работы
 * @property string|null $unique_excel_name
 * @property string|null $sex Пол
 * @property string|null $phone Телефон
 * @property string|null $email Эл.почта
 * @property string|null $date_of_birth Дата рождения
 * @property bool|null $always_show
 * @property string|null $vk Вконтакте
 * @property string|null $instagram Инстаграм
 * @property string|null $inn ИНН
 * @property string|null $snils СНИЛС
 * @property string|null $passport_number Номер паспорта
 * @property string|null $passport_date Дата выдачи паспорта
 * @property string|null $passport_authority Кем выдан паспорт
 * @property string|null $place_of_birth Место рождения
 * @property int|null $passport_first_page id_file
 * @property int|null $passport_second_page id_file
 * @property string|null $address_home Адрес текущий
 * @property string|null $address_register Адрес по прописке
 * @property string|null $length_of_service
 * @property string|null $family_members
 * @property string|null $family_status
 * @property string|null $uniform_size
 * @property string|null $comment
 * @property string|null $education
 * @property string|null $health_card
 * @property string|null $military_id
 * @property string|null $info
 *
 * @property Locations $location
 */
class Staff extends \yii\db\ActiveRecord
{
    public $passport_first_page_file;
    public $passport_second_page_file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_telegram', 'id_location', 'passport_first_page', 'passport_second_page'], 'integer'],
            [['status', 'date_start_approve', 'always_show'], 'boolean'],
            [['date_start', 'date_of_birth', 'passport_date'], 'safe'],
            [['comment'], 'string'],
            [['last_name', 'first_name', 'second_name', 'state', 'unique_excel_name', 'vk', 'instagram', 'place_of_birth'], 'string', 'max' => 150],
            [['sex'], 'string', 'max' => 1],
            [['phone', 'inn'], 'string', 'max' => 12],
            [['email', 'family_status', 'education', 'health_card', 'military_id'], 'string', 'max' => 50],
            [['snils'], 'string', 'max' => 11],
            [['passport_number', 'info'], 'string', 'max' => 10],
            [['passport_authority', 'address_home', 'address_register'], 'string', 'max' => 200],
            [['length_of_service', 'family_members'], 'string', 'max' => 500],
            [['uniform_size'], 'string', 'max' => 6],
            [['first_name', 'last_name', 'second_name', 'date_start'], 'unique', 'targetAttribute' => ['first_name', 'last_name', 'second_name', 'date_start']],
            [['unique_excel_name'], 'unique'],
            [['id_location'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['id_location' => 'id_location']],
            [['passport_first_page_file', 'passport_second_page_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_staff' => 'ID Сотрудника',
            'last_name' => 'Фамилия',
            'first_name' => 'Имя',
            'second_name' => 'Отчество',
            'id_telegram' => 'ID Телеграма',
            'telegram_username' => 'Имя пользователя Телеграм',
            'id_location' => 'ID Локации',
            'status' => 'Статус',
            'state' => 'Состояние',
            'date_start' => 'Дата начала',
            'date_start_approve' => 'Одобренная дата начала',
            'date_end' => 'Дата окончания',
            'date_start_official' => 'Официальная дата начала',
            'date_end_official' => 'Официальная дата окончания',
            'personnel_number' => 'Персональный номер',
            'id_position_official' => 'ID Должностное лицо',
            'unique_excel_name' => 'Уникальное имя Excel',
            'sex' => 'Пол',
            'phone' => 'Телефон',
            'email' => 'Электронная почта',
            'date_of_birth' => 'Дата рождения',
            'always_show' => 'Показывается всегда',
            'vk' => 'Ссылка ВК',
            'instagram' => 'Инстаграмм',
            'inn' => 'Гостиница',
            'snils' => 'СНИЛС',
            'passport_number' => 'Номер паспорта',
            'passport_date' => 'Когда выдан паспорта',
            'passport_authority' => 'Кем выдан паспорта',
            'place_of_birth' => 'Место рождения',
            'passport_first_page' => 'Первая страница паспорта',
            'passport_second_page' => 'Вторая страница паспорта',
            'passport_first_page_file' => 'Файл первой страницы паспорта',
            'passport_second_page_file' => 'Файл второй страницы паспорта',
            'address_home' => 'Адрес проживания',
            'address_register' => 'Место регистрации',
            'length_of_service' => 'Стаж',
            'family_members' => 'Члены семьи',
            'family_status' => 'Семейный статус',
            'uniform_size' => 'Размер униформы',
            'comment' => 'Комментарии',
            'education' => 'Образование',
            'health_card' => 'Медицинская карта',
            'military_id' => 'Военный билет',
            'info' => 'Информация',
        ];
    }


    public function getStaffSalary()
    {
        return $this->hasMany(StaffSalary::className(), ['id_staff' => 'id_staff']);
    }

    public function getLocation()
    {
        return $this->hasOne(Locations::className(), ['id_location' => 'id_location']);
    }

    public function getPosition()
    {
        return $this->hasOne(StaffPositions::className(), ['id_position' => 'id_position_official']);
    }

    // public function search($params)
    // {
    //     $query = Staff::find();

    //     $dataProvider = new ActiveDataProvider([
    //         'query' => $query,
    //     ]);

    //     $this->load($params);

    //     if (!$this->validate()) {
    //         // uncomment the following line if you do not want to return any records when validation fails
    //         // $query->where('0=1');
    //         return $dataProvider;
    //     }

    //     $query->andFilterWhere(['like', 'last_name', $this->last_name]);

    //     return $dataProvider;
    // }

    public function getNameStaff($id_staff)
    {
        $model = Staff::findOne($id_staff);

        $name =  $model->last_name . ' ' . $model->first_name . ' ' . $model->second_name;

        return $name;
    }

    public static function getMapFullName()
    {
        $staffIdFullNamePairs = [];
        $staffList = Staff::find()->all();

        foreach ($staffList as $staff) {
            $staffIdFullNamePairs[$staff->id_staff] = $staff->last_name . ' ' . $staff->first_name . ' ' . $staff->second_name;
        }

        return $staffIdFullNamePairs;
    }
}
