<?php
/**
 * GameInterface
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Games;

Interface GameInterface {
    
    /**
     *
     * @param \Cilex\Cards\Deck $deck - deck of cards
     * @param \Cilex\Players\Table $table - table of players
     */
    public function __construct(\Cilex\Cards\Deck $deck, \Cilex\Players\Table $table);
    
    /**
     * Gets the table
     * @return \Cilex\Players\Table
     */
    public function getTable();
    
    /**
     * Returns the deck used for this game
     * @return \Cilex\Cards\Dec
     */
    public function getDeck();
    
    /**
     * Returns the winner/s of this game
     * @return array
     */
    public function getWinner();
    
    /**
     * Card limits per player for this game 
     * @return int
     */
    public function maxCardsPerRound();
    
    /**
     * Returns the name of the game
     * @return string
     */
    public static function getName();
    
    /**
     * Returns information about the game
     * @return string
     */
    public static function getInformation();
    
    
}
