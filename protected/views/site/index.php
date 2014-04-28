 <?php 
   $dependency_page= new CGlobalStateCacheDependency('Cache.page');
  if($this->beginCache('MainPage', array('duration'=>param('cachingTime',84000),'dependency'=>$dependency_page)))
     {;  ?>
        <?php echo  CHtml::image('/images/slider/thumb/slider__1398170313.jpg');?>
        <section class="services container hidden-xs">
          <div class="row">
            <div class="service col-sm-3 col-md-3">
              <?php echo CHtml::image('/css/images/clock.png');?>
              <p> 15 лет на рынке информационных технологий</p>
            </div>
            <div class="service col-sm-3 col-md-3">
              <?php echo CHtml::image('/css/images/target.png');?>
              <p>Лидер по внедрению различных программных продуктов</p>
            </div> 
            <div class="service col-sm-3 col-md-3">
              <?php echo CHtml::image('/css/images/check.png');?>
              <p>Полномасштабный спектр инновационных и комплексных проектных решений</p>
            </div>
            <div class="service col-sm-3 col-md-3">
              <?php echo CHtml::image('/css/images/like.png');?>
              <p>Высокое качество оказываемых услуг</p>
            </div>
          </div>             
        </section>
        
        <section class="about container">          
            <div class="text-block col-md-12">                    
                <?php echo $page->text;?>                                      
            </div>            
        </section>

        <section class="about container">          
            <div class="text-block col-md-12">                    
                <?php echo $page->text1;?>                                      
            </div>            
        </section>

        <?php $this->endCache();} ?>  
        

       
  
  
                   
