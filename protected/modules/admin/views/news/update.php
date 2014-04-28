<?php
$this->pageTitle=tt('Update news'); 



Yii::app()->clientScript->registerScript('togle', "
$('.metatag').click(function(){
	$('.tag-form').slideToggle();       
	return false;
});
");
?>

<h2><?php echo tt('Update news').':'; ?></h2>

    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>array(
        array('label'=>tt('Manage news'), 'url'=>array('admin')),
        array('label'=>tt('Create news'), 'url'=>array('create')),
        array('label'=>tt('View news'), 'url'=>array('view','id'=>$model->id)),
        array('label'=>tt('Delete news'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>tt('Are you sure you want to delete this item?'))),
    ))); ?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
