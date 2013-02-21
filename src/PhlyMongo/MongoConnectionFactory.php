<?php

namespace PhlyMongo;

use Mongo;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MongoConnectionFactory implements FactoryInterface
{
    protected $server  = 'mongodb://localhost:27017';
    protected $options = array('connect' => true);

    public function __construct($server = null, array $options = null)
    {
        if (null !== $server) {
            $this->server = $server;
        }
        if (null !== $options) {
            $this->options = $options;
        }
    }

    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('Config');

        if (isset($config['phlymongo']) && isset($config['phlymongo']['connection'])) {
            
            if (isset($config['phlymongo']['connection']['server'])) {
                $this->server = $config['phlymongo']['connection']['server'];
            }

            if (isset($config['phlymongo']['connection']['options'])) {
                $this->options = $config['phlymongo']['connection']['options'];
            }

        }

        return new Mongo($this->server, $this->options);
    }
}
