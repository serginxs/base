<?php

class SiteController extends Controller {

  public function actionIndex() {

    $this->layout = '//layouts/main-page';
    $page = $this->getPageById(1);

    $this->render('index', array(
      'page' => $page
    ));
  }

  public function actionPage($alias) {
    $page = $this->getPage($alias);
    //if($page->type==0)
    //    $this->section = $page->id;
    // else
    //    $this->section = $page->type;
    $this->render('page', array('page' => $page));
  }

  /**
   * Displays the contact page
   */
  public function actionContacts() {
    $page = $this->getPageById(3);

    $model = new ContactForm;
    if (isset($_POST['ContactForm'])) {
      $model->attributes = $_POST['ContactForm'];
      if ($model->validate()) {
        $site = Yii::app()->params['site_name'];
        $prefix = " На сайте {$site} посетитель {$model->name} отправил письмо со страницы контактов.\n";
        Helpers::MailToAdmin($model->subject, $prefix . $model->body, $model->email);
        Yii::app()->user->setFlash('success', "Благодарим Вас, письмо успешно отправлено. Мы свяжемся с Вами максимально быстро.");
        $this->refresh();
      }
    }
    $this->render('contact', array('model' => $model, 'page' => $page));
  }

  public function actionSitemap() {


    $project_subitems = array();
    $dependency1 = new CGlobalStateCacheDependency('Cache.project');
    $progects = Project::model()->cache(param('cachingTime', 3600), $dependency1)->active()->findAll();
    foreach ($progects as $progect)
      $project_subitems[] = array('label' => $progect->title, 'url' => $progect->url);

    $news_subitems = array();
    $dependency2 = new CGlobalStateCacheDependency('Cache.news');
    $news = News::model()->active()->cache(param('cachingTime', 3600), $dependency2)->findAll();
    foreach ($news as $new)
      $news_subitems[] = array('label' => $new->title, 'url' => $new->url);

    $this->render('sitemap', array(
      'project_subitems' => $project_subitems,
      'news_subitems' => $news_subitems
    ));
  }

  /**
   * Displays the login page for Admin
   */
  public function actionAdmin() {
    if (Yii::app()->user->getState('isAdmin'))
      $this->redirect('/admin/main/index');

    $this->layout = '//layouts/admin'; //Подключаем новый шаблон.

    $model = new LoginForm;

    if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
    if (isset($_POST['LoginForm'])) {
      $model->attributes = $_POST['LoginForm'];
      if ($model->validate() && $model->login()) {
        $this->redirect('/admin/main/index');
      }
    }
    $this->renderPartial('login-admin', array('model' => $model));
  }

  /**
   * This is the action to handle external exceptions.
   */
  public function actionError() {
    if ($error = Yii::app()->errorHandler->error) {
      if (Yii::app()->request->isAjaxRequest)
        echo $error['message'];
      else
        $this->render('error', $error);
    }
  }

  public function actionLogin() {
    $model = new LoginForm;

    // if it is ajax validation request
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }

    // collect user input data
    if (isset($_POST['LoginForm'])) {
      $model->attributes = $_POST['LoginForm'];
      // validate user input and redirect to the previous page if valid
      if ($model->validate() && $model->login())
        $this->redirect(Yii::app()->user->returnUrl);
    }
    // display the login form
    $this->render('login', array('model' => $model));
  }

  public function actionLogout() {
    Yii::app()->user->logout();
    $this->redirect(Yii::app()->homeUrl);
  }

  public function actionTest() {
    $this->layout = '//layouts/bootstrap3';
    $this->render('test/bootstrap3');
  }

}