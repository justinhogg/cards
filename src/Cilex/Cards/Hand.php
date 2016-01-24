<?php
/**
 * Hand
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Cards;

class Hand
{
    /**
     * @var array
     */
    protected $cards = array();
    
    public function __construct()
    {
    }
    
    /**
     * Adds a card to the hand
     * @param \Cilex\Cards\Card $card
     */
    public function addCard(\Cilex\Cards\Card $card)
    {
        $this->cards[] = $card;
    }
    
    /**
     * Returns the amount of cards in the hand
     * @return int
     */
    public function getCardCount()
    {
        return (int) count($this->cards);
    }
    
    /**
     *
     * @return null
     */
    public function sortBySuit()
    {
        return null;
    }
    
    /**
     *
     * @return null
     */
    public function sortByValue()
    {
        return null;
    }
    
    /**
     * Returns the cards in this hand
     * @return array
     */
    public function show()
    {
        return $this->cards;
    }
}
