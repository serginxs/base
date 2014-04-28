<?php

class SliderController extends ModuleAdminController
{
	public $modelName='Slider';    //Имя главной модели
        
        public function actions()
        {
            return array(
              'order' => array(
                  'class' => 'ext.OrderColumn.OrderAction',
                  'modelClass' => 'Slider',
                  'pkName'  => 'id',
                  ),
            );
        }
        
        public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                $model->scenario='update';
                

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Slider']))
		{
			$model->attributes=$_POST['Slider'];                       
			if($model->save())
                        {                            
                            Helpers::setFlash(tt('All data updated successfully'));
                            $this->redirect(array('admin'));
                        }
				
		}
                
		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	
       
	/**
	 * Manages all models.
	 */
        
        public function actionAdmin()
	{      
                          
             $model=new Slider('create');
             $criteria=new CDbCriteria;
                $criteria->select=array('sorter');
                $criteria->condition='sorter=(SELECT MAX(sorter)FROM tbl_slider)';
                $max = Slider::model()->find($criteria);
              
             if(isset($_POST['Slider']))
		{
			$model->attributes=$_POST['Slider'];
                        $model->sorter=$max?$max->sorter+1:1;
                        $model->active=1;             
                        
			if($model->save())
                        {                           
                               
                                Helpers::setFlash('Изображение для слайдера успешно загружено');
                                $this->refresh();
                        }
		}                
		$list=new Slider('search');
		$list->unsetAttributes();  
		if(isset($_GET['Slider']))
			$list->attributes=$_GET['Slider'];               
		$this->render('admin',array(
			      'list'=>$list,
                              'model'=>$model,                             
		));
	}
	


	public function loadModel($id)
	{
		$model=Slider::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='slider-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionToggle($id,$attribute)
        {
            
            if(Yii::app()->request->isPostRequest)
            {
                              
                $model = $this->loadModel($id);      
                
                $model->$attribute = ($model->$attribute==0)?1:0;
                $model->save(false);
                
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }
                else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
       }
}
