<?php

/**
 * This is the model class for table "{{page}}".
 *
 * The followings are the available columns in table '{{page}}':
 */
class Page extends Model
{
       
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
	public function tableName()
	{
		return '{{page}}';
	}
  
 
        
  public function behaviors(){
		return array(			
                        'CacheUpdate'=>array(
                             'class'=>'CacheBehavior',
                        ),
                        'AliasBehavior'=>array(
                             'class'=>'AliasBehavior',
                             'titleAttribute'=>'title'
                       ),
                       'ActiveSorterBehavior'=>array(               
                          'class'=>'ActiveSorterBehavior',           
                        ),
                       
                       
                       
		);
	}
        public function scopes()
        {
            return array(               
                'menu'=>array(
                    'select'=>'id,title,alias',
                ), 
                'active'=>array(
                    'select'=>'title,alias',
                    'condition'=>'type!=0',                    
                ),
                'tab'=>array(
                  'select'=>'title,text',
                  'condition'=>'type=3',
                  'order'=>'id asc'
                )
            );
        }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, title,text', 'required'),
      array('text1', 'required','on'=>'main,contact'),                            
			array('title_tag', 'length', 'max'=>128),
      array('key_words, description', 'length', 'max'=>255),                        
      array('title', 'length', 'max'=>128),
      array('type', 'numerical', 'integerOnly'=>true),               
		  array('id,type,text,title,active', 'safe', 'on'=>'search')                      
		);
	}
        
      
        

	public function relations()
	{		
		return array(
                    'menu'=>array(self::BELONGS_TO, 'Menu', 'type'),
		);
	}

		public function attributeLabels()
	{
                switch($this->scenario){
                        case 'main':
                              return array(
                                    'id' => 'ID',
                                    'title_tag' => 'Мета-тег тайтл',                                    
                                    'key_words' => 'Мета-тег  key words',                                    
                                    'description' => 'Мета-тег description',                                    
                                    'text' => 'Основной текстовый блок',
                                    'text1' => 'Seo текст'                         
                                  );
                         case 'page':
                              return array( 
                                    'text' => 'Текстовый блок',
                                    'text2' => 'Текстовый блок2',
                                    'title' => 'Название страницы',
                                    'alias' => 'Адрес страницы',                                     
                                    'img'=>'Загрузить изображение',
                                    'title_tag' => 'Мета-тег тайтл',                                    
                                    'key_words' => 'Мета-тег  key words',                                    
                                    'description' => 'Мета-тег description',  
                                  );                                       
                        case 'contact':
                              return array(
                                    'id' => 'ID',
                                    'title_tag' => 'Мета-тег тайтл',                                    
                                    'key_words' => 'Мета-тег  key words',                                      
                                    'description' => 'Мета-тег description',                             
                                    'text' => 'Текстовый блок',
                                    'text1' => 'Код карты Яндекс или Google',
                                    'text3' => 'Адрес',
                                    'text4' => 'Телефон',
                                    'text5' => 'Email',                                    
                                  );                                    
                        default:                              
                            return array(
                                    'id' => 'ID',
                                    'title'=>'Название страницы',
                                    'alias'=>'URL (алиас) страницы',
                                    'type'=>'Раздел',
                                    'title_tag' => 'Мета-тег тайтл',                                    
                                    'key_words' => 'Мета-тег  key words',                                      
                                    'description' => 'Мета-тег description',   
                                    'text' => 'Текст',
                                    'text2' => 'Текст2',
                                    'text3' => 'Видео Хост',
                                    'text4' => 'Ссылка на видео',
                                    'text5' => 'Text5',                                   
                                    'img'=>'Загрузите банер', 
                                    'sorter'=>'Позиция',
                                    'active'=>'Публиковать'
                            );
                 }          
           
	}


	public function search()
	{
		
                
		$criteria=new CDbCriteria;  
                //$criteria->condition ='type!=0';
               // $criteria->addInCondition('type', array('1', '2', '3', '4', '5'));
		$criteria->compare('id',$this->id);
                $criteria->compare('type',$this->type);
		$criteria->compare('text',$this->text,true);
                $criteria->compare('title',$this->title,true);		
                $criteria->compare('active',$this->active);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort' => array(
                           'defaultOrder' => 'type asc, sorter asc',
                           'multiSort'=>true
                               ),                        
		));
	}        
       

       
       public function getUrl()
       {        
          return Yii::app()->createAbsoluteUrl('site/page',array('alias'=>$this->alias));
       } 
       
       
       public function getText()
       {
         return Yii::app()->format->formatHtml($this->text);
       }
      
      
          
      
}