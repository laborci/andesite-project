<?php namespace Application\Component;

use Exception;
class Fetcher{

	public static function fetch($entityClass, $entities, $relation){
		/** @var \Andesite\Ghost\Model $model */
		$model = $entityClass::$model;
		if (!array_key_exists($relation, $model->relations)){
			throw new Exception('Fetcher - relation (' . $relation . ') not found in: ' . $entityClass);
		}

		$relation = $model->relations[$relation];
		if ($relation->type !== 'belongsTo'){
			throw new Exception('Fetcher - currently works only with belongs to relations');
		}

		$fld = $relation->descriptor['field'];
		$idset = [];
		foreach ($entities as $entity){
			if (!( $entity instanceof $entityClass )){
				throw new Exception('Fetcher - entity mismatch');
			}
			$idset[] = $entity->$fld;
		}
		$related = $relation->descriptor['ghost'];
		$related::collect($idset);
	}

}