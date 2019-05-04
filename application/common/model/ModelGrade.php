<?php
/**
 * Created by PhpStorm.
 * User: daquan
 * Date: 2019-05-04
 * Time: 14:00
 */

namespace app\common\model;


use app\common\pojo\Grade;
use think\Model;

class ModelGrade extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'grade';

    /**
     * @param $grade Grade 班级
     * @return false|int
     */
    public function insertGrade($grade){
        $this->data([
            'name'=>$grade->name
        ]);
        return $this->save();
    }
}