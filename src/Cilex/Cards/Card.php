<?php
/**
 * Card
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Cards;

class Card
{
    /**
     * Suits
     */
    const SUIT_JOKER    = 0;
    const SUIT_HEARTS   = 1;
    const SUIT_DIAMONDS = 2;
    const SUIT_CLUBS    = 3;
    const SUIT_SPADES   = 4;
    
    /**
     * Non Numeric Cards
     */
    const TYPE_ACE      = 1;
    const TYPE_JACK     = 11;
    const TYPE_QUEEN    = 12;
    const TYPE_KING     = 13;
    
    /**
     * @var array 
     */
    public $suits = array(
        self::SUIT_JOKER    => 'joker',
        self::SUIT_HEARTS   => 'hearts',
        self::SUIT_DIAMONDS => 'diamonds',
        self::SUIT_CLUBS    => 'clubs',
        self::SUIT_SPADES   => 'spades'
    );
    
    /**
     * @var array
     */
    public $nonNumericCards = array(
        self::TYPE_ACE      => 'ace',
        self::TYPE_JACK     => 'jack',
        self::TYPE_QUEEN    => 'queen',
        self::TYPE_KING     => 'kind'
    );
    
    public function __construct() 
    {
        ;
    }
    
    public function setCard($suit, $value)
    {
        
    }
    
    public function getSuit()
    {
        
    }
    
    public function getValue()
    {
        
    }
}
