<?php
/**
 * Deck
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Cards;

use Cilex\Cards\Card;

class Deck
{
    
    protected $jokers = false;
    
    protected $deck;
    
    public function __construct($includeJokers = true)
    {
        //set the jokers
        $this->jokers = $includeJokers;
        
        $this->deck = $this->newDeck();
        
    }
    
    public function shuffle()
    {
        $deck = array();
        
        //put all the cards back into the deck
        $newDeck = $this->newDeck();
        
        //get the keys from the array
        $keys = array_keys($newDeck);
        
        //shuffle
        shuffle($keys);
        
        foreach($keys as $key) {
            $deck[$key] = $newDeck[$key];
        }
        
        $this->deck = $deck;
        
        return true;
    }
    
    public function cardsLeft()
    {
        
    }
    
    public function cards()
    {
        return $this->deck;
    }
    
    public function deal()
    {
        
    }
    
    public function hasJokers()
    {
        return (bool) $this->jokers;
    }
    
    protected function newDeck()
    {
        $deck = array();
        
        //amount of cards created
        $cardsCreated = 0;
        //add the cards by suit
        for ($suit = 1; $suit <= 4; $suit++) {
            //add the cards by value
            for ($value = 1; $value <= 13; $value++) {
                $deck[$cardsCreated] = new Card($suit, $value);
                $cardsCreated++;
            }
        }
        
        //add jokers to the pack if needed
        if ($this->hasJokers() === true) {
            $deck[52] = new Card(Card::SUIT_JOKER, 1);
            $deck[53] = new Card(Card::SUIT_JOKER, 2);
        }
        
        return $deck;
    }
}
