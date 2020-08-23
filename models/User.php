<?php
                  
namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'staff';
    }

    public static function findByUsername($id_staff)
    {
       return static::findOne($id_staff);
    }
    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id_staff)
    {
        return static::findOne($id_staff);
    }

    public function getPermissions()
    {
        return StaffPermissions::findOne(['id_staff' => $this->getId()]);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id_staff;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return;
        return $this->id_staff;
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }   
    
    
    public function validatePassword($password)
    {
        return $this->passport_number === $password;
    }            
    // 515                
    // 9514854054
}
