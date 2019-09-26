<?php

use ConsistentHash\Builder;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{

    public function testLookUp()
    {
        $builder = new Builder();
        
        $builder->addServer('host1:6379', 1);
        $builder->addServer('host2:6379', 2);
        $builder->addServer('host3:6379', 3);

        $builder->setVirtualNodeNum(128);
        
        $builder->initNodes();
        
        $tag1 = $builder->search("my:test1");
        $tag2 = $builder->search("my:test2");
        $tag3 = $builder->search("my:test3");
        $tag4 = $builder->search("my:test4");
        $tag5 = $builder->search("my:test5");
        $tag6 = $builder->search("my:test6");
        $tag7 = $builder->search("my:test7");
        $tag8 = $builder->search("my:test8");
        $tag9 = $builder->search("my:test9");
        
        $tags = [$tag1, $tag2, $tag3, $tag4, $tag5, $tag6, $tag7, $tag8, $tag9];
        $diffArr = array_unique(array_merge($tags, [1, 2, 3]));
        $this->assertSame(3, count($diffArr));
    }

}