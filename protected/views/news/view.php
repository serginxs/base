<?php
$this->pageTitle = $news->title_tag ? $news->title_tag : $news->title;
$cs=Yii::app()->clientScript;
$cs->registerMetaTag($news->description,'description');
$cs->registerMetaTag($news->key_words,'keywords'); 

$this->breadcrumbs = array(
       'Новости'=>array('news/index'),
       $news->title
           );   
 
   
  echo '<h3>'.$news->title.'</h3>
        <span class="text-grey">'.$news->create_date.'</span>';   
?>
<div class="text-color-block l-blue clearfix">
    <div class="item-img pull-left">
        <?php echo CHtml::image($news->ImageThumbUrl,$news->title);?>
    </div>
    <div class="text-block">
        <?php echo Yii::app()->format->formatHtml($news->text);?>
    </div>
    <?php echo CHtml::link('Вернуться к списку новостей',array('news/index','alias'=>Yii::app()->user->getState('alias')));?>
</div>