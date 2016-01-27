<?php

// Start of redis v.2.2.5

class Redis  {
	const REDIS_NOT_FOUND = 0;
	const REDIS_STRING = 1;
	const REDIS_SET = 2;
	const REDIS_LIST = 3;
	const REDIS_ZSET = 4;
	const REDIS_HASH = 5;
	const ATOMIC = 0;
	const MULTI = 1;
	const PIPELINE = 2;
	const OPT_SERIALIZER = 1;
	const OPT_PREFIX = 2;
	const OPT_READ_TIMEOUT = 3;
	const SERIALIZER_NONE = 0;
	const SERIALIZER_PHP = 1;
	const OPT_SCAN = 4;
	const SCAN_RETRY = 1;
	const SCAN_NORETRY = 0;
	const AFTER = "after";
	const BEFORE = "before";


	public function __construct () {}

	public function __destruct () {}
	
	
	/**
	 * 连接到一个redis服务（实例）
	 * 
	 * @param string $host		服务器地址，可以是一个host IP或者一个UNIX DOMAIN SOCKET的路径
	 * @param int $port			端口号(默认为6379)
	 * @param float $timeout	连接时长，单位：秒（可选，默认为0，即不限制连接时间）
	 * 							注：在redis.conf中也有设置时间，默认为300
	 * @return boolean	TRUE on success, FALSE on error
	 */
	public function connect (string $host, int $port, float $timeout=0) {}
	
	/**
	 * 用于连接一个Redis的实例或者复用一个已经存在的实例。
	 * 这个连接将不会被主动关闭，比如使用close()，或者PHP执行结束这个连接都不会被主动关闭。当有大量的connect请求在redis服务器端时，使用持久化的连接对象。
	 * 一个持久化的连接实例，可以使用HOST+PORT+TIMEOUT或者HOST+persistent_id或者SOCKET+TIMEOUT的方式创建。
	 *
	 * @param string $host		服务器地址，可以是一个host IP或者一个UNIX DOMAIN SOCKET的路径
	 * @param int $port			端口号(默认为6379)
	 * @param float $timeout	连接时长，单位：秒（可选，默认为0，即不限制连接时间）
	 * 							注：在redis.conf中也有设置时间，默认为300
	 * @param string $persistent_id	 identity for the requested persistent connection
	 * @return boolean	TRUE on success, FALSE on error
	 */
	public function pconnect (string $host, int $port, float $timeout=0, string $persistent_id) {}
	
	/**
	 * 连接redis服务
	 *
	 * @param string $host		服务器地址，可以是一个host IP或者一个UNIX DOMAIN SOCKET的路径
	 * @param int $port			端口号(默认为6379)
	 * @param float $timeout	连接时长，单位：秒（可选，默认为0，即不限制连接时间）
	 * 							注：在redis.conf中也有设置时间，默认为300
	 * @return boolean	TRUE on success, FALSE on error
	 */
	public function open (string $host, int $port, float $timeout=0) {}
	
	/**
	 * 用于连接一个Redis的实例或者复用一个已经存在的实例。
	 * 这个连接将不会被主动关闭，比如使用close()，或者PHP执行结束这个连接都不会被主动关闭。当有大量的connect请求在redis服务器端时，使用持久化的连接对象。
	 * 一个持久化的连接实例，可以使用HOST+PORT+TIMEOUT或者HOST+persistent_id或者SOCKET+TIMEOUT的方式创建。
	 *
	 * @param string $host		服务器地址，可以是一个host IP或者一个UNIX DOMAIN SOCKET的路径
	 * @param int $port			端口号(默认为6379)
	 * @param float $timeout	连接时长，单位：秒（可选，默认为0，即不限制连接时间）
	 * 							注：在redis.conf中也有设置时间，默认为300
	 * @param string $persistent_id	 identity for the requested persistent connection
	 * @return boolean	TRUE on success, FALSE on error
	 */
	public function popen (string $host, int $port, float $timeout=0, string $persistent_id) {}

