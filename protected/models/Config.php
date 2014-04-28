<?php

/**
 * This is the model class for table "{{config}}".
 *
 * The followings are the available columns in table '{{config}}':
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property string $title
 * @property string $update_time
 * @property string $type
 * @property integer $section
 */
class Config extends CActiveRecord
{
          
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{config}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, value, title,type,section', 'required','on'=>'create'),
                        array('section', 'numerical'),
                        array('value, title', 'required','on'=>'update'),
			array('name, title', 'length', 'max'=>56),
                        array('value','TypeValidator','except'=>'create'),
			array('value', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, value, title, update_time', 'safe', 'on'=>'search'),
		);
	}
        
    public function TypeValidator($attribute,$params)
    {
        if($this->type=='int')    
          $res = CValidator::createValidator('numerical', $this,'value');
        elseif($this->type=='str')    
          $res = CValidator::createValidator('required', $this,'value');        
        elseif($this->type=='email')    
          $res = CValidator::createValidator('email', $this,'value');       
        
          $res->validate($this);      
    }

	  public function scopes() 
        {
            return array(
              'user'=>array(
                    'select'=>'title,value,name',
                    'condition'=>'section=1',                 
              ),  
            );
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Имя переменной',
			'value' => 'Значение',
			'title' => 'Название параметра',
			'update_time' => 'Update Time',
                        'type'=>'Тип переменной'
		);
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
                $criteria->condition = 'section!=1'; 
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                         'sort'=>array(
                            'defaultOrder' => 'id ASC',
                        ),
                        'pagination'=>false
		));
	}
        
        public function beforeSave()
        {
		Configuration::clearCache();                
		$this->update_time = new CDbExpression('NOW()');		
		return parent::beforeSave();
	}
        
        public function getConfigValue()
        {           
               return $this->value;
        }

}