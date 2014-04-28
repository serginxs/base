<?php $this->pageTitle=tt('Create news'); ?>

<?php   Yii::app()->clientScript->registerScript('togle', "
$('.metatag').click(function(){
	$('.tag-form').slideToggle();       
	return false;
});
");
?>

<h2><?php echo tt('Create news'); ?></h2>

    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>array(
        array('label'=>tt('Manage news'), 'url'=>array('admin')),       
    ))); ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

