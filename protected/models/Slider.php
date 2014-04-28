<?php

/**
 * This is the model class for table "{{slider}}".
 *
 * The followings are the available columns in table '{{slider}}':
 * @property integer $id
 * @property string $title 
 * @property string $img
 * @property integer $sorter
 * @property integer $active
 * 
 */
class Slider extends Model
{
	public $W = 1920;
  public $H = 380;
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{slider}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('title', 'required'),
			array('sorter, active', 'numerical', 'integerOnly'=>true),                
                        array('url','url'),
			array('title,url', 'length', 'max'=>255),
                        array('text', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, sorter, active', 'safe', 'on'=>'search'),                       
		);
	}
        
        public function scopes()
        {
            return array(  
               
                'active'=>array(                    
                    'condition'=>'active=1', 
                    'order'=>'sorter asc',
                    'limit'=>5
                ),               
            );
        }

	

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Заголовок',                        
                        'text'=>'Описание',                        
			'img' => 'Загрузить изображение',
			'sorter' => 'Позиция',
			'active' => 'Публиковать'			
		);
	}

        
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->compare('url',$this->url,true);				
		$criteria->compare('sorter',$this->sorter);
		$criteria->compare('active',$this->active);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort' => array(
                           'defaultOrder' => 'sorter asc',
                               ),
                        'pagination'=>array(
                            'pageSize'=>  param('page_size',10)
                            ),
		));
	}
        
       public function behaviors()
        {
                    return array(                           
                           'CacheUpdate'=>array(
                                    'class'=>'CacheBehavior',
                               ),
                         'imageBehavior' => array(
                            'class' => 'ImageBehavior',
                            'imagePath' => 'images/slider',
                            'imageField' =>'img',               
                            'width'=>$this->W,
                            'height'=>$this->H,
                            'prefix'=>'slider_', 
                            'crop'=>true,
                            'allowEmpty'=>false
                            ),
                    );                
       }
        
     
}