<?php
/**
 * GameInterface
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Games;

Interface GameInterface {
    
    /**
     * Implements the the rules of the game
     * @return mixed 
     */
    public function gameRules();
    
    /**
     * Implements the the rules of the game
     * @param array $players
     * @return mixed 
     */
    public function gameLogic(array $players);
    
    /**
     * Returns the name of the game
     * @return string
     */
    public static function gameName();
    
    /**
     * Returns information about the game
     * @return string
     */
    public static function gameInformation();
    
    
}
