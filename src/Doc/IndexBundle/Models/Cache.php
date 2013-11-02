<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Doc\IndexBundle\Models;
use \Doctrine\Common\Cache\MemcacheCache;
class Cache {

    /**
     * @var \Doctrine\Common\Cache\MemcacheCache
     */
    private $cacheDriver; 
    
    public function __construct() {
       /* $memcache = new \Memcache();
        $memcache->connect('localhost', 11211);

        $this->cacheDriver = new MemcacheCache();
        $this->cacheDriver->setMemcache($memcache);*/
        $this->cacheDriver  = new \Doctrine\Common\Cache\XcacheCache();
        
    }
    /**
     * 
     * @return \Doctrine\Common\Cache\MemcacheCache
     */
    public function getDriver(){
      return  $this->cacheDriver;  
    }
    

}
