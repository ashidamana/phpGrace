<?php

/*
  phpGrace.com 轻快的实力派！
 */

class indexController extends grace {

    //__init 函数会在控制器被创建时自动运行用于初始化工作，如果您要使用它，请按照以下格式编写代码即可：
    /*
      public function __init(){
      parent::__init();
      //your code ......
      }
     */
    public $tableName = 'persons';
    public function index() {
        // 系统会自动调用视图 index_index.php
        // your code
    }

    public function test() {
//        $this->db=db('persons');
        print_r($this->db);
        var_dump($this->db);
    }

    /**
     * 添加
     */
    public function test2() {
        $addData = array(
            'name' => 'grace',
            'age' => mt_rand(10, 100)
        );

        $personId = $this->db->add($addData);
        if ($personId) {
            echo '写入数据成功，主键：' . $personId;
            echo '<br/>' . $this->db->getSql();
        } else {
            echo '<br/>' . $this->db->error();
        }
    }

    /**
     * 删除
     */
    public function test3() {
        $result = $this->db->where('id=?', array(3))->delete();
        var_dump($result);
    }

    /**
     * 更新
     */
    public function test4() {
        $data = array(
            'name' => 'flyer23',
            'age' => 8899444
        );
        $result = $this->db->where('id=?', array(4))->update($data);
        var_dump($result);
    }

    /**
     * 对指定的字段进行递加或递减
     * 正数递加，负数递减
     */
    public function test5() {
        $this->db->where('id=?', array(4))->field('age', -8);
    }

    /**
     * 获取单条数据
     */
    public function test6() {
        $result = $this->db->where('id=?', array(4))->fetch();
//        $result=$this->db->where('id=?',array(4))->fetch('name,age');
        print_r($result);
    }

    /**
     * 获取多条数据
     */
    public function test7() {
//        $result = $this->db->fetchAll();
        $result = $this->db->fetchAll('name,age');
        print_r($result);
    }
    
    /**
     * 查询排序
     */
    public function test8() {
        $result = $this->db->order('id desc')->fetchAll();
        p($result);
    }

}
