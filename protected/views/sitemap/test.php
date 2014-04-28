<?php 
 //echo'<pre>';
// print_r($items);
 //echo '</pre>';

 
 foreach ($items as $item) {
     foreach ($item['models'] as $model)
         echo $model['url'].'<br/>';
}
