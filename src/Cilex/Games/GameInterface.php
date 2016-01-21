<?php
/**
 * GameInterface
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Games;

Interface GameInterface {
    
    public function setPlayers();
    
    public function getPlayers();
    
    public function getDeck();
    
    public function nextMove();
    
    public function hasFinished();
    
    public function setFinished();
}
