/**
 * 判断登陆 否则进入登陆界面
 * 执行首页数据方法
 */
window.onload=function () {
    Vue.component('roll-call', {
        props: {
            home: Object
        },
        template:
            `<div style="height: 100%;background-color: aquamarine">
                <el-row>
                    <el-col :span="2">
                        <h1>签到</h1>
                    </el-col>
                </el-row>
            </div>`
    })
    // 课程页面
    Vue.component('course-page', {
        props: {

        },
        template:
            `<div style="height: 100%;background-color: #5daf34">
                <el-row>
                    <el-col :span="2">
                        <h1>课程页面</h1>
                    </el-col>
                </el-row>
            </div>`
        ,methods: {
        }
    })
    //班级页面
    Vue.component('grade-page', {
        props: {
            grades: Object,
        },
        template:
            `<div style="height: 100%;">
                <el-row>
                    <el-col :span="2">
                        <h1>班级页面</h1>
                    </el-col>
                    <el-col :span="2" :offset="19">
                        <el-button v-if="grades.fun==1" style="margin-top: 30px" size="mini" type="primary" v-on:click="toreturn">返回</el-button>
                        <el-button v-else style="margin-top: 30px" size="mini" type="primary" v-on:click="addGrade">添加班级</el-button>
                    </el-col>
                    <el-col :span="24">
                        <el-row style="background-color: white">
                            <div v-if="grades.fun==1" style="background-color: white">
                                <el-col :span="8">
                                    <el-input placeholder="请输入内容" v-model="grades.upload.grade">
                                        <template slot="prepend">班级名称</template>
                                    </el-input>
                                    </el-col>
                                    <el-col :span="6" :offset="4">
                                        <el-button v-on:click="addStudent">添加学生</el-button>
                                    </el-col>
                                    <el-col :span="6">
                                        <el-button type="danger" v-on:click="upload">提交</el-button>
                                    </el-col>
                                    <el-table :data="grades.upload.students"
                                        height="350"
                                        border
                                        style="width: 100%">
                                        <el-table-column label="学号">
                                            <template slot-scope="scope">
                                                <el-input v-model="grades.upload.students[scope.$index].id" placeholder="请输入内容"></el-input>
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="名字">
                                            <template slot-scope="scope">
                                                <el-input v-model="grades.upload.students[scope.$index].name" placeholder="请输入内容"></el-input>
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="班级">
                                            <template slot-scope="scope">
                                                <el-input v-model="grades.upload.grade" :disabled="true"></el-input>
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="操作">
                                            <template slot-scope="scope">
                                                <el-button size="mini" type="danger" v-on:click="removeStudent(scope.$index)">删除</el-button>
                                            </template>
                                        </el-table-column>
                                    </el-table>
                            </div>
                            <div v-else>
                                <el-table :data="grades.grades"
                                    height="350"
                                    border
                                    style="width: 100%">
                                    <el-table-column
                                            prop="name"
                                            label="名称">
                                    </el-table-column>
                                    <el-table-column
                                            prop="count"
                                            label="人数">
                                    </el-table-column>
                                    <el-table-column label="操作">
                                        <template slot-scope="scope">
                                            <el-button size="mini" type="danger" v-on:click="show(scope.$index)">查看</el-button>
                                        </template>
                                    </el-table-column>
                                </el-table>
                            </div>
                        </el-row>
                    </el-col>
                </el-row>
            </div>`,
        methods: {
            //添加班级
            addGrade(){
                app.grades.fun=1;
            },
            //返回按钮
            toreturn(){
                app.grades.upload.grade='';
                app.grades.upload.students=[];
                app.grades.fun=0;
            },
            //添加学生
            addStudent(){
                app.grades.upload.students.push({'id':'','name':''})
            },
            //添加页面删除
            removeStudent(index){
                app.grades.upload.students.splice(index, 1)
            },
            upload(){
                //addStudents
                let students = [];
                app.grades.upload.students.forEach(student=>{
                    students.push({id:student.id,name:student.name,grade:app.grades.upload.grade})
                })
                Vue.http.post("/index.php/index/Teacher/addStudents",{students:students,grade:app.grades.upload.grade}).then(res => {
                    console.log(res.body);
                    //成功返回主页面
                    Vue.http.get("/index.php/index/Teacher/allGrade").then(res => {
                        app.grades.grades=res.body.data
                        app.grades.upload.grade='';
                        app.grades.upload.students=[];
                        app.grades.fun=0;
                    },response => {

                    })
                },response => {
                    console.log("error");
                    alert("添加错误")
                })
            },
            //查看方法
            show(index) {
                var name = app.grades.grades[index].name;
                console.log(name);
            }
        }
    })
    var app = new Vue({
        el: '#app',
        data: {
            view:'1',
            //班级页面
            grades:{
                grades: [],
                fun: 0,
                upload:{
                    grade:'',
                    students:[]
                }
            }
        },
        methods:{
            /**
             * 切换视图
             * @param index
             * @param indexPath
             */
            showPage(index, indexPath) {
                switch (index) {
                    case '1':
                        console.log("签到页面");
                        break;
                    case '2':
                        console.log("课程管理页面");
                        break;
                    case '3':
                        console.log("班级管理页面");
                        Vue.http.get("/index.php/index/Teacher/allGrade").then(res => {
                            app.grades.grades=res.body.data
                        },response => {
                            console.log("error");
                        })
                        break;
                }
                this.view = index;
            }
        },
    });
    /**
     * 抓取首页面数据
     */
    // Vue.http.get("/index.php/index/Admin/homePage").then(res => {
    //     console.log(res.body.data );
    //     console.log("页面刷新了")
    //     app.data=res.body.data
    // },response => {
    //     console.log("asd");
    //     self.location='http://localhost:8888/frontEnd/el-admin/login.html';
    // })
}