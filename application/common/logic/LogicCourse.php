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
     * @param $courses array 课程数组
     * @return int 失败返回0 否则返回1
     */
    public function addCourses($courses){
        $bool = \model("ModelCourse","model")->insertCourses($courses);
        if ($bool===false)
            return 0;
        return $bool;
    }

    /**
     * 查询全部课程
     * @return mixed
     */
    public function allCourses(){
        return \model("ModelCourse","model")->selectAllCourses();
    }
}