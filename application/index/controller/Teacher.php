<?php
/**
 * Created by PhpStorm.
 * User: daquan
 * Date: 2019-04-25
 * Time: 14:17
 */

namespace app\index\controller;


use app\common\pojo\Course;
use app\common\pojo\Student;
use think\Config;
use think\Controller;
use think\Request;

class Teacher extends Controller
{
    public function index(){
        echo phpinfo();
    }


    public function test(){
//        print_r(model("ModelStudent",'model')->selectAllGrade());
        Config::set("default_return_type","json");
        return json(array("description"=>"ok",'data'=>model("LogicStudent",'logic')->allGrade()),200);
    }
    /**
     * 添加学生和班级
     * @return \think\response\Json
     */
    public function addStudents()
    {
        Config::set("default_return_type","json");
        $list = input('post.students/a');
        $grade = input('grade');
        $students=[];
        for ($i=0;$i<count($list);$i++){
            array_push($students,new Student($list["$i"]['id'],$list["$i"]['name'],$list["$i"]['grade']));
        }
        $bool = model("LogicStudent","logic")->addStudents($grade,$students);
        if ($bool==1){
            return json(array("description"=>"ok"),200);
        }
        return json(array("description"=>"error", "detail"=>"data error"),400);
    }

    public function allGrade(){
        Config::set("default_return_type","json");
        return json(array("description"=>"ok",'data'=>model("LogicStudent",'logic')->allGrade()),200);
    }

    /**
     * 添加课程
     * @return \think\response\Json
     */
    public function addCourses(){
        Config::set("default_return_type","json");
        $list=input('post.courses/a');
        $courses=[];
        for ($i=0;$i<count($list);$i++){
            array_push($courses,new Course(null,$list["$i"]['name'],$list["$i"]['grade']));
        }
        $bool = model("LogicCourse","logic")->addCourses($courses);
        if ($bool===0){
            return json(array("description"=>"error", "detail"=>"data error"),400);
        }
        return json(array("description"=>"ok"),200);
    }

    /**
     * 全部课程
     * @return \think\response\Json
     */
    public function allCourses(){
        Config::set("default_return_type","json");
        $data = model("LogicCourse","logic")->allCourses();
        return json(array("description"=>"ok", "data"=>$data),200);
    }
}