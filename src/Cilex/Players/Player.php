<?php
/**
 * Player
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Players;

abstract class Player {
    
    protected $name     = 'player';
    
    protected $hand;
    
    protected $wins     = 0;
    
    protected $losses   = 0;
    
    public function getLosses()
    {
        return (int) $this->losses;
    }
    
    public function getWins()
    {
        return (int) $this->wins;
    }
    
    /**
     * Set a name for the player
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function setLosses()
    {
        $this->losses++;
    }
    
    public function setWins()
    {
        $this->wins++;
    }
    
    /**
     * Returns the name of the player
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    public function newHand(\Cilex\Cards\Hand $hand)
    {
        $this->hand = $hand;
    }

    abstract public function getHand();
}
