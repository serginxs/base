<?php 
Yii::app()->clientScript->registerScript('search', "
$('.metatag').click(function(){
	$('.tag-form').slideToggle();       
	return false;
});
");
?>

<h2><?php echo CHtml::encode($title); ?></h2>

<?php Helpers::getFlash(); ?>
<?php echo $this->renderPartial($page, array('model'=>$model,                                         
    )); ?>

