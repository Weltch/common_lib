<?php
/**
 * Created by PhpStorm.
 * User: WQ
 * Date: 2021/5/5
 * Time: 17:58
 */

// 预定义接口：使用Traversable判断是否可以遍历，但数组和对象除外
function useArray(){
    return [1,2,3];
}
function useObject(){
    return new stdClass();
}
function useIterator(){
    yield 1;
    yield 2;
}
$demo1 = useArray();
$demo2 = useObject();
$demo3 = useIterator();
if (!$demo1 instanceof Traversable) {
    echo "demo1 cannot be called";
}
if (!$demo2 instanceof Traversable) {
    echo "demo2 cannot be called";
}
if (!$demo3 instanceof Traversable) {
    echo "demo3 cannot be called";
}

// Iterator迭代器：完成遍历
class myIterator implements Iterator{
    private $position;
    private $container;
    public function __construct()
    {
        $this->position = 0;
        $this->container = [
            'one','two','three'
        ];
    }

    public function current()
    {
        return $this->container[$this->position];
    }
    public function key()
    {
        return $this->position;
    }
    public function next()
    {
        $this->position++;
    }
    public function rewind()
    {
        $this->position = 0;
    }
    public function valid()
    {
        return isset($this->container[$this->position]);
    }
}

$myIterator = new myIterator();
foreach ($myIterator as $iterator) {
    echo $iterator;
}

// Trowable接口：包含Error和Exception
try {
    throw new Error("Error");
//    throw new Exception();
} catch (Error $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
} catch (Throwable $e) {
    echo $e->getMessage();
} finally {
    echo "final";
}

// ArrayAccess数组访问
class Myaccess implements ArrayAccess{
    private $container;
    public function __construct()
    {
        $this->container = [
            'one','two','three'
        ];
    }

    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }
    public function offsetGet($offset)
    {
        return $this->container[$offset];
    }
    public function offsetSet($offset, $value)
    {
        $this->container[$offset] = $value;
    }
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }
}

$myaccess = new Myaccess();
echo $myaccess[1];
$myaccess[3] = 'four';
echo $myaccess[3];

// Stringable字符串访问 (高版本已经废弃，可以使用__tosting方法代替)
//class myStringable implements Stringable{
//
//}
