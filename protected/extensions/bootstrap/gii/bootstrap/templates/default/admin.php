<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<h2>Управление title</h2>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->pageTitle='Управление title';\n";
?>

$this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>array(        
        array('label'=>"Создать новый title", 'url'=>array('create')),       
    )));
    
Helpers::getFlash();
 
 $this->renderPartial('_tag',array('page'=>$page));   
?>


<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t'".$column->name."',\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>


<?php echo "<?php\n";?>
$message='Выберите title для удаления';
$deleteok='Выбранные title успешно удалены';
$confirm='Вы уверены, что желаете удалить выбранные title';
echo CHtml::ajaxlink('<i class="icon-trash icon-white"></i> Удалить выбранные',$this->createUrl('deletesome'),
        array(
            'type'=>'post',
            'cache'=>FALSE,
            'data' => "js:{ids:$.fn.yiiGridView.getSelection('<?php echo $this->class2id($this->modelClass); ?>-grid')}",
            'beforeSend'=>"function(data){
                           var ids;
                           ids=$.fn.yiiGridView.getSelection('<?php echo $this->class2id($this->modelClass); ?>-grid');                           
                           if(!ids.length) {alert('$message'); return false};
                           if(!confirm('$confirm')) return false;
                           }",           
            'success'=>"function(){
                            $('#<?php echo $this->class2id($this->modelClass); ?>-grid').yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid'); return false;
                            }",
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