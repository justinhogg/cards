<?php

/**
 * Abstract class CardGame
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Games;

abstract class CardGame
{
    
    /**
     * @var \Cilex\Cards\Deck
     */
    protected $deck;
    
    /**
     * @param \Cilex\Cards\Deck $deck - deck of cards
     */
    public function __construct(\Cilex\Cards\Deck $deck)
    {
        //set the deck
        $this->deck = $deck;
    }
    
    /**
     * Returns the deck used for this game
     * @return \Cilex\Cards\Deck
     */
    public function getDeck()
    {
        return $this->deck;
    }
    
    /**
     * Card limits per player for this game
     * @return int
     */
    abstract public function maxCardsPerPlayer();
}
