<?php
namespace ConsistentHash;

class Builder
{

    const ERROR_REPEAT_TAG = 101;
    const ERROR_REPEAT_INIT = 102;

    private $servers = [];

    //虚节点数，表示一个真实的服务节点会映射成N个虚节点，确保hash的分布均匀
    private $virtualNodeNum = 64;

    private $hashNodeMap = [];

    //hash
    private $hashValueArray = [];

    //是否初始化
    private $isInit = false;

    /**
     * 设置虚节点数
     *
     * @param int $value
     */
    public function setVirtualNodeNum($value)
    {
        $this->virtualNodeNum = $value;
    }


    /**
     * 添加服务器节点
     *
     * @param string $dsn 服务器配置，推荐是IP:PORT
     * @param string $tag 唯一标识值，在lookup接口时返回
     * @param int $weight 权重
     * @throws \Exception
     */
    public function addServer($dsn, $tag, $weight = 1)
    {
        if (isset($this->servers[$tag])) {
            throw new \Exception('重复的标识值', self::ERROR_REPEAT_TAG);
        }
        $this->servers[$tag] = [
            'dsn' => $dsn,
            'weight' => $weight,
            'tag' => $tag
        ];
    }

    /**
     * 初始化，生成虚拟节点数组
     *
     * @throws \Exception
     */
    public function initNodes()
    {
        if ($this->isInit) {
            throw new \Exception('不能重复初始化', self::ERROR_REPEAT_INIT);
        }
        $this->isInit = true;
        foreach ($this->servers as $server) {
            $nodeNum = $server['weight'] * $this->virtualNodeNum;
            for ($i = 1; $i <= $nodeNum; $i++) {
                $key = $server['dsn'] . ':' . $server['tag'] . ':' . $i;
                $hashValue = Hash::crc32($key);
                $this->hashNodeMap[$hashValue] = $server['tag'];
                $this->hashValueArray[] = $hashValue;
            }
        }
        sort($this->hashValueArray, SORT_ASC);
    }

    /**
     * 查找key一致性hash算法后落点服务器
     *
     * @param string $key
     * @return mixed 返回值为落点服务器的tag标识
     */
    public function search($key)
    {
        $hashValue = Hash::crc32($key);
        $pos = Search::binarySearch($this->hashValueArray, $hashValue);
        return $this->hashNodeMap[$this->hashValueArray[$pos]];
    }

}