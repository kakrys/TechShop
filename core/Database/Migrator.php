<?php
namespace Core\Database;
use Core\Database\DbConnection;
use Up\Services\ConfigurationService;
class Migrator
{
    public static function executeMigrations():void
    {
        $migrationsDir=scandir(__DIR__."/../../src/Migrations");
        $migrations=array_slice($migrationsDir,2);
        $number = (int)trim(file_get_contents(__DIR__.'/DbMigration.txt'));
        $connection = DbConnection::getDbConnection();
        foreach($migrations as $migration)
            {
                $migrationTime=(int)substr($migration,0,-4);
                if(strtotime($migrationTime)<time())
                {
                    $query = file_get_contents(__DIR__ . '/../../src/Migrations/' . $migration);
                    if (mysqli_multi_query($connection, $query))
                    {
                        continue;
                    }
                    else
                    {
                        throw new \RuntimeException(mysqli_error($connection));
                    }
                }
            }
        file_put_contents(__DIR__.'/DbMigration.txt',time());

    }
}