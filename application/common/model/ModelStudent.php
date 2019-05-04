<?php
/**
 * Created by PhpStorm.
 * User: daquan
 * Date: 2019-04-25
 * Time: 11:22
 */

namespace app\common\model;


use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\Exception;
use think\exception\DbException;
use think\Model;

class ModelStudent extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'student';

    /**
     * 批量添加学生 事务处理
     * @param $students
     * @return mixed
     */
    public function insertStudents($students){
        //判定班级是否存在
        return $this->transaction(function () use ($students){
            $data=[];
            foreach ($students as $student){
                array_push($data,array(
                    'id'=>$student->id,
                    'name'=>$student->name,
                    'grade'=>$student->grade,
                ));
            }
            $this->table('student')->insertAll($data);
        });
    }

    /**
     * 添加班级批量添加学生 事务处理
     * @param $grade
     * @param $students
     * @return mixed
     */
    public function insertGradeStudents($grade,$students){
        return $this->transaction(function () use ($grade, $students){
            try {
                $this->table('grade')->insert(array(
                    'name'=>$grade
                ));
                $data=[];
                foreach ($students as $student){
                    array_push($data,array(
                        'id'=>$student->id,
                        'name'=>$student->name,
                        'grade'=>$student->grade,
                    ));
                }
                return $this->table('student')->insertAll($data);
            } catch (DataNotFoundException $e) {
            } catch (ModelNotFoundException $e) {
            } catch (DbException $e) {
            } catch (Exception $e) {
            }
            return false;
        });
    }

    /**
     * 查询全部班级
     * @return array 班级数组包含班级名字和人数
     */
    public function selectAllGrade(){
        try {
            $grades = [];
            $names[] = $this->table('grade')->field('name')->select();
            for ($i = 0;$i < count($names[0]);$i++){
                $name =  $names[0][$i]['name'];
                $count = $this->table('student')->where('grade',$name)->count('*');
                array_push($grades,array('name'=>$name,'count'=>$count));
            }
            return $grades;
        } catch (DataNotFoundException $e) {
        } catch (ModelNotFoundException $e) {
        } catch (DbException $e) {
        } catch (Exception $e) {
        }
        return null;
    }
}