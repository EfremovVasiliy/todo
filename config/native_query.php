<?php

use App\Core\DB;

require_once('vendor/autoload.php');
/**
 * @var $entityManager \Doctrine\ORM\EntityManager
 */
$entityManager = DB::db();

//$user = new \App\Entities\User();
//$user->setEmail('iroslav@iroslav.fe');
//$user->setNickname('iroslav');
//$user->setPasswordHash('qwerty');
//$entityManager->persist($user);
//$entityManager->flush();

$user = $entityManager->getRepository(\App\Entities\User::class)->getOne(1);

//$task = new \App\Entities\Task();
//$task->setTitle('Some else Miroslav\'s title');
//$task->setDescription('Some else Miroslav\'s description');
//$task->setUser($user);
//$task->setExpires(new DateTime('12-10-2023'));
//$entityManager->persist($task);
//$entityManager->flush();

//$qb = $entityManager->getRepository(\App\Entities\Task::class)->find(1);
//$task = $entityManager->getRepository('App\Entities\Task')->findBy(['id' => [1, 2, 3, 4]]);
//$task = $entityManager->getRepository(\App\Entities\Task::class)->getOne(1);
//$task[0]->setTitle('Doctrine');

$taskEnt = $entityManager->getRepository(\App\Entities\Task::class)->getAll();
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

$qb = $entityManager->createQueryBuilder();
$qb->select('t')->from('App\Entities\Task', 't')->join('App\Entities\User', 'u')->orderBy('t.title');
$query = $qb->getQuery();
$tasks = $query->getResult();
//foreach($user->getTasks() as $task) {
//    echo "<pre>";
//    print_r($task->getTitle());
//    echo "</pre>";
//}

echo "<pre>";
print_r($tasks[0]->getUser()->getEmail());
echo "</pre>";