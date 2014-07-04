<?php

class DB
{
    private $host = "localhost";
    private $dbname = "GESTION_ASESORIAS_v34";
    private $user = "desarrollo";
    private $pass = "..5&desarrollo";
    protected $dbh;

    /**
     * Conectar a la base datos usando PDO
     *
     */
    public function connectDb()
    {
        try
        {
            $this->dbh = new PDO("mysql:host = $this->host;
                            dbname=$this->dbname"
                            ,$this->user
                            ,$this->pass
                            ,array()
            );
            $this->dbh->exec("SET NAMES 'utf8';");

            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "Error connecting database";
        }
    }

    /**
     * Realizar consulta a la BD
     */
    public function query($sql)
    {
        return $this->dbh->query($sql);
    }

    public function getPDO()
    {
        return $this->dbh;
    }

}


?>
