
<div class="item row">  
    
        <!--<div class="hidden-xs hidden-sm col-md-2">
             <?php //echo CHtml::link(CHtml::image($data->ImageThumbUrl,$data->title,array('class'=>'img-list')),$data->url); ?>
        </div>-->
            
        <div class="item-content  col-xs-12  col-sm-12  col-md-12">
             <h4><?php  echo CHtml::encode($data->title);?></h4>           
             <div><?php echo $data->text;?></div>
        </div>     
    
</div>