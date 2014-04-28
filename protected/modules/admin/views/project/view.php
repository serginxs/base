<?php $this->pageTitle='Просомтр проекта'; ?>

<h2>Просомтр проекта: <?php echo $model->title; ?></h2>

<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>array(
        array('label'=>'Редактирование', 'url'=>array('update','id'=>$model->id)),
        array('label'=>'Удаление','url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>tt('Are you sure you want to delete this item?'))),
        array('label'=>'Упраление', 'url'=>array('admin')),
        array('label'=>'Создание', 'url'=>array('create')),
       
    ))); 
?>
<div class="well min_height">     
    <h3><?php echo CHtml::encode($model->title); ?></h3>   
      
    <?php
    echo CHtml::image($model->ImageThumbUrl,'',array('class'=>'admin_img'));    
    echo $model->text; ?>
    <div class="clear"></div>
</div>

<?php echo $this->renderPartial('_gallery',array('model'=>$model)); ?>