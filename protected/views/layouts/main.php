<!DOCTYPE html>
<html lang="ru">
<head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <title><?php echo CHtml::encode($this->pageTitle).' | '.Yii::app()->params['site_name']; ?></title>   
	
   <!-- CSS -->
   <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" /> 
   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" /> 
  
   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
   <![endif]-->
   <!--[if IE ]>
      <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" /> 
   <![endif]-->
   <link rel="icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/css/images/favicon.png" />
   
</head>
<body>
    <div id="page"> 
        <header> 
          
            <section id="header-center" class="container">           
                    <div class="row">                        
                        <div class="hidden-xs  col-sm-4 col-md-4">
                            <?php echo CHtml::link(CHtml::image('/css/images/logo.png',Yii::app()->params['site_name'],array('class'=>'logo img-responsive')),array('/site/index'));?>                            
                       <!-- </div>
                        <div class="site-name col-sm-2  col-md-2 ">-->
                          <h1 class="site-name">
                            <?php echo CHtml::link(CHtml::image('/css/images/name.png',Yii::app()->params['site_name'],array('class'=>'img-responsive')),array('/site/index'));?>                           
                          </h1>
                        </div>
                        <div class="contact-block text-right col-sm-4  col-md-4 col-md-offset-4">
                            <p class="phone"><?php echo CHtml::encode(Yii::app()->params['phone']);?></p> 
                            <?php echo CHtml::link(Yii::app()->params['adminEmail'],'mailto:'.Yii::app()->params['adminEmail'].'');?>                                               
                        </div>
                    </div>
                                                                
                </section><!-- top-header --> 
                    
        </header>
       <!--Main menu-->
                 <nav class="navbar navbar-default container" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">                                
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                             </button>                            
                         </div>
                         <div class="collapse navbar-collapse">
                              <?php $this->widget('zii.widgets.CMenu',array(
                                                      'id'=>'menu', 
                                                      'htmlOptions'=>array('class'=>'nav navbar-nav'),
                                                      'items'=>Menu::Items()
                                 )); ?>
                          </div>
                   </nav><!-- mainmenu -->           
        <!--Page content-->              
      <?php echo $content; ?>                
        
        
   </div><!-- page -->
     <footer id="footer">
       <div class="container">
         <div class="row">
          <div class="col-sm-3 col-md-3">&copy; 2014 Alfinit Все права защищены</div>
          <div class="col-sm-9 col-md-9  text-right">                
                   <?php 
                         echo CHtml::link( 'О компании',array('/site/page','alias'=>'about'))
                             .CHtml::link( 'Услуги',array('/site/page','alias'=>'services'))
                             .CHtml::link( 'Технологии',array('/site/page','alias'=>'technology'))                             
                             .CHtml::link( 'Контакты',array('/site/page','alias'=>'contacts'))                   
                    ;?>               
           </div>
          </div>
       </div>
    </footer><!-- footer -->




 <?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>  
 <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/bootstrap/js/bootstrap.min.js');?>
 <script src="/js/main.js"></script>
 <?php $this->widget('ext.etoastr.EToastr',array('flashMessagesOnly'=>true,'message'=>'will be ignored')); ?>

</body>
</html>