	/**
	 * 关闭Redis的连接实例,但是不能关闭用pconnect连接的实例
	 * 
	 */
	public function close () {}

	public function ping () {}

	public function echo () {}

	/**
	 * string数据类型函数
	 * 
	 * 取得与指定的键值相关联的值
	 * 
	 * @param unknown $key
	 * @return boolean	返回相关值或者BOOL值，如果KEY不存在，返回FALSE。如果有相关的KEY和值返回值。
	 */
	public function get ($key) {}

	/**
	 * string数据类型函数
	 * 
	 * 设置值到KEY
	 * 
	 * @param $key
	 * @param $value
	 * @param $timeout	（可选）Calling SETEX is preferred if you want a timeout
	 * @return boolean
	 */
	public function set ($key, $value, $timeout) {}

	/**
	 * string数据类型函数
	 * 
	 * 设置一个有生命周期的KEY-VALUE。
	 * 
	 * @param $key
	 * @param $TTL(单位：秒) (注：TTL（Time to Live）生存时间)
	 * @param $value
	 * @return boolean
	 */
	public function setex ($key, $TTL, $value) {}
	
	/**
	 * string数据类型函数
	 *
	 * 设置一个有生命周期的KEY-VALUE,使用的周期单位为毫秒。
	 *
	 * @param $key
	 * @param $TTL(单位：毫秒) (注：TTL（Time to Live）生存时间)
	 * @param $value
	 * @return boolean
	 */
	public function psetex ($key, $TTL, $value) {}

	/**
	 * string数据类型函数
	 * 
	 * setnx用于设置一个KEY-VALUE，这个函数会先判断Redis中是否有这个KEY，如果没有就SET，有就返回False。
	 * 
	 * @param $key
	 * @param $value
	 * @return boolean
	 */
	public function setnx ($key, $value) {}

	public function getSet () {}

	public function randomKey () {}

	
	public function renameKey () {}

	public function renameNx () {}

	/**
	 * string数据类型函数
	 * 
	 * 取得所有指定KEYS的值，如果一个或者更多的KEYS不存在，那么返回的ARRAY中将在相应的KEYS的位置填充FALSE。
	 * 
	 * @param array $array	一个KEYS的数组
	 * @return array	返回由相应的KEYS的值组成的数组
	 */
	public function getMultiple (array $array) {}

	public function exists () {}

	/**
	 * string数据类型函数
	 *
	 * 移除已经存在KEYS
	 *
	 * @param $key	可以是一个KEYS的数组，或者一个未定义的数字参数，或者一个一个的写KEY
	 * @return int	返回删除KEY-VALUE的数量
	 */
	public function delete ($key) {}

	/**
	 * string数据类型函数
	 * 
	 * 对指定的KEY的值自增1
	 * 
	 * @param $key
	 * @return int	返回新的INT数值
	 */
	public function incr ($key) {}

	/**
	 * string数据类型函数
	 *
	 * 对指定的KEY的值自增1。如何填写了第二个参数，将把第二个参数自增给KEY的值。
	 *
	 * @param $key
	 * @return int	返回新的INT数值
	 */
	public function incrBy ($key, $value) {}

	/**
	 * string数据类型函数
	 *
	 * 对指定的KEY的值自增一个浮点型的数值。
	 *
	 * @param $key
	 * @return float	返回新的FLOAT数值
	 */
	public function incrByFloat ($key, $value) {}

	/**
	 * string数据类型函数
	 *
	 * 对指定的KEY的值自减1
	 *
	 * @param $key
	 * @return int	返回新的INT数值
	 */
	public function decr ($key) {}

	/**
	 * string数据类型函数
	 *
	 * 对指定的KEY的值自减1。如何填写了第二个参数，将把第二个参数自减给KEY的值。
	 *
	 * @param $key
	 * @return int	返回新的INT数值
	 */
	public function decrBy ($key, $value) {}

