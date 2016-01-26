<?php
/**
 * Redis操作，支持Master/Slave的负载集群
 * 
 */
class RedisCluster
{
	// 是否使用M/S的读写集群方案
	private $_isUserCluster = false;
	// Slave句柄标记
	private $_sn = 0;
	// 服务器连接句柄
	private $_linkHandle = array(
			'master'	=> null,	// 只支持一台Master
			'slave'		=> array()	// 可以有多台Salve
	);
	
	/**
	 * 构造函数
	 * 
	 * @param boolean $isUseCluster	是否采用M/S方案
	 */
	public function __construct($isUseCluster=false)
	{
		$this->_isUserCluster = $isUseCluster;
	}
	
	/**
	 * 连接服务器
	 * 注意：这里使用长连接，提高效率，但不会自动关闭
	 * 
	 * @param array $config		Redis服务器配置
	 * @param boolean $isMaster	当前添加的服务器是否为Master服务器
	 * @return boolean
	 */
	public function connect($config=array('host'=>'127.0.0.1', 'port'=>6379), $isMaster=true)
	{
		// default port
		if (!isset($config['port']))
		{
			$config['port'] = 6379;
		}
		// 设置Master连接
		if ($isMaster)
		{
			$this->_linkHandle['master'] = new Redis();
			$ret = $this->_linkHandle['master']->pconnect($config['host'], $config['port']);
		}
		else
		{
			// 多个Slave连接
			$this->_linkHandle['salve'][$this->_sn] = new Redis();
			$ret = $this->_linkHandle['slave'][$this->_sn]->pconnect($config['host'], $config['port']);
			++$this->_sn;
		}
		return $ret;
	}
	
	/**
	 * 关闭连接
	 * 
	 * @param int $flag	关闭连接：0.关闭Master 1.关闭Slave 2.关闭所有
	 * @return boolean
	 */
	public function close($flag=2)
	{
		
	}
}

?>