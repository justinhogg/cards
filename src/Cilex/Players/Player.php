<?php
/**
 * Player
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Players;

abstract class Player {
    
    protected $name = 'player';
    
    protected $hand;
    
    public function getLosses()
    {
        ;
    }
    
    public function getWins()
    {
        ;
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
        ;
    }
    
    public function setWins()
    {
        ;
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
