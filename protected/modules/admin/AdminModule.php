<?php

class AdminModule extends CWebModule
{
        public $layout='main';
        public $defaultController='main';
        
	public function init()        
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
                Yii::app()->setLanguage('ru');
		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));               
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
		  if(!Yii::app()->user->getState('isAdmin'))
                    {
                           // throw  new CHttpException('403',Yii::t('main','Вы не авторизованы для доступа.'));
                           Yii::app()->controller->redirect('site/admin');
                    }
			return true;
		}
		else
			return false;
	}
}
