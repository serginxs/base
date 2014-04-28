<?php
/**
 * Model is the customized base model class.
 * All model classes for this application should extend from this base class.
 */
class Model extends CActiveRecord
{
    
   public $imgTypes = 'jpg, jpeg, gif, png'; 
   
   public $fileTypes = 'xls, xlsx, xlsm, doc, docx, docm, pdf';
   
   public $musicTypes = 'mp3, aac, m4a, f4a, ogg, oga';




   public function attributeDescriptions()
        {
            return array(
			'id' => 'ID',
			'title_tag' => 'Мета-тег тайтл',                                    
                        'key_words' => 'Мета-тег  key words',                                    
                        'description' => 'Мета-тег description',                   
                        'alias'=>"Краткое название  латинскими буквами, используется для формирования  адреса.<br /> Например (выделено темным фоном): <pre>http://site.ru/<span class='label'>contacts</span>/</pre> В этом поле допустимы только прописные английские буквы.<br>Если вы не знаете, для чего вам нужно это поле &ndash; не заполняйте его,оно заполнится автоматически из названия.",
			'title' => 'Заголовок новости',                        
			'text' => 'Текст новости',                        
			'active' => 'Публиковать',			
			'img' => 'Допустимые форматы: '.$this->imgTypes,
                        'file' => 'Допустимые форматы: '.$this->fileTypes,
                        'video' => "Скопируйте ссылку ролика в любом допустимом формате, например:<br/> <pre>http://youtu.be/Bd3RB_G-mA4</pre>или<br/><pre>http://www.youtube.com/watch?v=Bd3RB_G-mA4</pre>",
                        'sorter'=>'Позиция',  
                        'password'=>'Пароль',
                        'superuser'=>'<strong>Админ</strong> - неограниченный доступ<br><strong>Автор</strong> - авторизированный пользователь с возможностью создания и редактирования своего творчества',
                        'status'=>'<strong>Не активирован</strong> - промежуточный статус после регистрации по почте, требует активации админом<br><strong>Активирован</strong> - пользователь может заходить (логиниться) на сайте<br><strong>Забанен</strong> - пользователь не может зайти (залогиниться) на сайт ',
                        'parentId' =>'Выберите родителькую категорию, к которй будет относится данная категория <br>
                                      Если выбрать Корневая, то данная категория станет новой родительской (корневой)',
                        'onmain'=>'Поле означает нужно ли публиковать аватар (для автора в слайдере) или арт (для творческого анонса) на главной странице',
                        'decimal'=>'Целая часть разделяется точкой, после неё допустимо до двух  десятичных знаков. Например: <br/> <b>102.5 <br/> 15.99<br/>55</b> '
		);
        }
        
        
   public function attributeTitles()
        {
            return array(
			'id' => 'ID',
			'title_tag' => 'Мета-тег тайтл',                                    
                        'key_words' => 'Мета-тег  key words',                                    
                        'description' => 'Мета-тег description',                   
                        'alias'=>'Url-адрес',
			'title' => 'Заголовок новости',                        
			'text' => 'Текст новости',                        
			'active' => 'Публиковать',			
			'img' => 'Нажмите обзор и выберите изображение для загрузки',
                        'file' => 'Нажмите обзор и выберите файл для загрузки',
                        'video' => 'Ссылка на видео с YouTube',
                        'password'=>'Пароль',
                        'superuser'=>'Роль определяет уровень доступа пользователя на сайте',
                        'status'=>'Текущий статус пользователя',
                        'parentId' =>'Родительская категория',
                        'onmain'=>'Публиковать на главной странице',
                        'depth'=>'Толщина плитки, мм'
                                              
		);
        }        
        
        
   public function getAttrDesc($attribute)
        {
            $description = $this->attributeDescriptions();
            return (isset($description[$attribute])) ? $description[$attribute]: '';
        }
         
        
   public function getAttrTitle($attribute)
        {
            $title = $this->attributeTitles();
            return (isset($title[$attribute])) ? $title[$attribute]: '';
        }
        
        
   public function Created($time=false)
   {
       if($time)
          return Yii::app()->dateFormatter->format('dd MMMM y  H:m', $this->create_time);
       else
          return Yii::app()->dateFormatter->format('dd MMMM y', $this->create_time);
   }
   
    public function Updated($time=false)
   {
       if($time)
          return Yii::app()->dateFormatter->format('dd MMMM y H:m', $this->update_time);
       else
          return Yii::app()->dateFormatter->format('dd MMMM y', $this->update_time);
   }
        
        

}