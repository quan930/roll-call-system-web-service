<?php
/**
 * Created by PhpStorm.
 * User: daquan
 * Date: 2019-04-25
 * Time: 16:00
 */

namespace app\common\pojo;


class Course
{
    public $id;//课程id 数据库自增长
    public $name;//课程名称
    public $grade;//上课班级

    /**
     * Course constructor.
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