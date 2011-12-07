<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<dl>
	<?php
	foreach ($schema as $key => $fieldDefinition):
		$attribute = $model->$key;
		$output = null;
		if (is_a($attribute, 'MongoDate')) {
			$output = strftime("%a, %d.%m.%y %T",$attribute->sec);
		} else if (is_a($attribute, 'lithium\data\entity\Document')) {
			$data = $attribute->to('array');
			$output = $this->view()->render(array(
				'element' => 'skeletons/elements/list'
			),array(
				'model' => $attribute,
				'schema' => $data
			));
		} else {
			$output = strip_tags($attribute);
		}
	?>
	<dt><?=$key?></dt>
	<dd><?php echo $output;?></dd>
	<?php endforeach;?>
</dl>