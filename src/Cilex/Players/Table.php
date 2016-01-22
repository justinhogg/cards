<?php
/**
 * Table of players
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Players;

class Table {

    protected $players = array();
    
    public function __construct() {
        ;
    }
    
    public function getPlayers()
    {
        return $this->players;
    }
    
    public function getPlayerCount()
    {
        return (int) count($this->players);
    }
    
    public function addPlayer(\Cilex\Players\Player $player)
    {
        $this->players[] = $player;
    }
}
