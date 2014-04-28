<?php 
     $this->pageTitle='Карта сайта';
     $cs=Yii::app()->clientScript;
     $cs->registerMetaTag(Yii::app()->params['description'],'description');
     $cs->registerMetaTag(Yii::app()->params['key_words'],'keywords');
     $this->breadcrumbs=array('Карта сайта');
 ?>
<h3>Карта сайта</h3>
<div id="sitemap">
                <?php 
                $this->widget('zii.widgets.CMenu',array(
                  'id'=>'map',                  
                  'items'=>array( 
                                        array('label'=>'Главная', 'url'=>array('site/index')),  
                                        array('label'=>'О компании', 'url'=>array('site/about')),
                                        array('label'=>'Каталог', 'url'=>array('catalog/index')),
                                        array('label'=>'Доставка', 'url'=>array('site/delivery')),
                                        array('label' =>'Наши проекты','url' =>array('projects/index'),'items'=>$project_subitems),
                                         array('label' =>'Новости','url' =>array('news/index'),'items'=>$news_subitems),
                                        array('label'=>'Наши клиенты','url'=>array('partners/index')),  
                                        array('label'=>'Вопрос и ответ', 'url'=>array('site/faq')),
                                        array('label'=>'Отзывы', 'url'=>array('reviews/index')),
                                        array('label'=>'Контакты', 'url'=>array('site/contact')),                                                                      
                                        )));             
                ?>
 
</div>

<script>
$(".parent-menu").click(function()
                     {
                        $(this).next().slideToggle();                      
                        
                     });

</script>
