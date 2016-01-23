<?php
/**
 * Table of players
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Players;

class Table {

    /**
     * @var array
     */
    protected $players = array();
    
    public function __construct() 
    {}
    
    /**
     * Returns the players at the table
     * @return array
     */
    public function getPlayers()
    {
        return $this->players;
    }
    
    /**
     * Returns the amount of players at the table
     * @return int
     */
    public function getPlayerCount()
    {
        return (int) count($this->players);
    }
    
    /**
     * Adds a player to the table
     * @param \Cilex\Players\Player $player
     */
    public function addPlayer(\Cilex\Players\Player $player)
    {
        $this->players[] = $player;
    }
}
