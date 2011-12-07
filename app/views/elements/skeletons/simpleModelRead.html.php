<?php
/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/

$current_schema = $model->schema();
if (!$current_schema && is_a($model, 'lithium\data\entity\Document')){
	$current_schema = $model->data();
}

?>
<div>
<?=$this->view()->render(array(
		'element' => 'skeletons/elements/list'
	),array(
		'model' => $model,
		'schema' => $current_schema
	));?>
</div>