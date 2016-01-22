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
     *
     * @return array
     */
    public function getPlayers();
    
    public function getDeck();
    
    public function nextMove();
    
    public function hasFinished();
    
    public function setFinished();
}
