<?php
$this->pageTitle=tt('Update slider title');
$str='изображение';
?>

<h2><?php echo tt('Update slider title').':'; ?></h2>

    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>array(
        array('label'=>tt('Manage slider'), 'url'=>array('admin')),       
        array('label'=>tt('Delete image'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>tt("Are you sure you want to delete this image?"))),
    ))); ?>

<?php echo CHtml::image('/images/slider/thumb/'.$model->img); ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>