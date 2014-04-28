<?php

/**
 * This is the model class for table "{{tech}}".
 *
 * The followings are the available columns in table '{{tech}}':
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
class Project extends Model
{
               
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
      
	
	public function tableName()
	{
		return '{{project}}';
	}

	
	public function rules()
	{
		
		return array(
			array('title,text', 'required'),                       						
			array('title_tag,key_words, description,title', 'length', 'max'=>255),
                        array('short', 'length', 'max'=>500),                
			array('id,  title,  active, img, sorter', 'safe', 'on'=>'search'),
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
			'title' => 'Заголовок',                        
			'text' => 'Полный текст',                        
			'active' => 'Публиковать',			
			'img' => 'Заглавное фото ',
                        'short'=>'Короткое описание',
                        'sorter'=>'Порядок',                         
		);
	}
       
                     
     
        
        public function behaviors(){
		return array(			
                    'CacheUpdate'=>array(
                           'class'=>'CacheBehavior',
                     ),
                   /*  'imageBehavior' => array(
                            'class' => 'ImageBehavior',
                            'imagePath' => 'images/project',
                            'imageField' =>'img',               
                            'width'=>150,
                            'height'=>150,
                            'prefix'=>'project_', 
                            'crop'=>true,
                            'allowEmpty'=>false
                            ),
                    * 
                    */
                 'ActiveSorterBehavior'=>array(               
                           'class'=>'ActiveSorterBehavior',           
                          ),
               /*  'AliasBehavior'=>array(
                           'class'=>'AliasBehavior',
                           'titleAttribute'=>'title'
                  )
                * 
                */
		);
	}
       
       public function scopes()
        {
                return array(
                          'active'=>array(
                              'condition'=>'active=1',
                              'order'=>'sorter asc, title asc'
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
		return new CActiveDataProvider('Project', array(
			'criteria'=>$criteria,
                        'sort' => array(
                           'defaultOrder' => 'sorter asc,title asc',
                               ),                        			
		));
	}       
              
        
        
       public function getUrl()
       {        
          return Yii::app()->createAbsoluteUrl('project/view',array('alias'=>$this->alias));
       }   
       
     

}