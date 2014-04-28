<?php
$this->pageTitle=tt('Manage slider'); 

?>

<h2><?php echo tt('Manage slider'); ?> <small> главной страницы</small></h2>


<div class="well">
        <legend>Загрузка изображений к слайдеру</legend>
            <?php Helpers::getFlash(); ?>  
            <?php echo $this->renderPartial('_form', array(
                'model'=>$model                      
                )); ?>      
                 
</div>


<?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Управление слайдером',
                   // 'type'=>'danger',
                    'htmlOptions'=>array(
                        'data-title'=>'<strong>1</strong>: Нажатием на стрелочки Вы можете выбирать очерёдность вывода изображений в слайдере.<br/>',                                    
                        'data-content'=>'<strong>2</strong>:Нажатием на кнопочку публиковать, Вы указываете нужно ли выводить это избражение или нет.<br/>                                       
                                         <strong>3</strong>:Кнопка редактировать ведёт на страницу изменения url текущего изображения. <br/>', 
                        'data-style'=>'width:300px;',
                        'rel'=>'popover',                        
                        ),
  )); ?>  
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'slider-grid',
	'dataProvider'=>$list->search(),
	'filter'=>$list,
        'type'=>'striped bordered condensed',
        'template'=>"{summary}\n{items}\n{pager}",
        'summaryText'=>'Всего изображений: <strong>{count}</strong>',
        'selectableRows' => 2,
	'columns'=>array(
	       array(
                        'class'=>'CCheckBoxColumn',
                        'checkBoxHtmlOptions'=>array('class'=>'select-on-check'),               
                        'headerHtmlOptions'=>array('style'=>'width:25px;text-align:center;'),
                        'htmlOptions'=>array(
                        'style'=>'width:25px;text-align:center;',
                        'class'=>'checkbox-column',
                     )),
               array(
                    'header'=>'№',
                    'name'=>'sorter',
                    'htmlOptions'=>array('style'=>'width:20px;text-align:center;'),
                    'filter'=>false
                ),
               array(
                       "header"=>'Фото',
                       'name'=>'img',
                       'type'=>'raw',
                       'value'=>'CHtml::image($data->ImageThumbUrl,$data->img,array( 
                           "title"=>$data->img ,
                           "width"=>"100",
                           "height"=>"100"))',
                     //s  'htmlOptions'=>array('style'=>'width:85px;text-align:center;'),
                        'filter'=>false
               ),
	       array(
                        'class' => 'ext.editable.EditableColumn',
                        'name' => 'url',                        
                        'editable' => array(                           
                            'url' => $this->createUrl('edit'),                           
                            'placement' => 'left',
                            'inputclass' => 'input-large',
                            'emptytext'=>'',                            
                        ), 
                        'filter'=>false
                     ),
         
                array(
                          'header' => 'Позиция',
                          'name' => 'sorter',
                          'class' => 'ext.OrderColumn.OrderColumn',
                          'htmlOptions'=>array(
                              'style'=>'width:100px;text-align:center;'),
                ),	
	        array(
                    'class'=>'JToggleColumn',
                    'name'=>'active',                    
                    'checkedButtonLabel'=>'Не публиковать',
                    'uncheckedButtonLabel'=>'Публиковать', 
                    'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                    'filter'=> CHtml::dropDownList('Slider[active]',$_GET[Slider][active],array(0=>'Нет',1=>'Да'),array('prompt'=>'Все')), 
                ),		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{update}{delete}',
                        'htmlOptions'=>array('style'=>'text-align:center;width:80px;'),
                    ),
	),
)); ?>

 <?php
$message='Выберите изображения для удаления';
$deleteok='Выбранные изображения успешно удалены';
$confirm='Вы уверены, что желаете удалить выбранные изображения';
echo CHtml::ajaxlink('<i class="icon-trash icon-white"></i> Удалить выбранные',$this->createUrl('deletesome'),
        array(
            'type'=>'post',
            'cache'=>FALSE,
            'data' => "js:{ids:$.fn.yiiGridView.getSelection('slider-grid')}",
            'beforeSend'=>"function(data){
                           var ids;
                           ids=$.fn.yiiGridView.getSelection('slider-grid');                           
                           if(!ids.length) {alert('$message'); return false};
                           if(!confirm('$confirm')) return false;
                           }",           
            'success'=>'function(){
                            $("#style-grid").yiiGridView.update("slider-grid"); return false;
                            }',
            'complete'=>"function(){
                           // alert('Selected images were successfully removed');
                           $('#statusMsg').html('<div class=flash-success>$deleteok</div>');
                            }"
        ),
        array(            
             'class'=>'mybutton',
             'class'=>'btn btn-danger',
             'type' => 'submit',       
             )
 );
?>
