<?php
/**
 * Description of CardsCommand
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Cilex\Provider\Console\Command;

use Cilex\Players\Table;
use Cilex\Players\CasualPlayer;
use Cilex\Games\Sevens;
use Cilex\Cards\Deck;
use Cilex\Cards\Hand;
use Cilex\Cards\Card;

class CardsCommand extends Command
{
    
    const ARGUMENT_GAME_TYPE    = 'gameType';
    const ARGUMENT_GAME_PLAYERS = 'gamePlayers';
    
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            -> setName('play:game')
            ->addArgument(self::ARGUMENT_GAME_TYPE, InputArgument::REQUIRED, 'Please choose a card game!')
            ->addArgument(self::ARGUMENT_GAME_PLAYERS, InputArgument::REQUIRED, 'How many players ?');
    }
    
    /**
     * {@inheritDoc}
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        //game type
        $input->setArgument(self::ARGUMENT_GAME_TYPE, $this->getGameType($output));
        
        //amount of players
        $input->setArgument(self::ARGUMENT_GAME_PLAYERS, $this->addPlayers($output));
    }
    
    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $gameType    = $input->getArgument(self::ARGUMENT_GAME_TYPE);
        $gamePlayers = $input->getArgument(self::ARGUMENT_GAME_PLAYERS);
        
        //create a table with players
        $table = new Table();
        //add players
        for ($i = 1; $i <= $gamePlayers; $i++) {
            $player = new CasualPlayer();
            $player->setName('player '.$i);
            $table->addPlayer($player);
        }
        
        //create a new game
        switch($gameType) {
            case Sevens::GAME_NAME:
             
                //new game
                $game = new Sevens(new Deck(), $table);
                
                //output information
                $output->writeln("\nA new game of ".Sevens::getName()." has been created with ".$table->getPlayerCount()." player/s! and an unshuffled deck.");

                break;
        }
        
        if ($game) {
            //ask if the deck should be shown
            $this->showDeck($input, $output, $game->getDeck()->cards());

            //ask if the deck should be shuffled
            $deck = $this->shuffleDeck($input, $output, $game->getDeck());

            //ask if the deck should be dealt
            $this->deal($input, $output, $deck, $table, $game->maxCardsPerRound());

            //get the winner of the round
            $this->winningRound($output, $game->getWinner());
        }
    }
    
    /**
     * getGameType - interaction to establish the different game types
     *
     * @param OutputInterface $output
     * @return string
     */
    protected function getGameType(OutputInterface $output)
    {
        //set up the default type
        $defaultType = Sevens::getName();
        $question = array(
            "\n\n******************************GAMES AVALABLE******************************\n\n"
            . Sevens::getInformation()
            . "**************************************************************************\n\n",
            "<question>Please choose a card game to play:</question> [<comment>$defaultType</comment>] ",
        );
        $gameType = $this->getHelper('dialog')->askAndValidate($output, $question, function($typeInput) {
            if (!in_array($typeInput, array(
                    Sevens::getName()
                ))) {
                throw new \InvalidArgumentException('Invalid game type');
            }
            return $typeInput;
        }, 3, $defaultType);
        
        return $gameType;
    }
    
    /**
     * addPlayers - interaction to add players to the game
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function addPlayers(OutputInterface $output)
    {
        $defaultPlayers = 1;
        $question = array(
            "\n",
            "<question>How many players ? </question> [<comment>$defaultPlayers</comment>] ",
        );
        
        $players = $this->getHelper('dialog')->askAndValidate($output, $question, function($typeInput) {
            if ((int) $typeInput === 0) {
                throw new \InvalidArgumentException('There needs to be at least 1 player to play this game!');
            }
            return $typeInput;
        }, 3, $defaultPlayers);
        
        return (int) $players;
    }
    
    /**
     * showDeck - interaction to show deck
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param array $cards
     * @return 
     */
    protected function showDeck(InputInterface $input, OutputInterface $output, array $cards)
    {
        //output
        $output->writeln("\n");
        
        if ($this->getHelper('dialog')->askConfirmation(
            $output,
            "<question>Would you like to see the current deck?</question> ",
            false
        )) {
            //output
            $output->write("\n");
            //loop through each card
            foreach ($cards as $card) {
                //output
                $fg = ($card->getSuit() === Card::SUIT_HEARTS || $card->getSuit() === Card::SUIT_DIAMONDS) ? 
                        'red':'black';
                $output->write(" <fg=$fg;bg=white;options=underscore>".$card->getValueAsString()." of ".$card->getSuitAsString()."</> ");
            }
            return;
        }
    }
    
    /**
     * shuffleDeck - interaction to shuffle deck
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param \Cilex\Cards\Deck $deck
     * @return \Cilex\Cards\Deck
     */
    protected function shuffleDeck(InputInterface $input, OutputInterface $output, Deck $deck)
    {
        //output
        $output->writeln("\n");
        
        if ($this->getHelper('dialog')->askConfirmation(
            $output,
            "<question>Would you like to shuffle the current deck?</question> ",
            false
        )) {
            //shuffle the deck
            $deck->shuffle();
            
            //output
            $output->writeln("\nDeck has been shuffled.");
            
            //ask if the deck should be shown
            $this->showDeck($input, $output, $deck->cards());
            
            return $deck;
        }
        
        return $deck;
    }
    
    /**
     * dealDeck - interaction to deal the deck
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param \Cilex\Cards\Deck $deck
     * @param \Cilex\Players\Table $table
     * @param int $maxCardsPerRound
     *
     * @return 
     */
    protected function deal(InputInterface $input, OutputInterface $output, $deck, $table, $maxCardsPerRound)
    {
        //output
        $output->writeln("\n");
        
        if ($this->getHelper('dialog')->askConfirmation(
            $output,
            "<question>Would you like to deal?</question> ",
            false
        )) {
            $cards = $deck->cards();
            $cardKeys = array_keys($cards);
            
            $players = $table->getPlayers();
            
            for ($i = 0; $i < $maxCardsPerRound; $i++) {
                foreach ($players as $player) {
                    //create a new hand if one does not exist
                    ($player->getHand() === null) ? $player->newHand(new Hand()):false;
                    //deal a card from the deck
                    $deck->deal();
                    //get current card key pointer
                    $cardKey = current($cardKeys);
                    //move the pointer of the array to the next card
                    next($cardKeys);
                    //add current card in deck to the player's hand
                    $player->getHand()->addCard($cards[$cardKey]);
                }
            }

            //output information
            $output->writeln("\nAll ".$maxCardsPerRound." cards have been dealt to the ".$table->getPlayerCount()." player/s around the table.");
            $output->writeln("\nThere are ".$deck->cardsLeft()." cards left in the deck.");
            
            return;
        }
    }
    
    /**
     * winningRound - interaction to work out the winner of the round
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param array $winners
     *
     * @return 
     */
    protected function winningRound(OutputInterface $output, array $winners)
    {
        //output information
        $output->writeln("\n".count($winners)." winner/s of that round.");
        
        foreach ($winners as $winner) {
            //output
            $output->write("\n".$winner->getName()." had the following winning hand: ");
            
            //loop through each card
            foreach ($winner->getHand()->show() as $card) {
                //output
                $fg = ($card->getSuit() === Card::SUIT_HEARTS || $card->getSuit() === Card::SUIT_DIAMONDS) ? 
                        'red':'black';
                $output->write(" <fg=$fg;bg=white;options=underscore>".$card->getValueAsString()." of ".$card->getSuitAsString()."</> ");
            }
        }
        
        //output
        $output->writeln("\n");
        
        return;
    }
}
