<?php
class Player
{
    private $id, $playerName, $playerNumber, $playerPosition, $age, $nationality;

    public function __construct($playerName, $playerNumber, $playerPosition, $age, $nationality)
    {
        $this->playerName = $playerName;
        $this->playerNumber = $playerNumber;
        $this->playerPosition = $playerPosition;
        $this->age = $age;
        $this->nationality = $nationality;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        return $this->id = $id;
    }

    public function getPlayerName()
    {
        return $this->playerName;
    }

    public function setPlayerName($playerName)
    {
        return $this->playerName = $playerName;
    }

    public function getPlayerNumber()
    {
        return $this->playerNumber;
    }

    public function setPlayerNumber($playerNumber)
    {
        return $this->playerNumber = $playerNumber;
    }

    public function getPlayerPosition()
    {
        return $this->playerPosition;
    }

    public function setPlayerPosition($playerPosition)
    {
        return $this->playerPosition = $playerPosition;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        return $this->age = $age;
    }

    public function getNationality()
    {
        return $this->nationality;
    }

    public function setNationality($nationality)
    {
        return $this->nationality = $nationality;
    }
}