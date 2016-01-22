<?php
/**
 * Hand
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Cards;

class Hand
{
    protected $cards;
    
    public function __construct()
    {
        ;
    }
    
    public function addCard(\Cilex\Cards\Card $card)
    {
        $this->cards[] = $card;
    }
    
    public function removeCard()
    {
        
    }
    
    public function getCardCount()
    {
        
    }
    
    public function getCardPosition()
    {
        
    }
    
    public function sortBySuit()
    {
        
    }
    
    public function sortByValue()
    {
        
    }
    
    public function show()
    {
        return $this->cards;
    }
}
