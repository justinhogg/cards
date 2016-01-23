<?php

/**
 * Sevens - A game of sevens
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Games;

class Sevens implements \Cilex\Games\GameInterface
{
    const GAME_NAME = 'sevens';
    
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
    
    /**
     * Returns the deck used for this game
     * @return \Cilex\Cards\Dec
     */
    public function getDeck() {
        return $this->deck;
    }
    
    /**
     * Gets the table
     * @return \Cilex\Players\Table
     */
    public function getTable()
    {
        return $this->table;
    }
    
    /**
     * Card limits per player for this game 
     * @return int
     */
    public function maxCardsPerRound() {
        return 7;
    }
    
    /**
     * Returns the winner/s of this game
     * @return array
     * @throws \InvalidArgumentException
     */
    public function getWinner() {
        
        $winningHand = array();
        
        //loop through the players and get the winner of the round
        if ($this->table->getPlayerCount() > 0) {
            //loop through the players
            foreach ($this->table->getPlayers() as $player) {
                //check to see if the player has a hand if not set the winning hand to value 0
                if($player->getHand()->getCardCount() > 0) {
                    $count = 0;
                    //count the card values
                    foreach ($player->getHand()->show() as $card) {
                        $count = $count + $card->getValue();
                    }
                    //add to the players array
                    $winningHand[$count][] = $player;
                } else {
                    $winningHand[0][] = $player;
                }
            }
        } else {
            throw new \InvalidArgumentException('Not enough players to determine a winner!');
        }
        
        //return the winning hands 
        return $winningHand[max(array_keys($winningHand))];
    }
    
    /**
     * Returns the name of the game
     * @return string
     */
    public static function getName()
    {
        return self::GAME_NAME;
    }
    
    /**
     * Returns information about the game
     * @return string
     */
    public static function getInformation()
    {
        return "<comment>". self::GAME_NAME ."</comment>: A game that deals seven random cards to players. The highest value of all cards determines the winner.\n";
    }
    
}
