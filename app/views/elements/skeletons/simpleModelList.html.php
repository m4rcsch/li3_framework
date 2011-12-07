<?php

use lithium\util\Inflector;

?>
<table>
		<?php
		$cachedSchema = array();
		foreach ($modelList as $model):
			$current_modelname = $model->model();
			$current_schema = $model->schema();
			if(!$current_schema && is_a($model, 'lithium\data\entity\Document')){
				$current_schema = $model->data();
				ksort($current_schema);
			}
			if (array_keys($cachedSchema) != array_keys($current_schema)):
				$cachedSchema = $current_schema;
				echo '<tr>';
				foreach ($cachedSchema as $key => $fieldInfo):
					$modelname_lowercase = strtolower(strstr($key, '_id',true));
					if ($modelname_lowercase && array_key_exists($modelname_lowercase, $model->data())) {
						$key = Inflector::camelize($modelname_lowercase);
					}
					?>

					<th style="border-bottom:1px solid; margin:0px;"><?= $key ?></th>

					<?php
				endforeach;
					?>
					<th style="border-bottom:1px solid; margin:0px;">Actions:</th></tr>
					<?php
			endif;
			echo '<tr>';

			//var_dump($model->relations());
			//die();
			foreach ($cachedSchema as $key => $fieldInfo):
				$string = $model->$key;
				if (is_a($string, 'MongoDate')) {
					$string = strftime("%a, %d.%m.%y %T",$string->sec);
				}
				//relations
				$modelname_lowercase = strtolower(strstr($key, '_id',true));
				if ($modelname_lowercase && array_key_exists($modelname_lowercase, $model->data())) {
					$related_modelname = Inflector::pluralize(Inflector::camelize($modelname_lowercase));
					$related_modelname = $current_modelname::relations($related_modelname)->to();
					$key = $related_modelname::meta('title');
					$string = $model->$modelname_lowercase->$key;
				}
		?>

				<td valign="top"><div class="expandable"<p><?php echo ($key == 'password')?'"encrypted"':strip_tags($string); ?></p><div></td>
		<?php
			endforeach;
			$id_key = $model->key();
			$id = $model->$id_key;
		?>
				<td valign="top">
					<nav>
						<?=$this->html->link('editieren',$this->Request()->controller . '/update/' . $id)?> |
						<?=$this->html->link('details',$this->Request()->controller . '/read/' . $id)?> |
						<?=$this->form->create($model,array(
							'action' => 'delete/' . $id,
							'method' => 'delete'
						)) ?>
							<?=$this->form->submit('delete') ?>
						<?=$this->form->end();?>
					</nav>
				</td>
		<?php
			echo '</tr>';

		?>
	</tr>
	<?php
		endforeach;
	?>
</table>