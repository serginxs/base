<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>        
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <title><?php echo CHtml::encode(Yii::app()->params['site_name'].'-Админка-'.$this->pageTitle); ?></title>
      
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/form.css" />
        <link rel="icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/css/images/favicon.png" />
        
</head>

<body id="top"> 
        
        <?php 
        $baseUrl = Yii::app()->request->baseUrl; 
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'type'=>'inverse',                       
            'brand'=>'<span class=logo>Администрирование - '.Yii::app()->params['site_name'].'</span>',
            'collapse'=>false,
            'brandUrl'=>$baseUrl.'/admin/main',
            'items'=>array(
                array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'items'=>array(                         
                       array('label'=>'Текстовые страницы', 'url'=>'#', 'items'=>array(                 
                           '---', 
                            array('label'=>'Главная','icon'=>'icon-list-alt','url'=>array('/admin/main/index')),
                            array('label'=>'О нас','icon'=>'icon-list-alt','url'=>array('/admin/main/page','id'=>2)),
                            array('label'=>'Как заказать','icon'=>'icon-list-alt','url'=>array('/admin/main/page','id'=>5)),                            
                            array('label'=>'Контакты','icon'=>'icon-list-alt','url'=>array('/admin/main/contact'),'active'=> isActive(array('/admin/main/contact'))),                     
                            array('label'=>'Управление подстраницами','icon'=>'icon-list-alt','url'=>array('/admin/page/admin'),'active'=>isActive(array('/admin/page/admin','/admin/page/create','/admin/page/update','/admin/page/view'))),
                            array('label'=>'Управление меню','icon'=>'icon-list-alt','url'=>array('/admin/menu/admin'),'active'=>isActive(array('/admin/menu/admin','/admin/menu/create','/admin/menu/update','/admin/menu/view'))),
                         )),  
                        array('label'=>'Проекты', 'url'=>'#', 'items'=>array(                 
                           '---',                                
                           array('label'=>'Управление проектами','icon'=>'icon-leaf','url'=>array('/admin/project/admin'),'active'=>isActive(array('/admin/project/admin','/admin/project/update','/admin/project/create','/admin/project/view'))),                         
                       )),
                     
                      /* array('label'=>'Новости', 'url'=>'#', 'items'=>array(                 
                           '---',                                
                           array('label'=>'Управление новостями','icon'=>'icon-leaf','url'=>array('/admin/news/admin'),'active'=>isActive(array('/admin/news/admin','/admin/news/update','/admin/news/create','/admin/news/view'))),                         
                       )),  
                   */
                      array('label'=>'Настройки','url'=>'#', 'items'=>array( 
                            '---',
                            array('label'=>'Общие настройки','icon'=>'icon-wrench','url'=>array('/admin/config/admin'),'active'=>  isActive(array('/admin/config/admin','/admin/config/update'))),                       
                          //  array('label'=>'Пароль администратора','icon'=>'icon-user','url'=>array('/admin/main/changeadminpass'),'active'=> isActive(array('/admin/main/changeadminpass'))),
                            array('label'=>'Очистить кэш','icon'=>'icon-wrench','url'=>array('/admin/main/clearcache'))
                       )),                         
              )),
                
                    
                 array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'htmlOptions' => array('class' => 'pull-right'),
                    'items' => array(                       
                        array('label' =>'','template'=>'<div class=home-link pull-right><a href="/"><img alt="home" src="/css/admin/images/home.png" title="На главную страницу"></a></div>',
                               'url' =>'/'),
                        array('label' =>'','template'=>'<div class=logout-link pull-right><a href="/site/logout"><img alt="logout" src="/css/admin/images/logout.png" title="Выход"></a></div>',
                               'url' =>'/site/logout'),
                       // array('label' =>'EN','url' =>array('','lang'=>'en')),
                      //  array('label' =>'RU','url' =>array('','lang'=>'ru')),
                        )),
            )
            
        ));  
        ?>    
        
       
	
<div class="bootnavbar-delimiter"></div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3">
            <div class="well sidebar-nav">
                <?php $this->widget('bootstrap.widgets.TbMenu',array(
                    'type'=>'list',                    
                    'items'=>array(                                           
                       array('label'=>'Текстовые страницы'),
                            array('label'=>'Главная','icon'=>'icon-list-alt','url'=>array('/admin/main/index')),
                            array('label'=>'О нас','icon'=>'icon-list-alt','url'=>array('/admin/main/page','id'=>2)),
                            array('label'=>'Как заказать','icon'=>'icon-list-alt','url'=>array('/admin/main/page','id'=>5)),                      
                            array('label'=>'Контакты','icon'=>'icon-list-alt','url'=>array('/admin/main/contact'),'active'=> isActive(array('/admin/main/contact'))),                            
                            array('label'=>'Управление подстраницами','icon'=>'icon-list-alt','url'=>array('/admin/page/admin'),'active'=>isActive(array('/admin/page/admin','/admin/page/create','/admin/page/update','/admin/page/view'))),               
                            array('label'=>'Управление меню','icon'=>'icon-list-alt','url'=>array('/admin/menu/admin'),'active'=>isActive(array('/admin/menu/admin','/admin/menu/create','/admin/menu/update','/admin/menu/view'))),
                      '---',  
                      array('label'=>'Проекты'),                                                  
                           array('label'=>'Управление проектами','icon'=>'icon-leaf','url'=>array('/admin/project/admin'),'active'=>isActive(array('/admin/project/admin','/admin/project/update','/admin/project/create','/admin/project/view'))),                         
                     '---',   
                     /* 
                      array('label'=>'Слайдер'),  
                            array('label'=>'Управление слайдером','icon'=>'icon-picture','url'=>array('/admin/slider/admin')),                         
                     '---',                                     
                    array('label'=>'Новости'),                                                  
                           array('label'=>'Управление новостями','icon'=>'icon-leaf','url'=>array('/admin/news/admin'),'active'=>isActive(array('/admin/news/admin','/admin/news/update','/admin/news/create','/admin/news/view'))),                         
                     '---',
                    * 
                    */                   
                     array('label'=>'НАСТРОЙКИ'),
                            array('label'=>'Общие настройки','icon'=>'icon-wrench','url'=>array('/admin/config/admin'),'active'=>  isActive(array('/admin/config/admin','/admin/config/update'))),                       
                         //   array('label'=>'Пароль администратора','icon'=>'icon-user','url'=>array('/admin/main/changeadminpass'),'active'=> isActive(array('/admin/main/changeadminpass'))),
                            array('label'=>'Очистить кэш','icon'=>'icon-wrench','url'=>array('/admin/main/clearcache'))
                    )
                ));              
                ?>
            </div>       
        </div>
        <div class="span9">
	   <?php echo $content; ?>	
        </div>
    </div>
 </div>
              
	<div id="footer">
		Разработано &copy; <?php echo date('Y'); ?> by  ChuiCo.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->






<?php Yii::app()->clientScript->registerCoreScript('jquery');?>   
</body>
</html>

