<?php
/**
 * Round
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Games;

use Cilex\Cards\Hand;

class Round
{
    
    protected $table;
    
    protected $cards;
    
    protected $players;
    
    protected $playerCardLimit;
    
    protected $cardKeys = array();
    
    protected $finished = false;


    public function __construct(\Cilex\Players\Table $table)
    {
        
        $this->table        = $table;
        
        $this->cards        = $this->table->getGame()->getDeck()->cards();
        
        $this->cardKeys     = array_keys($this->cards);
        
        $this->players      = $this->table->getPlayers();
        
        $this->playerCardLimit = $this->table->getGame()->maxCardsPerPlayer();
    }
    
    /**
     * Deal the round
     * @return \Symfony\Component\Console\Output\OutputInterface
     */
    public function start(\Symfony\Component\Console\Output\OutputInterface $output)
    {
        //TODO add interaction with console here ie ask to deal to player 1 etc
        //TODO abstract each move into smaller manageble methods
        
        for ($i = 0; $i < $this->playerCardLimit; $i++) {
            foreach ($this->players as $player) {
                //create a new hand if one does not exist
                ($player->getHand() === null) ? $player->newHand(new Hand()):false;
                //deal a card from the deck
                $this->table->getGame()->getDeck()->deal();
                //get current card key pointer
                $cardKey = current($this->cardKeys);
                //move the pointer of the array to the next card
                next($this->cardKeys);
                //add current card in deck to the player's hand
                $player->getHand()->addCard($this->cards[$cardKey]);
            }
        }
        //set the round finished
        $this->setFinished();
        //output information
        $output->writeln("\nAll ".$this->playerCardLimit." "
                . "cards have been dealt to the ".$this->table->getPlayerCount()." "
                . "player/s around the table.");
        $output->writeln("\nThere are ".$this->table->getGame()->getDeck()->cardsLeft()." cards left in the deck.\n");
        
        return $output;
    }
    
    /**
     * Returns the winner/s of this game
     * @return array
     * @throws \InvalidArgumentException
     */
    public function getWinner()
    {
        if ($this->isFinished()) {
            //loop through the players and get the winner of the round
            if ($this->table->getPlayerCount() > 0) {
                return $this->table->getGame()->gameLogic($this->table->getPlayers());
            } else {
                throw new \InvalidArgumentException('Not enough players to determine a winner!');
            }
        } else {
            throw new \InvalidArgumentException('The round is not yet finished!');
        }
    }
    
    /**
     * Returns whether the round has finished
     * @return boolean
     */
    public function isFinished()
    {
        return (boolean) $this->finished;
    }
    
    /**
     * Sets whether this round is finished
     */
    public function setFinished()
    {
        $this->finished = true;
    }
}
