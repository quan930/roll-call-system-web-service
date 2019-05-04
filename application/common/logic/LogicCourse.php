<?php
/**
 * Created by PhpStorm.
 * User: daquan
 * Date: 2019-04-25
 * Time: 16:18
 */

namespace app\common\logic;


use think\Model;

class LogicCourse extends Model
{
    /**
     * 批量添加课程
     * @param $course array 课程数组
     * @return int 失败返回0 否则返回1
     */
    public function addCourse($course){
        $bool = \model("ModelCourse","model")->insertCourses($course);
        if ($bool===null)
            return 0;
        if ($bool===false)
            return 0;
        return 1;
    }
}