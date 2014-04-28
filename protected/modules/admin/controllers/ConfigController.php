<?php

class ConfigController extends ModuleAdminController
{
    public $modelName='Config'; 


    public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Config('create');		

		if(isset($_POST['Config']))
		{
			$model->attributes=$_POST['Config'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}


	public function actionUpdate($id)
	{
               $model=$this->loadModel($id);
               $ajax= Yii::app()->request->getPost('ajax',null);
               
               if($ajax)
                {
                    
                    Yii::app()->clientscript->scriptMap['jquery.js'] = false;
                    Yii::app()->clientscript->scriptMap['jquery.min.js'] = false;
                    Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
                    $this->renderPartial('update',array(
			'model'=>$model,
                        'ajax'=>$ajax,
                        false,true
		));
                }
	}

        
       public function actionUpdateAjax()
        {
            $id = Yii::app()->request->getPost('id');
            $val = Yii::app()->request->getPost('val', '');

            if(!$id){
                Helpers::setFlash('Введите необходимые значения','error');
                echo 'error_save';
                Yii::app()->end();
            }
            $model = Config::model()->findByPk($id);
            $model->value = $val;
            
            if($model->save())
                Helpers::setFlash('Данные успешно обновлены');                
             else 
                Helpers::setFlash($model->getError('value'),'error');
               // echo 'error_save';
            
       }
   
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Config');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Config('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Config']))
			$model->attributes=$_GET['Config'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Config::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='config-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
       
}
