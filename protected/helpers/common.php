<?php
/* This file keeps helper functions and shotrctuts to reduce typing 
 * and typos in most popular code snippets we use throughout the system. 
 */



function param($name, $default = null) {
	if (isset(Yii::app()->params[$name]))
		return Yii::app()->params[$name];
	else
		return $default;
}

function isActive($url,$id=NULL){
   
  $route='/'.Yii::app()->controller->route;
  $id_param= Yii::app()->request->getQuery('id',NULL);
  if(in_array($route,$url))
  {
      if($id && $id_param)
      {
          if($id==$id_param)
              return true;
          else 
              return false;
      }
      return true;
  }
  return false;
}

function tt($string) {
	
        return Yii::t('admin', $string);	
}


function issetModule($module) {
    if (is_array($module)) {
        foreach ($module as $module_name) {
            if (!isset(Yii::app()->modules[$module_name])) {
                return false;
            }
        }
        return true;
    }
    return isset(Yii::app()->modules[$module]);
}


   
?>
