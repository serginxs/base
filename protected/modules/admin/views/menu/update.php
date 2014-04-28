<?php $this->pageTitle='Редактирование раздела меню'; ?>
<?php   Yii::app()->clientScript->registerScript('togle', "
$('.metatag').click(function(){
	$('.tag-form').slideToggle();       
	return false;
});
");
?>

<h2><?php echo "Редактирование раздела меню '{$model->title}'"; ?></h2>

    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>array(
        array('label'=>'Управление', 'url'=>array('admin')),
        array('label'=>'Создать', 'url'=>array('create')),
        array('label'=>"Удалить", 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>tt('Are you sure you want to delete this item?'))),
     ))); ?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>

