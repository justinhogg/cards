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
     * Gets the players playing this game
     * @return array
     */
    public function getPlayers();
    
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
}