	public function type () {}

	public function append () {}

	public function getRange () {}

	public function setRange () {}

	public function getBit () {}

	public function setBit () {}

	public function strlen () {}

	public function getKeys () {}

	public function sort () {}

	public function sortAsc () {}

	public function sortAscAlpha () {}

	public function sortDesc () {}

	public function sortDescAlpha () {}

	public function lPush () {}

	public function rPush () {}

	public function lPushx () {}

	public function rPushx () {}

	public function lPop () {}

	public function rPop () {}

	public function blPop () {}

	public function brPop () {}

	public function lSize () {}

	public function lRemove () {}

	public function listTrim () {}

	public function lGet () {}

	public function lGetRange () {}

	public function lSet () {}

	public function lInsert () {}

	public function sAdd () {}

	public function sSize () {}

	public function sRemove () {}

	public function sMove () {}

	public function sPop () {}

	public function sRandMember () {}

	public function sContains () {}

	public function sMembers () {}

	public function sInter () {}

	public function sInterStore () {}

	public function sUnion () {}

	public function sUnionStore () {}

	public function sDiff () {}

	public function sDiffStore () {}

	public function setTimeout () {}

	public function save () {}

	public function bgSave () {}

	public function lastSave () {}
	
	/**
	 * 强制刷新（清空）当前DB
	 * 
	 * @return boolean	总是返回true
	 */
	public function flushDB () {}
	
	/**
	 * 强制刷新（清空）所有的DB
	 * 
	 * @return boolean	总是返回true
	 */
	public function flushAll () {}

	public function dbSize () {}

	public function auth () {}

	public function ttl () {}

	public function pttl () {}

	public function persist () {}

	public function info () {}

	public function resetStat () {}

	public function select () {}

	public function move () {}

	public function bgrewriteaof () {}

	public function slaveof () {}

	public function object () {}

	public function bitop () {}

	public function bitcount () {}

	public function bitpos () {}

	public function mset () {}

	public function msetnx () {}

	public function rpoplpush () {}

	public function brpoplpush () {}

	public function zAdd () {}

	public function zDelete () {}

	public function zRange () {}

	public function zReverseRange () {}

	public function zRangeByScore () {}

	public function zRevRangeByScore () {}

	public function zCount () {}

	public function zDeleteRangeByScore () {}

	public function zDeleteRangeByRank () {}

	public function zCard () {}

	public function zScore () {}

	public function zRank () {}

	public function zRevRank () {}

	public function zInter () {}

	public function zUnion () {}

	public function zIncrBy () {}

	public function expireAt () {}

	public function pexpire () {}

	public function pexpireAt () {}

	public function hGet () {}

	public function hSet () {}

	public function hSetNx () {}

	public function hDel () {}

	public function hLen () {}

	public function hKeys () {}

	public function hVals () {}

	public function hGetAll () {}

	public function hExists () {}

	public function hIncrBy () {}

	public function hIncrByFloat () {}

	public function hMset () {}

	public function hMget () {}

	public function multi () {}

	public function discard () {}

	public function exec () {}

	public function pipeline () {}

	public function watch () {}

	public function unwatch () {}

	public function publish () {}

	public function subscribe () {}

	public function psubscribe () {}

	public function unsubscribe () {}

	public function punsubscribe () {}

	public function time () {}

	public function eval () {}

	public function evalsha () {}

	public function script () {}

	public function dump () {}

	public function restore () {}

	public function migrate () {}

	public function getLastError () {}

	public function clearLastError () {}

	public function _prefix () {}

	public function _serialize () {}

	public function _unserialize () {}

	public function client () {}

	/**
	 * @param i_iterator
	 * @param str_pattern[optional]
	 * @param i_count[optional]
	 */
	public function scan (&$i_iterator, $str_pattern = null, $i_count = null) {}

