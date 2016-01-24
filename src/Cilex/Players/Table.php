<?php
/**
 * Table of players
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Players;

class Table
{

    /**
     * @var array
     */
    protected $players = array();
    
    /**
     * @var mixed
     */
    protected $game;
    
    public function __construct()
    {
    }
    
    /**
     * Returns the players at the table
     * @return array
     */
    public function getPlayers()
    {
        return $this->players;
    }
    
    /**
     * Returns the game at the table
     * @return mixed
     */
    public function getGame()
    {
        return $this->game;
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
    
    /**
     * Adds a card game to the table
     * @param \Cilex\Games\CardGame $game
     */
    public function addCardGame(\Cilex\Games\CardGame $game)
    {
        $this->game = $game;
    }
    
    /**
     * Returns whether this table has a card game or not
     * @return boolean
     */
    public function hasCardGame()
    {
        return (boolean) ($this->game && $this->game instanceof \Cilex\Games\CardGame) ? true: false;
    }
}
