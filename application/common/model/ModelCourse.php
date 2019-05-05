<?php
/**
 * Created by PhpStorm.
 * User: daquan
 * Date: 2019-04-25
 * Time: 15:55
 */

namespace app\common\model;


use app\common\pojo\Course;
use app\common\pojo\Grade;
use think\Model;

class ModelCourse extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'course';

    /**
     * 批量添加课程 事务处理
     * @param $courses array 课程对象
     * @return mixed
     */
    public function insertCourses($courses){
        return $this->transaction(function () use ($courses){
            $data=[];
            foreach ($courses as $course){
                array_push($data,array(
                    'name'=>$course->name,
                    'grade'=>$course->grade,
                ));
            }
            $this->saveAll($data);
        });
    }

    /**
     * 查询全部课程
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function selectAllCourses(){
        $courses=[];
        $list = $this->field('id,name,grade')->select();
        foreach ($list as $course){
            array_push($courses,new Course($course['id'],$course['name'],$course['grade']));
        }
        return $courses;
    }
}