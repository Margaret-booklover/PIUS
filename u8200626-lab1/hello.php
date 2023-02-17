<?php
require '../vendor/autoload.php';
use Main\Employee;
use Main\Department;
echo "Hello from PHP <br>";
echo "<h1>Задание 1</h1>";
echo "<b>Пример 1. Создание пользователя с верными параметрами</b><br>";
$user1 = new Employee(123457, 'Иван', 2000, '2021-01-31');
echo "<p>Стаж работника(полных лет) ".$user1->getExperience()."</p>";
echo "<b>Пример 2. Создание пользователя с еще не наступившей датой</b><br>";
$user2 = new Employee(123456, 'Иван', 2000, '2025-01-31');
echo "<b>Пример 3. Создание пользователя с неверным значением зарплаты</b><br>";
$user3 = new Employee(123458, 'Иван', -200.0, '2021-01-31');
echo "<b>Пример 4. Создание пользователя с некорректным id</b><br>";
$user4 = new Employee(457, 'Иван', 2000, '2021-01-31');
echo "<b>Пример 5. Создание пользователя с не удовлетворяющим условию именем</b><br>";
$user5 = new Employee(123450, 'иван', 2000, '2021-01-31');
echo "<b>Пример 6. Создание пользователя с пустыми полями</b><br>";
$user6 = new Employee('', '', '', '');
echo "<h1>Задание 2</h1>";
echo "<p>Создадим армию работников чтобы было кого рассаживать по отделам</p>";
$rab1 = new Employee(100000, 'Петр', 25000, '2000-10-30');
$rab2 = new Employee(100001, 'Екатерина', 25000, '2005-02-28');
$rab3 = new Employee(100002, 'Василий', 20000, '2020-04-17');
$rab4 = new Employee(100003, 'Евгений', 20000, '1999-12-31');
$rab5 = new Employee(100004, 'Марта', 10000, '1980-08-02');
$rab6 = new Employee(100005, 'Савелий', 40000, '1995-07-21');
$rab7 = new Employee(100006, 'Артем', 74000, '2002-07-11');

$dep1=new Department('Маркетинг',array($rab1,$rab2));
$dep2=new Department('Бухгалтерия',array($rab3,$rab4,$rab5));
$dep3=new Department('Отдел кадров',array($rab6,$rab7));
$dep=array($dep1,$dep2,$dep3);
$dep_min=array();
$dep_max=array();
$min=$dep[0]->getSum();
$max=$min;
for ($i=0;$i<count($dep);$i++)
{
    $temp=$dep[$i]->getSum();
    if ($temp>$max)
    {
        $dep_max=array($dep[$i]);
        $max=$temp;
    }
    else if ($temp==$max)
    {
        array_push($dep_max,$dep[$i]);
    }
    if ($temp<$min)
    {
        $dep_min=array($dep[$i]);
        $min=$temp;
    }
    else if ($temp==$min)
    {
        array_push($dep_min,$dep[$i]);
    }
}
$temp_ar=array();
foreach ($dep_max as $dept)
    array_push($temp_ar,count($dept->getRabs()));
$max=max($temp_ar);

foreach ($dep_max as $dept)
{
    if (count($dept->getRabs())==$max)
        echo "<p>Department with max salary".$dept->getName()." with sum ".$dept->getSum()."</p>";
}
$temp_ar=array();
foreach ($dep_min as $dept)
    array_push($temp_ar,count($dept->getRabs()));
$max=max($temp_ar);

foreach ($dep_min as $dept)
    if (count($dept->getRabs())==$max)
         echo "<p>Department with min salary".$dept->getName()." with sum ".$dept->getSum()."</p>";
















