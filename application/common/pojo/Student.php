<?php
/**
 * Created by PhpStorm.
 * User: daquan
 * Date: 2019-04-25
 * Time: 11:11
 */

namespace app\common\pojo;


class Student
{
    public $id;//学号
    public $name;//学生名字
    public $grade;//班级名称

    /**
     * Student constructor.
     * @param $id
     * @param $name
     * @param $grade
     */
    public function __construct($id, $name, $grade)
    {
        $this->id = $id;
        $this->name = $name;
        $this->grade = $grade;
    }


}