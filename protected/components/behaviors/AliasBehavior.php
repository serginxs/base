<?php
/*
 * Поведение для автоматического заполнения полей alias при создании или редвктировании записи модели.
 */


class AliasBehavior extends CActiveRecordBehavior
{
    /*
     *  @var int - поле проверки для публикации записи.Значение 1 или 0.
     */
    public $aliasAttribute = 'alias';
    
    
    /*
     * @var int - поле сортировки для вывода записей модели order by sorter.
     */
    public $titleAttribute = 'title';
    
    /*
     * @var bool - флаг для проверки подключения поведения.
     */
    public $isEnabled = true;
    
     /*
     * @var bool - флаг для проверки уникальности  поля.
     */
    public $unique = true;


    private $oldTitleValue;
    
    public $mode = 'auto';



    public function attach($owner){
        parent::attach($owner); 
        $this->setEnabled($this->isEnabled);
        $this->oldTitleValue = $this->owner->{$this->titleAttribute};
        
       
        // добавляем  валидатор для атрибута alias на уникальность и ссответсвие шаблону;
        $matchValidator=CValidator::createValidator('match',$owner,  $this->aliasAttribute,array( 'pattern'=>'/^[a-z0-9\-]+$/', 'message'=>'В поле URL допустимы только прописные (маленькие) английские буквы слова разделяются дефисами'));       
          $owner->validatorList->add($matchValidator);
        if($this->unique){
           $uniqeValidator=CValidator::createValidator('unique',$owner, $this->aliasAttribute,array( 'message' => 'Этот URL не уникален и уже занят, придумайте новый'));       
           $owner->validatorList->add($uniqeValidator);
        }
        $lenthValidator = CValidator::createValidator('length',$owner, $this->aliasAttribute,array(  'max' => 250)); 
          $owner->validatorList->add($lenthValidator);
       
       }
 
       public function beforeValidate($event) {
           if($this->owner->hasAttribute($this->aliasAttribute)){
              if($this->owner->isNewRecord)
                 $this->setAliasAttribute();  
              else 
                 $this->updateAliasAttribute();
           }
	}
    

        
        protected function setAliasAttribute()
        {          
          if(empty($this->owner->{$this->aliasAttribute}))
               $attribute = $this->owner->{$this->titleAttribute};
          else 
               $attribute = $this->owner->{$this->aliasAttribute};
               
          $this->owner->setAttribute ($this->aliasAttribute,YText::translit($attribute));       
        }
        
        
        protected function updateAliasAttribute()
        {
            if($this->oldTitleValue != $this->owner->{$this->titleAttribute} || empty($this->owner->{$this->aliasAttribute}))
               $attribute = $this->owner->{$this->titleAttribute};
           else 
               $attribute = $this->owner->{$this->aliasAttribute};         
            
           $this->owner->setAttribute ($this->aliasAttribute,YText::translit($attribute));
        }
        
       

}
?>
