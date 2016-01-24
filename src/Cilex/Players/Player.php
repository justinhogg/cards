<?php
/**
 * Player
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Players;

abstract class Player {
    
    protected $name;
    
    protected $hand;
    
    protected $wins     = 0;
    
    protected $losses   = 0;
    
    /**
     *
     * @param mixed null|string $playerName
     */
    public function __construct($playerName = null) 
    {
        $this->setName(($playerName !== null) ? $playerName: 'player');
    }
    
    /**
     * Returns the losses of the player
     * @return int
     */
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
     * Set a name for the player
     *
     * @param string $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Sets a new hand for the player
     * @param \Cilex\Cards\Hand $hand
     */
    abstract public function newHand(\Cilex\Cards\Hand $hand);

    /**
     * Returns the hand of the player
     */
    abstract public function getHand();
}
