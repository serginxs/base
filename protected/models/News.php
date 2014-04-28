<?php

/**
 * This is the model class for table "{{style}}".
 *
 * The followings are the available columns in table '{{style}}':
 * @property integer $id
 * @property string $title_tag
 * @property string $key_words
 * @property string $description
 * @property string $title
 * @property string $text
 * @property integer $active
 * @property integer $alias
 * @property string $img
 * @property create_time
 * @property update_time
 */
class News extends Model
{
               
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
      
	
	public function tableName()
	{
		return '{{news}}';
	}

	
	public function rules()
	{
		
		return array(
			array('title,create_time,short,text', 'required'),                        
                        array('create_time','date','format'=>'dd.MM.yyyy','on'=>'create,update'),						
			array('title_tag,key_words, description,title', 'length', 'max'=>255),
                        array('short', 'length', 'max'=>500),                
			array('id,  title, text, active, img,create_time', 'safe', 'on'=>'search'),
		);
	}
       

        public function relations()
	{
		
		return array(
                  
		);
	}
		
	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title_tag' => 'Мета-тег тайтл',                                    
                        'key_words' => 'Мета-тег  key words',                                    
                        'description' => 'Мета-тег description',                   
                        'alias'=>'URL',
			'title' => 'Заголовок новости',                        
			'text' => 'Полный текст новости',                        
			'active' => 'Публиковать',			
			'img' => 'Заглавное фото новости',
                        'short'=>'Короткое описание новости',
                        'create_time'=>'Дата создания',                         
		);
	}
       
                     
       public function beforeSave()
        {               
                   
                   $this->update_time = new CDbExpression('NOW()');              
                   $this->create_time=date('Y-m-d H:i:s', strtotime($this->create_time));        

                return parent::beforeSave();
        } 
        
        
        
       public function afterFind()
        {               
             $this->create_time=date('d.m.Y', strtotime($this->create_time)); 
             return parent::afterFind();
        } 

        
        public function behaviors(){
		return array(			
                    'CacheUpdate'=>array(
                           'class'=>'CacheBehavior',
                     ),
                     'imageBehavior' => array(
                            'class' => 'ImageBehavior',
                            'imagePath' => 'images/news',
                            'imageField' =>'img',               
                            'width'=>150,
                            'height'=>150,
                            'prefix'=>'news_', 
                            'crop'=>true,
                            'allowEmpty'=>false
                            ),
                 'ActiveSorterBehavior'=>array(               
                           'class'=>'ActiveSorterBehavior',           
                          ),
                 'AliasBehavior'=>array(
                           'class'=>'AliasBehavior',
                           'titleAttribute'=>'title'
                  )
		);
	}
       
       public function scopes()
        {
                return array(
                          'active'=>array(
                              'condition'=>'active=1',
                              'order'=>'create_time desc, id desc'
                          ),
                          'sitemap'=>array('select'=>'alias,title', 'order'=>'create_time desc'),
                        //'sitemap'=>array('select'=>'url', 'condition'=>'startDate <= NOW()', 'order'=>'create_time desc'),
                );
        }    
        
	
       

        public function search()
	{
		
		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);		
		$criteria->compare('t.title',$this->title,true);                		
		$criteria->compare('t.active',$this->active);
                $criteria->compare('t.alias',$this->alias,true);                
                
                if(!empty($this->create_time))
                {
                    list($day,$month,$year) = explode(".",$this->create_time);                    
                    $daystart= date('Y-m-d H:i:s',mktime(0,0,0,(int)$month,(int)$day,(int)$year));                    
                    $dayend= date('Y-m-d H:i:s',mktime(23,59,59,(int)$month,(int)$day,(int)$year));                    
                    $criteria->condition = ':s<=t.create_time AND t.create_time<=:e';
                    $criteria->params=array(':s'=>$daystart,':e'=>$dayend);
                 }
            
		return new CActiveDataProvider('News', array(
			'criteria'=>$criteria,
                        'sort' => array(
                           'defaultOrder' => 't.create_time desc,t.id desc',
                               ),                        			
		));
	}
        
        public function getDatepickerOptions()
       {
                  return array(
                    
                    'showOn' => 'focus', 
                    'dateFormat' => 'd.m.y',                    
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                               );
       }      
          

       public function getCreate_date()
       {
           //return Yii::app()->dateFormatter->format("dd MMMM y", $this->create_time);
           return Yii::app()->dateFormatter->format("dd MMMM y", $this->create_time);
       }     
         
        
        
       public function getUrl()
       {        
          return Yii::app()->createAbsoluteUrl('news/view',array('alias'=>$this->alias));
       }   
       
     

}