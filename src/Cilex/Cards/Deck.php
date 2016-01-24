<?php
/**
 * Deck
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Cards;

use Cilex\Cards\Card;

class Deck
{
    /**
     * @var boolean
     */
    protected $jokers = false;
    
    /**
     * @var array
     */
    protected $deck;
    
    /**
     * @var int
     */
    protected $cardsUsed = 0;
    
    /**
     *
     * @param boolean $includeJokers
     */
    public function __construct($includeJokers = false)
    {
        //set the jokers
        $this->jokers = $includeJokers;
        
        $this->deck = $this->newDeck();
        
    }
    
    /**
     * Takes a new deck of cards and shuffles
     * @return boolean
     */
    public function shuffle()
    {
        $deck = array();
        
        //put all the cards back into the deck
        $newDeck = $this->newDeck();
        
        //get the keys from the array
        $keys = array_keys($newDeck);
        
        //shuffle
        shuffle($keys);
        
        foreach ($keys as $key) {
            $deck[$key] = $newDeck[$key];
        }
        
        $this->deck = $deck;
        
        return true;
    }
    
    /**
     * Returns the amount of cards left in the deck
     * @return int
     */
    public function cardsLeft()
    {
        return (int) (count($this->deck) - $this->cardsUsed);
    }
    
    /**
     * Returns the cards in a reverse order
     * @return array
     */
    public function cards()
    {
        return array_reverse($this->deck, true);
    }
    
    /**
     * Deal increments the cards used by the deck, throws exception if no more cards left
     * @throws \InvalidArgumentException
     */
    public function deal()
    {
        //if all the cards have been used
        if ($this->cardsUsed === count($this->deck)) {
            throw new \InvalidArgumentException('No more cards left in this deck!');
        }
        
        //increment the cards used
        $this->cardsUsed++;
        
    }
    
    /**
     * Returns whether this deck is using jokers
     * @return boolean
     */
    public function hasJokers()
    {
        return (bool) $this->jokers;
    }
    
    /**
     * Builds a new deck of cards, includes jokers if needed
     * @return array
     */
    protected function newDeck()
    {
        $deck = array();
        
        //amount of cards created
        $cardsCreated = 0;
        //add the cards by suit
        for ($suit = 1; $suit <= 4; $suit++) {
            //add the cards by value
            for ($value = 1; $value <= 13; $value++) {
                $deck[$cardsCreated] = new Card($suit, $value);
                $cardsCreated++;
            }
        }
        
        //add jokers to the pack if needed
        if ($this->hasJokers() === true) {
            $deck[52] = new Card(Card::SUIT_JOKER, 1);
            $deck[53] = new Card(Card::SUIT_JOKER, 2);
        }
        
        return $deck;
    }
    
    /**
     * Output the deck to the console and view
     * @return \Symfony\Component\Console\Output\OutputInterface
     */
    public function view(\Symfony\Component\Console\Output\OutputInterface $output)
    {
        
        $output->write("\n");
        
        //loop through each card
        foreach ($this->cards() as $card) {
            $output = $card->view($output);
        }
        $output->writeln("\n");
        
        return $output;
    }
}
