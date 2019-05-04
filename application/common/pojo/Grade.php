<?php
/**
 * Created by PhpStorm.
 * User: daquan
 * Date: 2019-05-04
 * Time: 14:04
 */

namespace app\common\pojo;


//班级表
class Grade
{
    public $name;//班级名称

    /**
     * Grade constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
}