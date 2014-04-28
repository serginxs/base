<?php
/*
 * Behavior for cashing by Global State
 * example
 * Use fragment caches as usual, using CGlobalStateCacheDependency and using the appropriate global state variable e.g. Cache.post
<?php
        if($this->beginCache('postindex', array('dependency'=>array(
                                        'class'=>'system.caching.dependencies.CGlobalStateCacheDependency',
                                        'stateName'=>'Cache.post')))) { ?>
        //e.g. output post+author info
 * Therefore in the above example, if a post or author is updated/deleted,
 *  global states Cache.post and Cache.author are updated, causing any fragment caches with a dependency on either of these global states to refresh.
 */


class CacheBehavior extends CActiveRecordBehavior
{
   
 
       public function afterSave($event)
	{
                $this->updateCacheDependencies();                 
	}

        
        public function afterDelete($event)
        {               
                $this->updateCacheDependencies();
        }

        public function updateCacheDependencies()
        {
                //Update timestamps on related models so that view caches get updated
                $cacheUpdates = array();                
                $cacheKey='Cache.'.$this->getOwner()->tablename();                
                $cacheUpdates[] = str_replace(array('{','}'),'',$cacheKey);                
                $relations = $this->getOwner()->relations();
                
                foreach($relations as $relation)
                        $cacheUpdates[] = 'Cache.'.strtolower($relation[1]);                

                foreach($cacheUpdates as $cacheUpdate)
                {
                        Yii::app()->setGlobalState($cacheUpdate, time());
                        Yii::app()->saveGlobalState();
                }                
               
        }

}
?>
