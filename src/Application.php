<?php 

namespace Nucleus; 

use Nucleus\Routing\Router; 

class Application implements \ArrayAccess 
{
	protected $_data = array();

	protected $router; 
	protected $container; 

	public function __construct($container)
	{
		$this["debug"] = true; 

		$this->router = new Router(); 
		$this->container = $container; 
	}

    public function offsetExists ($offset)
    {
        return array_key_exists($offset, $this->_data);
    }
 
    public function offsetGet ($offset)
    {
        return $this->_data[$offset];
    }
 
    public function offsetSet ($offset, $value)
    {
        $this->_data[$offset] = $value;
    }
 
    public function offsetUnset ($offset)
    {
        unset($this->_data[$offset]);
    }

    public function get($uri, $callback)
    {
    	$this->router->get($uri, $callback);
    }

    public function run()
    {
    	$this->router->dispatch($this->container);
    }

}
