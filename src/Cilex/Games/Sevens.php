<?php

/**
 * Sevens - A game of sevens
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Games;

class Sevens implements \Cilex\Games\GameInterface
{
    /**
     * @var \Cilex\Cards\Deck 
     */
    protected $deck;
    
    /**
     * @var \Cilex\Players\Table 
     */
    protected $table;
    
    /**
     * @param \Cilex\Cards\Deck $deck - deck of cards
     * @param \Cilex\Players\Table $table - table of players
     */
    public function __construct(\Cilex\Cards\Deck $deck, \Cilex\Players\Table $table) {
        //set the deck
        $this->deck     = $deck;
        //set the table
        $this->table    = $table;
    }
    
    public function getDeck() {
        return $this->deck;
    }
    
    /**
     * Gets the players playing this game
     *
     * @return array
     */
    public function getPlayers() 
    {
        return $this->table->getPlayers();
    }
    
    public function maxCardsPerRound() {
        return 7;
    }
    
    public function getWinner() {
        
        $winningHand = array();
        
        //loop through the players and get the winner of the round
        foreach ($this->getPlayers() as $player) {
            if($player->getHand() !== null) {
                $count = 0;
                //count the card values
                foreach ($player->getHand()->show() as $card) {
                    $count = $count + $card->getValue();
                }
                //add to the players array
                $winningHand[$count][] = $player;
            }
        }
        
        //return the winning hands 
        return $winningHand[max(array_keys($winningHand))];
    }
}
