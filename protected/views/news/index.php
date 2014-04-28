<?php
   $this->breadcrumbs = array('Новости');   
   
   echo '<h3>Новости</h3>';     
   $this->widget('zii.widgets.CListView', array(
                                'id'=>'news-list',
                                'dataProvider'=>$news,                                
                                'viewData'=>array('itemCount'=>$news->itemCount),
                                'itemView'=>'_news',                
                                'itemsCssClass'=>'news_items',
                                'emptyText'=>'Данный раздел наполняется',                                
                                'template' => "{sorter}{items}\n<br/>{pager}",                                                              
                        ));           
      
    
