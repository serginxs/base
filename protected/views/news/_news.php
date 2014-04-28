
<div class="item row">  
    
        <div class="hidden-xs hidden-sm col-md-2">
             <?php echo CHtml::link(CHtml::image($data->ImageThumbUrl,$data->title,array('class'=>'img-list')),$data->url); ?>
        </div>
            
        <div class="item-content  col-xs-12  col-sm-12  col-md-10">
             <h4><?php  echo CHtml::link($data->title,$data->url);?></h4>
             <p item-stat ><span><?php echo $data->create_date;?></span></p>
             <p class="short"><?php echo $data->short;?></p>
        </div>     
    
</div>