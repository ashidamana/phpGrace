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

    /**
     * 查询数据截取
     */
    public function test9() {
        $result = $this->db->order('id desc')->limit(0, 6)->fetchAll();
        p($result);
    }

    /**
     * 执行自定义的sql命令
     */
    public function test10() {
        $res = $this->db->query('delete from persons where id=?', array(2));
        p($res);
    }

    /**
     * queryFetch 和 queryFetchAll()
     * 使用query()函数查询数据时后续的查询函数，queryFetch() 用于单条数据，queryFetchAll()用于多条数据。
     */
    public function test11() {
        $this->db->query('select * from persons where id > ?', array(18));
//        $arr = $this->db->queryFetchAll();
        $arr = $this->db->queryFetch();
        p($arr);
    }

    /**
     * 使用join() 完成多表联合
     */
    public function test12() {
        $arr = $this->db->join('as a left join ' . sc('db', 'pre') . 'classes as b on a.classid=b.id')
                ->fetchAll('a.*,b.classname');
        p($arr);
        p($this->db->getSql());
    }

    /**
     * 使用page函数完成分页
     */
    public function test13() {
        $arr = $this->db->page(5)->fetchAll();
        p($arr);
    }

    /**
     * 获取sql错误方法 error()
     */
    public function test14() {
        $this->db->where('id=?', array(4))->field('age', -1);
        echo $this->db->error();
    }

    /**
     * 获取原生的pdo操作对象 getDb()
     */
    public function test15() {
        $pdo = $this->db->getDb();
        p($pdo);
    }

    /**
     * 计算数据条目总数 count()
     */
    public function test16() {
        $count = $this->db->where('id > ?', array(33))->count();
        echo $count;
    }

    public function test17() {
//        指定字段的数据最大值 max(字段)
        $max = $this->db->max('age');
        echo $max;
        echo '<br>';
//        指定字段的数据最小值 min(字段)
        $min = $this->db->min('age');
        echo $min;
        echo '<br>';
//        指定字段的数据平均值 avg(字段)
        $avg = $this->db->avg('age');
        echo $avg;
        echo '<br>';
//        指定字段的数据总和 sum(字段)
        $sum = $this->db->sum('age');
        echo $sum;
        echo '<br>';
//        获取写入数据的主键值 lastInsertId()
//        $res = $this->db->add(array('name' => 'grace', 'age' => 18, 'addtime' => 10585888, 'classid' => 1));
//        echo $this->db->lastInsertId();
        echo '<br>';
//        获取操作影响的数据条目数 rowCount()
        $res = $this->db->where('id < ?', array(28))->delete();
        echo $this->db->rowCount();
//        获取mysql版本 mysqlV()
        echo $this->db->mysqlV();
//        表结构分析
        $res = $this->db->desc();
        p($res);
    }

    public function test18() {
//        group by
//原始语句
//        select count('a.*'), b.classname from persons as a left join classes as b on a.classid = b.id group by a . classid;
//代码实现：
        $res = $this->db
                ->join('as a left join ' . sc('db', 'pre') . 'classes as b on a.classid = b.id')
                ->group('a.classid')
                ->fetchAll("count('a.*') as total, b.classname");
        echo $this->db->getSql();
        p($res);
    }

    /**
     * 使用 debugSql 在控制台内输出执行的 sql
     */
    public function test19() {
        $db = db('names');
        $db->fetchAll();
        // 在执行sql 后调用 debugSql 即可在控制台内输出刚刚执行的sql 命令
        $db->debugSql();
        $db->fetchAll("name");
        // 在执行sql 后调用 debugSql 即可在控制台内输出刚刚执行的sql 命令
        $db->debugSql();
    }

    public function test20() {
        
    }

    public function test21() {
        
    }

    public function test22() {
        
    }

    public function test23() {
        
    }

    public function test24() {
        
    }

    public function test25() {
        
    }

    public function test26() {
        
    }

    public function test27() {
        $name = array(
            'Flyer', 'Baby', 'Mimi', "Nini", "Cici", 'Dere', 'Redf', "Orefg"
        );
        for ($i = 0; $i < 23; $i++) {
            $addData = array(
                'name' => $name[mt_rand(0, 7)] . $i,
                'age' => mt_rand(10, 100),
                'addtime' => time(),
                'classid' => mt_rand(1, 10)
            );
            $personId = $this->db->add($addData);
            if ($personId) {
                echo '写入数据成功，主键：' . $personId;
//                echo '<br/>' . $this->db->getSql();
            } else {
//                echo '<br/>' . $this->db->error();
            }
        }
    }

    public function test28() {
        for ($i = 1; $i <= 10; $i++) {
            $data = array(
                'classname' => $i . '班'
            );
            $cid = db('classes')->add($data);
            echo '写入数据成功，主键：' . $cid;
        }
    }

}
