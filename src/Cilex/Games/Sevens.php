<?php

/**
 * Sevens - A game of sevens
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Games;

class Sevens extends \Cilex\Games\CardGame implements \Cilex\Games\GameInterface
{
    const GAME_NAME = 'sevens';
    
    /**
     * @param \Cilex\Cards\Deck $deck - deck of cards
     */
    public function __construct(\Cilex\Cards\Deck $deck)
    {
        parent::__construct($deck);
    }
    
    /**
     * Card limits per player for this game
     * @return int
     */
    public function maxCardsPerPlayer()
    {
        return 7;
    }
    
    /**
     * Implements the the rules of the game
     * @param array $players
     * @return mixed null|array
     */
    public function gameLogic(array $players)
    {
        $winningHand = array();
        //loop through the players
        foreach ($players as $player) {
            //check to see if player is a valid player object
            if ($player instanceof \Cilex\Players\Player) {
                //check to see if the player has a hand if not set the winning hand to value 0
                if ($player->getHand()->getCardCount() > 0) {
                    $count = 0;
                    //count the card values
                    foreach ($player->getHand()->show() as $card) {
                        $count = $count + $card->getValue();
                    }
                    //add to the players array
                    $winningHand[$count][] = $player;
                }
            } else {
                throw new \InvalidArgumentException('Invalid player in this game!');
            }
        }
        
        //if there were valid player hands then return a winner else null
        $winner = (!empty($winningHand)) ? $winningHand[max(array_keys($winningHand))] : null;
        
        //return the winner/s
        return $winner;
    }
    
    /**
     * Implements the the rules of the game
     * @return mixed
     */
    public function gameRules()
    {
        return null;
    }
    
    /**
     * Returns the name of the game
     * @return string
     */
    public static function gameName()
    {
        return self::GAME_NAME;
    }
    
    /**
     * Returns information about the game
     * @return string
     */
    public static function gameInformation()
    {
        return "<comment>". self::GAME_NAME ."</comment>: "
                . "A game that deals seven cards from a deck to players. "
                . "The highest value of all cards, held by a player, determines the winner.\n\n";
    }
}
