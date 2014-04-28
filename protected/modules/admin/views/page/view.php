<?php $this->pageTitle='Просмотр страницы'; ?>

<h2>Просмотр страницы</h2>

    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>array(
        array('label'=>'Управление страницами', 'url'=>array('admin')),
        array('label'=>'Создать страницу', 'url'=>array('create')),
        array('label'=>'Редактировать страницу', 'url'=>array('update','id'=>$model->id)),
        array('label'=>"Удалить страницу", 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>tt('Are you sure you want to delete this item?'))),
     ))); ?>

<div class="well">
    <h3><?php echo CHtml::encode($model->title);?></h3> 
    <?php echo Yii::app()->format->formatHtml($model->text);?>
</div>



