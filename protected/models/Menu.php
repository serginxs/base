<?php

/**
 * This is the model class for table "{{menu}}".
 *
 * The followings are the available columns in table '{{menu}}':
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property integer $sorter
 * @property integer $active
 */
class Menu extends Model
{
  private static $_menu=array();
  
	public function tableName()
	{
		return '{{menu}}';
	}


	public function rules()
	{
		return array(
			array('title, url', 'required'),			
			array('title, url,get', 'length', 'max'=>128),
			// The following rule is used by search().		
			array('id, title, url, sorter, active', 'safe', 'on'=>'search'),
		);
	}

  
  public function behaviors()
  {
		return array(	   
                      'CacheUpdate'=>array(
                             'class'=>'CacheBehavior',
                        ),
                      'ActiveSorterBehavior'=>array(               
                          'class'=>'ActiveSorterBehavior',           
                        )                                          
                       
		);
	}
        public function scopes()
        {
            return array(         
                'active'=>array(
                    'select'=>'id,title,url,get',
                    'condition'=>'active=1',
                    'order'=>'sorter asc, title asc'
                )
            );
        }

	public function relations()
	{		
		return array(
      'pages'=>array(self::HAS_MANY,'Page','type','order'=>'sorter asc')
		);
	}


	public function attributeLabels()
	{
		return     array(
      'id' => 'ID',
			'title' => 'Заголовок меню',
			'url' =>   'Относительный путь',
      'get'=>  'Дополнительный GET параметр',
			'sorter' => 'Позиция',
			'active' => 'Публиковать',
		);    
	}


	public function search()
	{
		$criteria=new CDbCriteria;
		
		$criteria->compare('title',$this->title,true);		
		$criteria->compare('sorter',$this->sorter);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
      'sort' => array(
                           'defaultOrder' => 'sorter asc,title asc',
                           'multiSort'=>true
                               ),   
		));
	}


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
  
  
  public static function loadMenu()
	{
		self::$_menu=array();
		$models=self::model()->findAll(array(		
			'order'=>'sorter',
		));
    self::$_menu[]='Основная страница';
		foreach($models as $model)
			self::$_menu[$model->id]=  Yii::t ('admin',$model->title);
    return self::$_menu;
	}
  
  /*
   * Array items for layouts menu widget
   */
  public static function Items()
  {
    $dependency= new CGlobalStateCacheDependency('Cache.menu');
    $menus = self::model()->cache(84000,$dependency)->active()->findAll();    
    $menu_items = array();
        foreach ($menus as $menu) {
            if($menu->get)
               $menu_items[] = array('label'=>CHtml::encode($menu->title), 'url'=>array($menu->url,'alias'=>$menu->get));
            else 
               $menu_items[] = array('label'=>CHtml::encode($menu->title), 'url'=>array($menu->url));
        }
     return $menu_items;
    
  }
}
