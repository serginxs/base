<?php $this->pageTitle="Создание проекта"; ?>

<?php   Yii::app()->clientScript->registerScript('togle', "
$('.metatag').click(function(){
	$('.tag-form').slideToggle();       
	return false;
});
");
?>

<h2>Создание проекта</h2>

    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>array(
        array('label'=>'Управление проектами', 'url'=>array('admin')),       
    ))); ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

