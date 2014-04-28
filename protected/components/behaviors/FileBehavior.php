<?php
/**
 * Класс поведение подключаемое к модели для сохранения, вывода изображений.
 */
class FileBehavior extends CActiveRecordBehavior
{
   /* @var string название атрибута таблицы, хранящего в себе имя изображения */
   public $fileField='file';
   
   
  /* @var string путь к  директории, куда будем сохранять файлы */
   public $filePath = '';
   
   
  /* @var array сценарии валидации к которым будут добавлены правила валидации загрузки файлов  */
    public $scenarios=array('create','update');
    
    
  /* @var string типы файлов, которые можно загружать (нужно для валидации) */
    public $fileTypes='xls, xlsx, xlsm, doc, docx, docm, pdf'; 
    
    

     public $prefix='file_';
     
 /* @var boolen обязательно ли поле для заполнения при создании записи  */
     public $allowEmpty=true;
   





     public function attach($owner){
        parent::attach($owner);
        
        if(in_array($owner->scenario,$this->scenarios)){
            // добавляем валидатор файла
            $fileValidator=CValidator::createValidator('file',$owner,$this->fileField,
                array('types'=>$this->fileTypes,'allowEmpty'=>($owner->scenario=='create') ? $this->allowEmpty:true,'maxSize'=>10*1024*1024));
            $owner->validatorList->add($fileValidator);
        }
    }
    

    public function beforeSave($event){
        $file=CUploadedFile::getInstance($this->owner,$this->fileField);
        if($file && in_array($this->owner->scenario,$this->scenarios))
        {                     
            $this->deleteFile(); // старый файл удалим, потому что загружаем новый
            $fileName = $this->prefix.time().'.'.strtolower($file->extensionName);  
            $this->owner->setAttribute($this->fileField,$fileName);
            $path =  Yii::getPathOfAlias('webroot').'/'.$this->filePath.'/'; 
            $file->saveAs($path.$fileName);             
        }
        if (isset($_POST[get_class($this->owner)]['del'][$this->fileField])&&$_POST[get_class($this->owner)]['del'][$this->fileField]) {
		  $this->deleteFile(); // удаляем файл,если выбран чекбокс
        }
        return true;
    }
    
    public function getFileUrl(){
        return $this->getBaseFilePath() . $this->owner->{$this->fileField};    
    }
 
    
    private function getBaseFilePath(){
        return Yii::app()->request->baseUrl . '/' . $this->filePath . '/';
    }
    
    public function beforeDelete($event){
        $this->deleteFile();
    }
    
    
    public function deleteFile(){
        $file=$this->filePath . '/' . $this->owner->{$this->fileField};        
        if(@is_file($file))
            @unlink($file);        
        $this->owner->{$this->fileField} = '';
    }


        
        
  
}
?>
