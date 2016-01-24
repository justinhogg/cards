<?php
/**
 * Player
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Players;

class CasualPlayer extends \Cilex\Players\Player
{
    /**
     *
     * @param mixed null|string $playerName
     */
    public function __construct($playerName = null) 
    {
        parent::__construct($playerName);
    }

    /**
     * Returns a hand of cards
     * @return mixed null| \Cilex\Cards\Hand
     */
    public function getHand() 
    {
        return $this->hand;
    }
    
    /**
     * Sets a new hand for the player
     * @param \Cilex\Cards\Hand $hand
     */
    public function newHand(\Cilex\Cards\Hand $hand){
        $this->hand = $hand;
    }
   
}