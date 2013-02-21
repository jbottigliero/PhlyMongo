<?php

namespace PhlyMongo;

use Mongo;
use MongoDB;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MongoDbFactory implements FactoryInterface
{
    protected $dbName;
    protected $connectionService;

    public function __construct($connectionService, $dbName = null)
    {
        $this->dbName            = $dbName;
        $this->connectionService = $connectionService;
    }

    public function createService(ServiceLocatorInterface $services)
    {

        $config = $services->get('Config');

        if (isset($config['phlymongo']) && isset($config['phlymongo']['database'])) {
            $this->dbName = $config['phlymongo']['database'];
        }


        $connection = $services->get($this->connectionService);

        return new MongoDB($connection, $this->dbName);
    }
}
