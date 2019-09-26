## Introduction
The Project is a PHP Library which implements consistent hash.

## Quick Start
```
    # New an instance
    $builder = new Builder();
        
    # add server node (server_dsn, server_tag, weight)
    $tag1 = 1;
    $tag2 = 2;
    $tag3 = 3;
    $builder->addServer('host1:6379', $tag1, 1);
    $builder->addServer('host2:6379', $tag2, 1);
    $builder->addServer('host3:6379', $tag3, 2);
        
    # set virtual node's number. It means that one real server node will be mapping many virtual nodes
    $builder->setVirtualNodeNum(128);
        
    # initialize server nodes, generate virtual nodes array for search
    $builder->initNodes();
        
    # search the mapping server_tag for input key
    $tag = $builder->search("my:hts1");

```