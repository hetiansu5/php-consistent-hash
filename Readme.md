## Introduction
The Project is a PHP Library which implements consistent hash.

## Quick Start
```
    # New an instance
    # 构建一个实例
    $builder = new Builder();
        
    # add server node (server_dsn, server_tag, weight)
    # 添加服务器节点
    $tag1 = 1;
    $tag2 = 2;
    $tag3 = 3;
    $builder->addServer('host1:6379', $tag1, 1);
    $builder->addServer('host2:6379', $tag2, 1);
    $builder->addServer('host3:6379', $tag3, 2);
        
    # set virtual node's number. It means that one real server node will be mapping many virtual nodes
    # 设置虚拟节点数，表示：1个实际的服务器节点会映射成多个虚拟节点，确保服务器节点可以实现均匀分布
    $builder->setVirtualNodeNum(128);
        
    # initialize server nodes, generate virtual nodes array for search
    # 初始化服务器节点，生成后续用于查找的虚拟节点数组
    $builder->initNodes();
        
    # search the mapping server_tag for input key
    # 查询输入key映射的服务器tag标识
    $tag = $builder->search("my:hts1");

```