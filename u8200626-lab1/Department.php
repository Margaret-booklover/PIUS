<?php
namespace Main;
use ArrayObject;

class Department
{
    private $name;
    private $rabs;
    public function __construct($name, $list)
    {
        $this->name=$name;
        $this->rabs=new ArrayObject($list);
    }
    public function getName()
    {
        return $this->name;
    }

    public function getRabs()
    {
        return $this->rabs;
    }
    public function getSum()
    {
        $sum = 0;
        foreach ($this->rabs as $rab)
        {
            $sum=$sum+$rab->getSalary();
        }
        return $sum;
    }

}