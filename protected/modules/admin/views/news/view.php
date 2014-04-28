<?php $this->pageTitle=tt('View news'); ?>

<h2><?php echo tt('View news'); ?></h2>

<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>array(
        array('label'=>tt('Update news'), 'url'=>array('update','id'=>$model->id)),
        array('label'=>tt('Delete news'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>tt('Are you sure you want to delete this item?'))),
        array('label'=>tt('Manage news'), 'url'=>array('admin')),
        array('label'=>tt('Create news'), 'url'=>array('create')),
       
    ))); 
?>
<div class="well min_height">     
    <h3><?php echo CHtml::encode($model->title); ?></h3>    
       <span  style="font-size: 14px; color: #808080"> Дата создания:  <?php echo Yii::app()->dateFormatter->format("dd MMMM y", $model->create_time);  ?>
       <br/>Последнее изменение:  <?php echo Yii::app()->dateFormatter->format("dd MMMM y", $model->update_time);  ?></span>
       <br/><br/>   
   
    <?php
    echo CHtml::image($model->ImageThumbUrl,'',array('class'=>'admin_img'));
    echo $model->text; ?>
    <div class="clear"></div>
</div>

