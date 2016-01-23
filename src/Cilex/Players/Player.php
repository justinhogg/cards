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
    
    /**
     * Returns the wins of the player
     * @return int
     */
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
    
    /**
     * Sets the losses of the player
     */
    public function setLosses()
    {
        $this->losses++;
    }
    
    /**
     * Sets the wins of the player
     */
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
    
    /**
     * Sets a new hand for the player
     * @param \Cilex\Cards\Hand $hand
     */
    public function newHand(\Cilex\Cards\Hand $hand)
    {
        $this->hand = $hand;
    }

    /**
     * Returns the hand of the player
     */
    abstract public function getHand();
}
