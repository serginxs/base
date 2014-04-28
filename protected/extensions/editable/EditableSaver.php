<?php
/**
 * EditableSaver class file.
 * 
 * @author Vitaliy Potapov <noginsk@rambler.ru>
 * @link https://github.com/vitalets/x-editable-yii
 * @copyright Copyright &copy; Vitaliy Potapov 2012
 * @version 1.0.0
*/

/**
* EditableSaver helps to update model by editable widget submit request.
* 
* @package saver
*/ 
class EditableSaver extends CComponent
{
    /**
     * scenarion used in model for update
     *
     * @var mixed
     */
    public $scenario = 'editable';

    /**
     * name of model
     *
     * @var mixed
     */
    public $modelClass;
    /**
     * primaryKey value
     *
     * @var mixed
     */
    public $primaryKey;
    /**
     * name of attribute to be updated
     *
     * @var mixed
     */
    public $attribute;
    /**
     * model instance
     *
     * @var CActiveRecord
     */
    public $model;
    
    /**
     * @var mixed new value of attribute
     */
    public $value;    

    /**
     * http status code returned in case of error
    */
    public $errorHttpCode = 400;

    /**
    * name of changed attributes. Used when saving model
    * 
    * @var mixed
    */
    protected $changedAttributes = array();
    
    /**
     * Constructor
     *
     * @param mixed $modelName
     * @return EditableBackend
     */
    public function __construct($modelClass)
    {
        if (empty($modelClass)) {
            throw new CException(Yii::t('editable', 'You should provide modelClass in constructor of EditableSaver.'));
        }
        $this->modelClass = ucfirst($modelClass);
    }

    /**
     * main function called to update column in database
     *
     */
    public function update()
    {
        //get params from request
        $this->primaryKey = yii::app()->request->getParam('pk');
        $this->attribute = yii::app()->request->getParam('name');
        $this->value = yii::app()->request->getParam('value');
      
        //checking params
        if (empty($this->attribute)) {
            throw new CException(Yii::t('editable','Property "attribute" should be defined.'));
        }
        if (empty($this->primaryKey)) {
            throw new CException(Yii::t('editable','Property "primaryKey" should be defined.'));
        }

        //loading model
        $this->model = CActiveRecord::model($this->modelClass)->findByPk($this->primaryKey);
        if (!$this->model) {
            throw new CException(Yii::t('editable', 'Model {class} not found by primary key "{pk}"', array(
               '{class}'=>get_class($this->model), '{pk}'=>$this->primaryKey)));
        }
        
        //set scenario
        $this->model->setScenario($this->scenario);
        
        //is attribute exists
        if (!$this->model->hasAttribute($this->attribute)) {
            throw new CException(Yii::t('editable', 'Model {class} does not have attribute "{attr}"', array(
              '{class}'=>get_class($this->model), '{attr}'=>$this->attribute)));            
        }

        //is attribute safe
        if (!$this->model->isAttributeSafe($this->attribute)) {
            throw new CException(Yii::t('editable', 'Model {class} rules do not allow to update attribute "{attr}"', array(
              '{class}'=>get_class($this->model), '{attr}'=>$this->attribute))); 
        }

        //setting new value
        $this->setAttribute($this->attribute, $this->value);
        
        //validate attribute
        $this->model->validate(array($this->attribute));
        $this->checkErrors();

        //trigger beforeUpdate event
        $this->beforeUpdate();
        $this->checkErrors();
        
        //saving (no validation, only changed attributes)
        if ($this->model->save(false, $this->changedAttributes)) {
            //trigger afterUpdate event
            
            $this->afterUpdate();           
        } else {
            $this->error(Yii::t('editable', 'Error while saving record!')); 
        }
    }

    /**
     * errors as CHttpException
     * @param $msg
     * @throws CHttpException
     */
    public function checkErrors()
    {
        if ($this->model->hasErrors()) {
            $msg = array();
            foreach($this->model->getErrors() as $attribute => $errors) {
               $msg = array_merge($msg, $errors); 
            }
            //todo: show several messages. should be checked in x-editable js
            //$this->error(join("\n", $msg));
            $this->error($msg[0]);
        }
    }     
    
    /**
     * errors as CHttpException
     * @param $msg
     * @throws CHttpException
     */
    public function error($msg)
    {
        throw new CHttpException($this->errorHttpCode, $msg);
    }  
    
    /**
    * setting new value of attribute.
    * Attrubute name also stored in array to save only changed attributes
    * 
    * @param mixed $name
    * @param mixed $value
    */
    public function setAttribute($name, $value)
    {
         $this->model->$name = $value;
         if(!in_array($name, $this->changedAttributes)) {
             $this->changedAttributes[] = $name;
         }
    }      
    
    /**
     * This event is raised before the update is performed.
     * @param CModelEvent $event the event parameter
     */
    public function onBeforeUpdate($event)
    {
        $this->raiseEvent('onBeforeUpdate', $event);
    }

    /**
     * This event is raised after the update is performed.
     * @param CEvent $event the event parameter
     */
    public function onAfterUpdate($event)
    {        
        $this->raiseEvent('onAfterUpdate', $event);
    }

    /**
     * beforeUpdate
     *
     */
    protected function beforeUpdate()
    {
        $this->onBeforeUpdate(new CEvent($this));
    }

    /**
     * afterUpdate
     *
     */
    protected function afterUpdate()
    {
        $this->onAfterUpdate(new CEvent($this));
    }
}
