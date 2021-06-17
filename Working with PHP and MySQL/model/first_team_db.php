<?php
class PlayerDB {

    public static function getFirstTeamDetails()
    {
        $db = Database::getDB();
        global $error;
        $query = 'SELECT * FROM first_team ORDER BY PlayerNumber';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        foreach ($rows as $row) {
            $player = new Player($row['PlayerName'], $row['PlayerNumber'], $row['Position'], $row['Age'], $row['Nationality']);
            $player->setId($row['ID']);
            $first_team[] = $player;
        }
        $statement->closeCursor();
        if ($statement->errorCode() !== 0 && empty($first_team)) {
            $sqlError = $statement->errorInfo();
            $error = 'SELECT error &rarr; The player details were not retrieved because: ' . $sqlError[2];
            logErrorMessage($error);
        }
        return $first_team;
    }

    public static function addPlayer(Player $player)
    {
        $db = Database::getDB();
        global $error, $successMessage;

        $playerName = $player->getPlayerName();
        $playerNumber = $player->getPlayerNumber();
        $playerPosition = $player->getPlayerPosition();
        $age = $player->getAge();
        $nationality = $player->getNationality();

        $query = 'INSERT INTO first_team 
                (playerName, playerNumber, Position, age, nationality)
                VALUES
                (:playerName, :playerNumber, :playerPosition, :age, :nationality)';
        $statement = $db->prepare($query);
        $statement->bindValue(':playerName', $playerName);
        $statement->bindValue(':playerNumber', $playerNumber);
        $statement->bindValue(':playerPosition', $playerPosition);
        $statement->bindValue(':age', $age);
        $statement->bindValue(':nationality', $nationality);
        $success = $statement->execute();
        $statement->closeCursor();
        if ($statement->errorCode() !== 0 && $success === false) {
            $sqlError = $statement->errorInfo();
            $error = 'INSERT error &rarr; The player <strong>' . $playerName . '</strong> was not added because: ' . $sqlError[2];
            logErrorMessage($error);
        } else {
            $successMessage = 'The player <strong>' . $playerName . '</strong> was successfully added to the database';
            logSuccessMessage($successMessage);
        }
    }

    public static function getPlayer($id)
    {
        $db = Database::getDB();
        global $error;
        $query = 'SELECT * FROM first_team WHERE ID = :ID';
        $statement = $db->prepare($query);
        $statement->bindValue(':ID', $id, PDO::PARAM_INT);
        $statement->execute();
        $row = $statement->fetch();
        $player = new Player($row['PlayerName'], $row['PlayerNumber'], $row['Position'], $row['Age'], $row['Nationality']);
        $player->setId($row['ID']);
        $statement->closeCursor();
        if ($statement->errorCode() !== 0 && empty($player)) {
            $sqlError = $statement->errorInfo();
            $error = 'SELECT error &rarr; The player with the ID <strong>' . $id . '</strong> was not retrieved because:' . $sqlError[2];
            logErrorMessage($error);
        }
        return $player;
    }

    public static function updatePlayer(Player $player)
    {
        $db = Database::getDB();
        global $error, $successMessage;

        $id = $player->getId();
        $playerName = $player->getPlayerName();
        $playerNumber = $player->getPlayerNumber();
        $playerPosition = $player->getPlayerPosition();
        $age = $player->getAge();
        $nationality = $player->getNationality();

        $query = 'UPDATE first_team 
                SET ID = :ID,
                playerName = :playerName,
                playerNumber = :playerNumber, 
                Position = :playerPosition,
                age = :age,
                nationality =:nationality
                WHERE ID = :ID';
        $statement = $db->prepare($query);
        $statement->bindValue(':ID', $id, PDO::PARAM_INT);
        $statement->bindValue(':playerName', $playerName);
        $statement->bindValue(':playerNumber', $playerNumber);
        $statement->bindValue(':playerPosition', $playerPosition);
        $statement->bindValue(':age', $age);
        $statement->bindValue(':nationality', $nationality);
        $success = $statement->execute();
        $statement->closeCursor();
        if ($statement->errorCode() !== 0 && $success === false) {
            $sqlError = $statement->errorInfo();
            $error = 'UPDATE error &rarr; The player <strong>' . $playerName . '</strong> was not updated because: ' . $sqlError[2];
            logErrorMessage($error);
        } else {
            $successMessage = 'The player <strong>' . $playerName . '</strong> was successfully updated';
            logSuccessMessage($successMessage);
        }
    }


    public static function deletePlayer($id, $playerName)
    {
        $db = Database::getDB();
        global $error, $successMessage;
        $query = 'DELETE FROM first_team WHERE ID = :ID';
        $statement = $db->prepare($query);
        $statement->bindValue(':ID', $id, PDO::PARAM_INT);
        $success = $statement->execute();
        $statement->closeCursor();
        if ($statement->errorCode() !== 0 && $success === false) {
            $sqlError = $statement->errorInfo();
            $error = 'DELETE error &rarr; The player <strong>' . $playerName . '</strong> was not deleted because: ' . $sqlError[2];
            logErrorMessage($error);
        } else {
            $successMessage = 'The player <strong>' . $playerName . '</strong> was successfully deleted';
            logSuccessMessage($successMessage);
        }
    }
}