	/**
	 * @param str_key
	 * @param i_iterator
	 * @param str_pattern[optional]
	 * @param i_count[optional]
	 */
	public function hscan ($str_key, &$i_iterator, $str_pattern = null, $i_count = null) {}

	/**
	 * @param str_key
	 * @param i_iterator
	 * @param str_pattern[optional]
	 * @param i_count[optional]
	 */
	public function zscan ($str_key, &$i_iterator, $str_pattern = null, $i_count = null) {}

	/**
	 * @param str_key
	 * @param i_iterator
	 * @param str_pattern[optional]
	 * @param i_count[optional]
	 */
	public function sscan ($str_key, &$i_iterator, $str_pattern = null, $i_count = null) {}

	public function getOption () {}

	public function setOption () {}

	public function config () {}

	public function slowlog () {}

	public function getHost () {}

	public function getPort () {}

	public function getDBNum () {}

	public function getTimeout () {}

	public function getReadTimeout () {}

	public function getPersistentID () {}

	public function getAuth () {}

	public function isConnected () {}

	public function wait () {}

	public function pubsub () {}

	

	public function lLen () {}

	public function sGetMembers () {}

	/**
	 * string数据类型函数
	 * 
	 * 取得所有指定KEYS的值，如果一个或者更多的KEYS不存在，那么返回的ARRAY中将在相应的KEYS的位置填充FALSE。
	 * 
	 * @param array $array	一个KEYS的数组
	 * @return array	返回由相应的KEYS的值组成的数组
	 */
	public function mget (array $array) {}

	public function expire () {}

	public function zunionstore () {}

	public function zinterstore () {}

	public function zRemove () {}

	public function zRem () {}

	public function zRemoveRangeByScore () {}

	public function zRemRangeByScore () {}

	public function zRemRangeByRank () {}

	public function zSize () {}

	public function substr () {}

	public function rename () {}
	
	/**
	 * string数据类型函数
	 * 
	 * 移除已经存在KEYS
	 * 
	 * @param $key	可以是一个KEYS的数组，或者一个未定义的数字参数，或者一个一个的写KEY
	 * @return int	返回删除KEY-VALUE的数量
	 */
	public function del ($key) {}

	public function keys () {}

	public function lrem () {}

	public function ltrim () {}

	public function lindex () {}

	public function lrange () {}

	public function scard () {}

	public function srem () {}

	public function sismember () {}

	public function zrevrange () {}

	public function sendEcho () {}

	public function evaluate () {}

	public function evaluateSha () {}

}

class RedisArray  {

	public function __construct () {}

	/**
	 * @param function_name
	 * @param arguments
	 */
	public function __call ($function_name, $arguments) {}

	public function _hosts () {}

	public function _target () {}

	public function _instance () {}

	public function _function () {}

	public function _distributor () {}

	public function _rehash () {}

	public function select () {}

	public function info () {}

	public function ping () {}

	public function flushdb () {}

	public function flushall () {}

	public function mget () {}

	public function mset () {}

	public function del () {}

	public function getOption () {}

	public function setOption () {}

	public function keys () {}

	public function multi () {}

	public function exec () {}

	public function discard () {}

	public function unwatch () {}

	public function delete () {}

	public function getMultiple () {}

}

class RedisException extends RuntimeException  {
	protected $message;
	protected $code;
	protected $file;
	protected $line;


	final private function __clone () {}

	/**
	 * @param message[optional]
	 * @param code[optional]
	 * @param previous[optional]
	 */
	public function __construct ($message = null, $code = null, $previous = null) {}

	final public function getMessage () {}

	final public function getCode () {}

	final public function getFile () {}

	final public function getLine () {}

	final public function getTrace () {}

	final public function getPrevious () {}

	final public function getTraceAsString () {}

	public function __toString () {}

}
// End of redis v.2.2.5
?>