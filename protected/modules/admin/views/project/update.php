<?php
$this->pageTitle='Редактирование проекта'; 



Yii::app()->clientScript->registerScript('togle', "
$('.metatag').click(function(){
	$('.tag-form').slideToggle();       
	return false;
});
");
?>

<h2>Редактирование проекта: ID <?php echo $model->id;?></h2>

    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>array(
        array('label'=>'Управление', 'url'=>array('admin')),
        array('label'=>'Создание', 'url'=>array('create')),
        array('label'=>'Просмотр', 'url'=>array('view','id'=>$model->id)),
        array('label'=>"Удаление", 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>tt('Are you sure you want to delete this item?'))),
    ))); ?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
