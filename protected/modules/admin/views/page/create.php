<?php $this->pageTitle="Создание страницы"; ?>
<?php   Yii::app()->clientScript->registerScript('togle', "
$('.metatag').click(function(){
	$('.tag-form').slideToggle();       
	return false;
});
");
?>



<h2><?php echo "Создание новой текстовой страницы"; ?></h2>
   
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

