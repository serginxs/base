<?php $this->pageTitle="Управление меню";?>

<h2><?php echo "Управление меню"; ?></h2>

    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>array(        
        array('label'=>"Создать новый раздел меню", 'url'=>array('create')),       
    ))); ?>
<?php Helpers::getFlash(); ?>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'menu-grid',
        'dataProvider'=>$model->search(),      
        'filter'=>$model,
        'type'=>'striped bordered condensed',	
        'template'=>"{headline}{summary}\n{items}\n{pager}",
        'summaryText'=>'Раздел: <strong>{start} - {end}</strong> из <strong>{count}</strong>',
        'selectableRows' => 2,	
       
	'columns'=>array(
	        	/*array(
                    'name'=>'id',
                    'htmlOptions'=>array(
                        'style'=>'width:25px;text-align:center;'
                    )),                 
                 */
            
                array(
                        'class'=>'CCheckBoxColumn',
                        'checkBoxHtmlOptions'=>array('class'=>'select-on-check'),               
                        'headerHtmlOptions'=>array('style'=>'width:25px;text-align:center;'),
                        'htmlOptions'=>array(
                        'style'=>'width:25px;text-align:center;',
                        'class'=>'checkbox-column',
                     )),
                array(
                        'name' => 'title',            
                        'value'=>'$data->title',                        
                     ),               
		            
                array(
                        'class' => 'editable.EditableColumn',
                        'name' => 'sorter',                        
                        'editable' => array(                           
                            'url' => $this->createUrl('edit'),                           
                            'placement' => 'right',
                            'inputclass' =>'input-mini',
                            'title'=>'Изменить позицию',
                            'emptytext'=>'',                            
                            'onSave' => 'js: function(e, params) {$.fn.yiiGridView.update("menu-grid");}'
                        ), 
                        'headerHtmlOptions'=>array('title'=>'Очерёдность страниц внутри своего раздела'),
                        'htmlOptions'=>array('style'=>'text-align:center;width:60px;'),
                        'filter'=>false
                     ),
                  array(
                     'class'=>'JToggleColumn',
                     'name'=>'active',                    
                     'checkedButtonLabel'=>'Не публиковать',
                     'uncheckedButtonLabel'=>'Публиковать', 
                     'htmlOptions'=>array('style'=>'text-align:center;width:85px;'),
                     'filter'=> CHtml::dropDownList('Page[active]',$_GET[Page][active],array(0=>'Нет',1=>'Да'),array('prompt'=>'Все')), 
                                                                ),
		            array(
		              	'class'=>'bootstrap.widgets.TbButtonColumn',  
                        'template'=>'{update}{delete}',
                        'htmlOptions'=>array(
                         'style'=>'width:140px;text-align:center;vertical-align:middle;')
	                    	),             
	),
)); ?>
 
 <?php
$message='Выберите разделыдлы удаления';
$deleteok='Выбранные разделы успешно удалены';
$confirm='Вы уверены, что желаете удалить выбранные разделы';
echo CHtml::ajaxlink('<i class="icon-trash icon-white"></i> Удалить выбранные',$this->createUrl('deletesome'),
        array(
            'type'=>'post',
            'cache'=>FALSE,
            'data' => "js:{ids:$.fn.yiiGridView.getSelection('menu-grid')}",
            'beforeSend'=>"function(data){
                           var ids;
                           ids=$.fn.yiiGridView.getSelection('menu-grid');                           
                           if(!ids.length) {alert('$message'); return false};
                           if(!confirm('$confirm')) return false;
                           }",           
            'success'=>'function(){
                            $("#style-grid").yiiGridView.update("menu-grid"); return false;
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
