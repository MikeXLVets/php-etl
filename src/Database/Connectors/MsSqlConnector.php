<?php

namespace Marquine\Etl\Database\Connectors;

use PDO;

class MSSqlConnector extends Connector
{
    /**
    * Connect to a database.
    *
    * @param array $config
    * @return \PDO
    */
    public function connect($config)
    {
        $dsn = $this->getDsn($config);

        $connection = $this->createConnection($dsn, $config);

        $this->afterConnection($connection, $config);

        return $connection;
    }

    /**
     * Get the DSN string.
     *
     * @param array $config
     * @return string
     */
    public function getDsn($config)
    {
        extract($config, EXTR_SKIP);

        $dsn = [];

        if (isset($host)) {
            $string = $host;

            if (isset($port)) {
                $string .= "," . $port;
            }
            $dsn['Server'] = $host;
        }

        if (isset($database)) {
            $dsn['Database'] = $database;
        }

        if (!empty($encrypt)) {
            $dsn['Encrypt'] = intval($encrypt);
            $dsn['TrustServerCertificate'] = 0;
        }

        return 'sqlsrv:' . http_build_query($dsn, '', ';');
    }

    /**
     * Handle tasks after connection.
     *
     * @param \PDO $connection
     * @param array $config
     * @return void
     */
    public function afterConnection($connection, $config)
    {
        extract($config, EXTR_SKIP);

        if (isset($database)) {
            $connection->exec("use [$database]");
        }

        if (isset($charset)) {
            if (isset($collation)) {
                $connection->prepare(" collate [$collation]")->execute();
            }
        }

        if (isset($timezone)) {
            $connection->prepare("set time_zone = [$timezone]")->execute();
        }
    }
}
