<?php


namespace TierJigSkeleton\Site;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection as DBConnection;

class DBPoke
{
    public function pokeDatabase(DBConnection $dbConnection)
    {
        $dbConnection->exec("DROP TABLE IF EXISTS User;");
        $dbConnection->exec(
            "CREATE TABLE Ticket (
            ticket_id INTEGER PRIMARY KEY,
            title VARCHAR NOT NULL,
            text VARCHAR NOT NULL,
            status INTEGER NOT NULL
            );"
        );

        $tickets = [
            ['Print toner', 'The printer on the first floor needs the toner replacing', 0],
            ['Missing a key', 'The instructions on the installation program say press \'press any key to continue\'. This key is not present on my keyboard ', 1],
        ];
        
        $statement = $dbConnection->prepare('insert into Ticket (title, text, status) values (:title, :text, :status)');
        
        foreach ($tickets as $ticket) {
            $statement->execute([
                'title' => $ticket[0],
                'text' => $ticket[1],
                'status' => $ticket[2]
            ]);
        }
    }
}
