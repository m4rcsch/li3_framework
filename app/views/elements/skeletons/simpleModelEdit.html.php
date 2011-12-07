<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use lithium\util\Inflector;

$readonly = array('_id','id','created','updated');

if(!isset($backlink)){
	$backlink = '';
}

if(!isset($with)){
	$with = array();

}
?>

<?= $this->form->create($model); ?>
<?php
	$current_schema = $model->schema();
	if(!$current_schema && is_a($model, 'lithium\data\entity\Document')){
		$current_schema = $model->data();
		ksort($current_schema);
	}
	foreach($current_schema as $key => $fieldInfo){
		if(in_array($key, $readonly)){
?>
			<div class="formrow">
				<?=$key?> (readonly) : <?=$model->$key?>
				<?php $this->form->field($key, array('type' => 'hidden','value' => $model->$key)); ?>
			</div>
<?php
		} else {
			//ediatble:
			$modelname_lowercase = strtolower(strstr($key, '_id',true));
			$modelname_lowercase = Inflector::pluralize($modelname_lowercase);
			if($modelname_lowercase && array_key_exists($modelname_lowercase, $with)){
				echo $this->form->field($key, array(
					'label' => array(
						$key => array('class' => '')),
					'type' => 'select',
					'list' => $with[$modelname_lowercase],
					'wrap' => array(
						'class' => 'formrow'
					)
				));
			} else {
				$key_type = $model->schema($key);
				$type = ($key_type['type'] == 'text')?'textarea':'text';
				$type = ($key == 'password')?'password':$type;
				echo $this->form->field($key, array(
					'label' => array(
						$key => array('class' => '')),
					'type' => $type,
					'wrap' => array(
						'class' => 'formrow'
					)
				));
			}
		}

	}
?>
<?= $this->form->submit('erstellen/modifizieren'); ?>
<?= $this->html->link('Eingabe abbrechen',$backlink);?>
<?= $this->form->end(); ?>