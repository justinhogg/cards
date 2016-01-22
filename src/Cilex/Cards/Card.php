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
    
    /**
     * @var int 
     */
    protected $suit;
    
    /**
     * @var int
     */
    protected $value;
    
    /**
     *
     * @param mixed $suit
     * @param mixed $value
     * @throws \InvalidArgumentException
     */
    public function __construct($suit, $value) 
    {
        //if suit is not defined and value is outside of the range then throw exception
        if (($suit !== self::SUIT_JOKER && !array_key_exists($suit, $this->suits)) || $value < 1 || $value > 13 ) {
            throw new \InvalidArgumentException('Invalid card suit or value');
        }
        //set suit
        $this->suit = $suit;
        //set value
        $this->value = $value;
    }
    
    /**
     * Returns the set suit for this card
     * @return int
     */
    public function getSuit()
    {
        return (int) $this->suit;
    }
    
    /**
     * Returns the suit as a string
     * @return string
     */
    public function getSuitAsString()
    {
        return (array_key_exists($this->suit, $this->suits)) ? $this->suits[$this->suit]: 'joker';
    }
    
    /**
     * Returns the value of the card
     * @return int
     */
    public function getValue()
    {
        return (int) $this->value;
    }
    
    /**
     * Returns the value of the card as a string
     * @return string
     */
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
