<?php
namespace Main;
use DateTime;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;
class Employee
{
    private $id;
    private $name;
    private $salary;
    private $date;

    public function __construct($id,$name, $salary,$date)
    {
//        потом навесим на конструктор вадидаторы, пока так
        $validator = Validation::createValidator();
        $today=new DateTime('today');
        $violations = $validator->validate($id, [  //проверка id - только 6 цифр
            new Regex(['pattern' => '/^[0-9]{6}/']),
            new NotBlank(),
        ]);
        $violations->addAll($validator->validate($date, [   //дата должна быть датой
            new Date(),
            new NotBlank(),
        ]));
        $violations->addAll($validator->validate(new DateTime($date), [ //и еще дата кроме той, что еще не наступила
            new LessThan($today),
        ]));
        $violations->addAll($validator->validate($salary, [   //зарплата - положительное int число, ограничений нет
            new Type(['type' => 'integer']),
            new Positive(),
            new NotBlank(),
        ]));
        $violations->addAll($validator->validate($name, [ //имя это одно слово, состоит из букв одного алфавита с первой заглавной
            new Regex(['pattern' => '/^([А-ЯЁ][а-яё]{1,29})|([A-Z][a-z]{1,29})+$/u']),
            new NotBlank(),
        ]));
        if (0 !== count($violations)) {
            echo '<p style="color:darkred">Creating user failed</p>';
            foreach ($violations as $violation) {
                echo $violation->getMessage().'<br>';
            }
        }
        else{
            $this->name = $name;
            $this->salary = $salary;
            $this->id = $id;
            $this->date = new DateTime($date);
            echo '<p style="color:green">Creating user ' .$id. ' succeeded</p>';
        }

    }

    public function getName()
    {
        return $this->name;
    }

    public function getSalary()
    {
        return $this->salary;
    }
    public function getID()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }
    public function getExperience()
    {
        return date_diff(new DateTime(),$this->date)->y;
    }
}
