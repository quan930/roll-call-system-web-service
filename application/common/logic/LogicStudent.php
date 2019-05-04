<?php
/**
 * Created by PhpStorm.
 * User: daquan
 * Date: 2019-04-25
 * Time: 11:42
 */

namespace app\common\logic;


use app\common\pojo\Grade;
use app\common\pojo\Student;
use think\Model;

class LogicStudent extends Model
{
    /**
     * 批量添加学生
     * @param $students array 学生数组
     * @param $grade string 班级名称
     * @return int 失败返回0 否则返回1
     */
    public function addStudents($grade,$students){
        //没有学生
        if (count($students)==0){
//            echo "没有学生";
            $boo = \model("ModelGrade","model")->insertGrade(new Grade($grade));
            if ($boo===false){
                return 0;
            }
            return 1;
        }
        //没有班级
        if ($grade===null){
//            echo "没有班级";
            $boo = \model("ModelStudent","model")->insertStudents($students);
            if ($boo===false)
                return 0;
            return 1;
        }
        //班级+学生
//        echo "班级+学生";
//        print_r($students);
        $bool = \model("ModelStudent","model")->insertGradeStudents($grade,$students);
        if ($bool===false)
            return 0;
        return 1;
    }

    /**
     * 添加班级
     * @param Grade $grade 班级
     * @return int 成功返回1 失败返回0 null返回-1
     */
    public function addGrade(Grade $grade){
        if ($grade->name==null)
            return -1;
        return \model("ModelGrade",'model')->insertGrade($grade);
    }

    /**
     * 全部班级 包含（名称，人数）
     * @return mixed Array 成功返回数据，否则返回null
     */
    public function allGrade(){
        return \model("ModelStudent",'model')->selectAllGrade();
    }
}