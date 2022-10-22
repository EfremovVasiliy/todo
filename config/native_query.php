<?php

use App\Core\DB;

require_once('vendor/autoload.php');
/**
 * @var $entityManager \Doctrine\ORM\EntityManager
 */
$entityManager = DB::db();

$qb = $entityManager->getRepository(\App\Entities\Task::class)->find(1);
//$task = $entityManager->getRepository('App\Entities\Task')->findBy(['id' => [1, 2, 3, 4]]);
//$task = $entityManager->getRepository(\App\Entities\Task::class)->getOne(1);
//$task[0]->setTitle('Doctrine');
//$entityManager->persist($task);
//$entityManager->flush();

//$dql = "SELECT task FROM App\Entities\Task task WHERE task.id > :id";
//$rsm = new \Doctrine\ORM\Query\ResultSetMappingBuilder($entityManager);
//$rsm->addRootEntityFromClassMetadata('App\Entities\Task', 'task');

//$rsm->addEntityResult('App\Entities\Task', 'task');
//
//$rsm->addFieldResult('task', 'id', 'id');
//$rsm->addFieldResult('task', 'title', 'title');
//$rsm->addFieldResult('task', 'description', 'description');

//$query = $entityManager->createQuery($dql);
//$query->setParameter(':id', 1);
//$tasks = $query->getResult();

echo "<pre>";
print_r($qb);
echo "</pre>";