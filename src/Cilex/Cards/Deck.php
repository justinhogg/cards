<?php
/**
 * Deck
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Cards;

class Deck
{
    protected $jokers;
    
    public function __construct($includeJokers = true)
    {
        $this->jokers = $includeJokers;
    }
    
    public function shuffle()
    {
        
    }
    
    public function cardsLeft()
    {
        
    }
    
    public function deal()
    {
        
    }
    
    public function hasJokers()
    {
        return (bool) $this->jokers;
    }
}
