<?php
/*
 * Поведение для автоматического заполнения полей active и sorter при создании новой записи модели.
 */


class ActiveSorterBehavior extends CActiveRecordBehavior
{
    /*
     *  @var int - поле проверки для публикации записи.Значение 1 или 0.
     */
    public $activeAttribute = 'active';
    
    
    /*
     * @var int - поле сортировки для вывода записей модели order by sorter.
     */
    public $sorterAttribute = 'sorter';
    
    
    /*
     * @var bool - флаг для проверки подключения поведения.
     */
    public $isEnabled = true;





    public function attach($owner){
                parent::attach($owner); 
                $this->setEnabled($this->isEnabled);
                if($this->enabled){
                    $attributes =array();
                    if($this->owner->hasAttribute($this->activeAttribute))
                        $attributes[] =  $this->activeAttribute;
                    if($this->owner->hasAttribute($this->sorterAttribute))
                        $attributes[] = $this->sorterAttribute;
                    // добавляем числовой валидатор для атрибутов active и сортер
                    $fileValidator=CValidator::createValidator('numerical',$owner,$attributes,array('integerOnly'=>true));       
                    $owner->validatorList->add($fileValidator);
                }
   }


   
       public function beforeSave($event) {   
          
           if($this->owner->isNewRecord){
                    $this->setActiveAttribute();
                    $this->setSorterAttribute();
                };
          
	}

        
        protected function setActiveAttribute()
        {
            if($this->owner->hasAttribute($this->activeAttribute)){               
                    $this->owner->setAttribute ($this->activeAttribute,1);
            }
        }
        
        protected function setSorterAttribute()
        {
            if($this->owner->hasAttribute($this->sorterAttribute)){
                    $sql = 'SELECT MAX('.$this->sorterAttribute.') FROM '.$this->owner->tableName().'';
                    $command = Yii::app()->db->createCommand($sql);
                    $max = $command->queryScalar();
                    $this->owner->{$this->sorterAttribute} = $max ? $max+1 :1;
            }
        }      

}
?>
