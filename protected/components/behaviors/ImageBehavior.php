<?php
/**
 * Класс поведение подключаемое к модели для сохранения, вывода изображений.
 */
class ImageBehavior extends CActiveRecordBehavior
{
   /* @var string название атрибута таблицы, хранящего в себе имя изображения */
   public $imageField='';
   
   
  /* @var string путь к  директории, куда будем сохранять файлы */
   public $imagePath = '';
   
   
  /* @var array сценарии валидации к которым будут добавлены правила валидации загрузки файлов  */
    public $scenarios=array('create','update');
    
    
  /* @var string типы файлов, которые можно загружать (нужно для валидации) */
    public $fileTypes='jpg, jpeg, gif, png, swf';  
    
 /* @var bool стоит ли обрезать изображение по центру  
  *  */
    public $crop = false;
    
     /* @var ресайзить изображение авто(false) или фиксировано по ширине(WIDTH) или высоте(HEIGHT)    *  */
    public $pref = false;
    
 /* @var integer ширина превьюшки */
    public $width=150;
    
 /* @var integer высота превьюшки */
     public $height=150;
 
 /* @var string префикс к названию изображения  */
     public $prefix='img';
     
 /* @var boolen обязательно ли поле для заполнения при создании записи  */
     public $allowEmpty=true;
   





     public function attach($owner){
        parent::attach($owner);
        
        if(in_array($owner->scenario,$this->scenarios)){
            // добавляем валидатор файла
            $fileValidator=CValidator::createValidator('file',$owner,$this->imageField,
                array('types'=>$this->fileTypes,'allowEmpty'=>($owner->scenario=='create') ? $this->allowEmpty:true,'maxSize'=>10*1024*1024));
            $owner->validatorList->add($fileValidator);
        }
    }
    

    public function beforeSave($event){
        $file=CUploadedFile::getInstance($this->owner,$this->imageField);
        if($file && in_array($this->owner->scenario,$this->scenarios))
        {                     
            $this->deleteImage(); // старый файл удалим, потому что загружаем новый
            $imageName = $this->prefix.'_'.time().'.'.strtolower($file->extensionName);  
            $this->owner->setAttribute($this->imageField,$imageName);
            $path =  Yii::getPathOfAlias('webroot').'/'.$this->imagePath.'/'; 
            $file->saveAs($path.$imageName); 
            if($file->extensionName != 'swf')
               $this->ResizeImage($path, $imageName);
        }
        if (isset($_POST[get_class($this->owner)]['del'][$this->imageField])&&$_POST[get_class($this->owner)]['del'][$this->imageField]) {
		  $this->deleteImage(); // удаляем файл,если выбран чекбокс
        }
        return true;
    }
    
    public function getImageUrl(){
        return $this->getBaseImagePath() . $this->owner->{$this->imageField};    
    }
 
    public function getImageThumbUrl(){
        return $this->getBaseImagePath() .'/thumb/' .$this->owner->{$this->imageField};    
    }
 
    private function getBaseImagePath(){
        return Yii::app()->request->baseUrl . '/' . $this->imagePath . '/';
    }
    
    public function beforeDelete($event){
        $this->deleteImage();
    }
    
    
    public function deleteImage(){
        $image=$this->imagePath . '/' . $this->owner->{$this->imageField};
        $thumb=$this->imagePath . '/thumb/' . $this->owner->{$this->imageField};
        if(@is_file($image))
            @unlink($image);
        if(@is_file($thumb))
            @unlink($thumb);
        $this->owner->{$this->imageField} = '';
    }

    /*
     * Метод для ресайза изображения.
     *  Если выбран параметр crop= true ( обрезание), изображение прежимается по меньшему значению( высоты или ширины) и обрезается по центру.
     *  По умолчанию изображение не обрезается и пережимается по большему параметру высоты или ширины.
     */   
    private function ResizeImage($ImagePath ,$name)
        {
            $width = $this->width;
            $height = $this->height;
            $path=$ImagePath;            
            $new_path=$path.'thumb/';            
            if(!file_exists($new_path)){
                 mkdir ($new_path);
                 chmod($new_path,0777);
            }
            $image = Yii::app()->image->load($path.$name);
            if($image->__get('width') > $width || $image->__get('height') > $height)
            {
                if(!$this->pref){
                   if($this->crop)
                   {
                      if($image->__get('width') >= $image->__get('height'))                    
                          $image ->resize($width,$height,Image::HEIGHT)->crop($width,$height)->quality(90)->sharpen(20);                
                      else                                      
                          $image ->resize($width,$height,Image::WIDTH)->crop($width,$height)->quality(90)->sharpen(20);  
                   }
                   else 
                   {
                      if($image->__get('width') >= $image->__get('height'))                    
                          $image ->resize($width,$height,Image::WIDTH)->quality(90)->sharpen(20);                
                      else                                      
                          $image ->resize($width,$height,Image::HEIGHT)->quality(90)->sharpen(20);  
                   }
               }
               else{
                 if($this->pref=="WIDTH"){
                   if($this->crop)
                     $image ->resize($width,$height,Image::WIDTH)->crop($width,$height)->quality(90)->sharpen(20);
                   else 
                     $image ->resize($width,$height,Image::WIDTH)->quality(90)->sharpen(20);
                 }
                 elseif($this->pref=="HEIGHT"){
                    if($this->crop)
                     $image ->resize($width,$height,Image::HEIGHT)->crop($width,$height)->quality(90)->sharpen(20);
                    else 
                     $image ->resize($width,$height,Image::HEIGHT)->quality(90)->sharpen(20);
                 }
               }
            }
            $image->save($new_path.$name);  
        }
        
        
        public function getImage($original = false)
        {
            if($this->owner->img)
                return $original ? $this->imageUrl : $this->imageThumbUrl;
            else 
                return Yii::app()->baseUrl.'/css/images/noimage.gif';
        }
        
        
  
}
?>
