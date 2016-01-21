<?php
/**
 * Player
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Players;

abstract class Player {
    
    public function __construct() {
        ;
    }
    
    public function getLosses();
    
    public function getWins();
    
    public function setName();
    
    public function setLosses();
    
    public function setWins();
    
    abstract public function getName();
     
    abstract public function hand();
}
