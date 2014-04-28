<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

// Global helper functions
require_once( dirname(__FILE__) . '/../helpers/common.php');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Alexander',
  'sourceLanguage' => 'en',
	'language' => 'ru',
  'defaultController'=>'/',//Устанавливаем страницу , с котрой грузится сайт.
  'homeUrl'=>'/',//Устанавливаем домашнюю страницу(переход по ссылке 'Главная')
  //'theme'=>'brightideas',//New theme

	// preloading 'log' component
	'preload'=>array(
		'log',
		'configuration', // preload configuration
	),
        'aliases'=>array(
            'bootstrap'=>dirname(__FILE__).'/../extensions/bootstrap',
            'editable'=>dirname(__FILE__).'/../extensions/editable'
        ),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*', 
                'application.components.behaviors.*', 
                'application.components.zii.*',
                'application.modules.configuration.components.*',
                'application.extensions.*',
                'application.extensions.jtogglecolumn.*',  
                'editable.*',                     
                'application.helpers.*',
                'application.widgets.*', 
                'application.extensions.gallerymanager.*',
                'application.extensions.gallerymanager.models.*',
	),

	'modules'=>array(
		
      'admin'=>array(
                   'defaultController'=>'main'),		
		  /*'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'morrowind',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                        'generatorPaths' => array(
                                           'application.gii',// Yii::t GRUD
                                           'bootstrap.gii',//Bootsrap GRUD
                                                  ),
		), */             
		
	),

	// application components
	'components'=>array(
		'user'=>array(                  
			'allowAutoLogin'=>true, // enable cookie-based authentication
                        'loginUrl' => array('user/login'),
                       // 'loginUrl' => array('site/index','access'=>'closed'),// При отсутсвии открывает модульное окно login
                       // 'loginUrl' => null, // При отсутсвии авторизации переводит на стр ошибки
		),                
		
		'configuration' => array(
			'class' => 'Configuration',			
		),
                'cache'=>array(
	              // 'class'=>'system.caching.CFileCache',
                         'class'=>'system.caching.CDummyCache',
		),
            
              'image'=>array(
                'class'=>'application.extensions.image.CImageComponent',//Расширение image
                'driver'=>'GD',
                  ),
                         
             //Bootsrap
             'bootstrap'=>array(
                'class'=>'bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
                  ),
           
		
	   'urlManager'=>array(  
                        'class'=>'UrlManager',
			'urlFormat'=>'path',
                        'showScriptName'=>false,
                        'urlSuffix' => '/',
			'rules'=>array(                                                                                             
                                array('sitemap/index', 'pattern'=>'sitemap.xml', 'urlSuffix'=>''),
                                '/' => 'site/index',                            
                                '<_c:(review|project)>/<alias:.+>' => '<_c>/view',
                                '<_c:(review|project)>' => '<_c>/index',
                                'contacts'=>'site/contacts',
                                'admin'=>'site/admin',                                
                                '<alias>'=>'site/page',                        
                                
                                //'<action:\w+>/<alias:.+>'=>'site/<action>', 
                               // '<action:\w+>'=>'site/<action>',                               
                                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',    
                                
			),
		),	
		
		// uncomment the following to use a MySQL database
		'db'=>require(dirname(__FILE__) . '/db.php'),
		
	
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
            'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',                                     
				),
				// uncomment the following to show log messages on web pages
				
				 array(
                                           'class' => 'CWebLogRoute',
                                           'categories' => 'example',
                                           'levels' => CLogger::LEVEL_PROFILE,
                                           'showInFireBug' => true,
                                           'ignoreAjaxInFireBug' => true,
                                       ),
                         
			  	array(
                                 // направляем результаты профайлинга в ProfileLogRoute (отображается
                                // внизу страницы)
                                       'class'=>'CProfileLogRoute',
                                        'levels'=>'profile',
                                        'enabled'=>true,
                                 ),             
                        
			),
		),
            
       'widgetFactory'=>array(
            'widgets'=>array(               
                'CGridView'=>array(
                   'template'=>"{summary}\n{items}\n{pager}",  
                   'cssFile'=>false,
                   'pagerCssClass'=>'text-center', 
                ),
                'CListView'=>array(
                    'pagerCssClass'=>'pagenator', 
                    'template'=>"{items}\n{pager}", 
                    'pagerCssClass'=>'text-center',                             
                ),
                'CLinkPager'=>array(                  
                         'header'=>'',
                         'cssFile'=>false,
                         'firstPageLabel'=>'Первая',
                         'lastPageLabel'=>'Последняя',
                         'nextPageLabel'=>'>>',
                         'prevPageLabel'=>'<<',
                         'selectedPageCssClass'=>'active',
                         'hiddenPageCssClass'=>'',
                          'htmlOptions'=>array( 'class'=>'pagination')
                         
                ),
               'TinyMce' => array(
                        'language' => 'ru',
                        'settings' => array(
                         // 'theme' => 'simple',
                          'skin' => 'default',
                          'width' => '50%',
                          'height' => '300px',
                          'theme_advanced_buttons1' => "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,link,unlink,anchor,|,forecolor,|,cleanup,code,|",
                          'theme_advanced_buttons2' => "",
                          'theme_advanced_buttons3' => "",
                          'theme_advanced_buttons4' => "",
                          'force_br_newlines' =>true,
                          'force_p_newlines' => false,
                          'forced_root_block' => '',
                        )),
               ),
            ),
            'editable' => array(
                    'class'     => 'editable.EditableConfig',
                    'form'      => 'bootstrap',        //form style: 'bootstrap', 'jqueryui', 'plain' 
                    'mode'      => 'popup',            //mode: 'popup' or 'inline'  
                    'defaults'  => array(              //default settings for all editable elements
                       'emptytext' => 'пусто',                       
                      
            ))
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                'rowPage'=>50,
                'translatedLanguages'=>array(
                    'ru'=>'Russian',
                    'en'=>'English',
                    'de'=>'Deutsch',
                ),
               'defaultLanguage'=>'ru',
	),
);