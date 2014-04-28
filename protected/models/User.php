<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $phone
 * @property integer $isAdmin
 */
class User extends CActiveRecord
{
    
    
        private static $_saltAddon = 'project';
	public $password_repeat;
	public $old_password;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('username, password, salt, email, phone', 'required'),
                        array('password, password_repeat', 'required', 'on' => 'changeAdminPass'),
                        array('password', 'compare', 'on' => 'changeAdminPass','message' => 'Пароли не совпадают. Попробуйте ещё раз'),
                        array('password_repeat', 'safe'),
                        array('password', 'length', 'min' => 6, 'on' => 'changeAdminPass','tooShort' => 'Пароль слишком короткий! Минимальная длина 6 символов.'),
                        array('old_password', 'required', 'on' => 'changeAdminPass'),
                        // The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$return= array(
			'id' => 'ID',
			'username' => Yii::t('main','username'),
			'password' => Yii::t('module_users','password'),
                        'password_repeat'=>'Подтвердите пароль',			
			'email' => 'Email',			
			'isAdmin' => 'Is Admin',
		);
                if($this->scenario == 'changeAdminPass')
                {
                    $return['old_password']='Введите старый пароль';
                    $return['password']='Введите новый пароль';
                }
                return $return;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);		
		$criteria->compare('email',$this->email,true);		
		$criteria->compare('isAdmin',$this->isAdmin);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}        

}