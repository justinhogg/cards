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
    const SUIT_CLUBS    = 2;
    const SUIT_SPADES   = 3;
    const SUIT_DIAMONDS = 4;
    
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
        self::SUIT_HEARTS   => 'hearts',
        self::SUIT_DIAMONDS => 'diamonds',
        self::SUIT_CLUBS    => 'clubs',
        self::SUIT_SPADES   => 'spades'
    );
    
    protected $suit;
    
    protected $value;
    
    public function __construct($suit, $value) 
    {
        if (!array_key_exists($suit, $this->suits) && ($value < 1 || $value > 13 )) {
            throw new \InvalidArgumentException('Invalid card suit or value');
        }
        
        $this->suit = $suit;
        
        $this->value = $value;
    }
    
    public function getSuit()
    {
        return $this->suit;
    }
    
    public function getSuitAsString()
    {
        return (array_key_exists($this->suit, $this->suits)) ? $this->suits[$this->suit]: 'joker';
    }
    
    public function getValue()
    {
        return (int) $this->value;
    }
    
    public function getValueAsString()
    {
        $value = '';
        
        switch ($this->value) {
            case self::TYPE_ACE:
                $value = 'ace';
                break;
            case self::TYPE_JACK:
                $value = 'jack';
                break;
            case self::TYPE_QUEEN:
                $value = 'queen';
                break;
            case self::TYPE_KING:
                $value = 'king';
                break;
            default:
                $value = $this->value;
                break;
        }
        
        return $value;
    }
    
    
}
