<?php
/**
 * Description of GamesCommand
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
use Cilex\Games\Round;
use Cilex\Cards\Deck;

class GamesCommand extends Command
{
    
    const ARGUMENT_GAME_TYPE    = 'gameType';
    const ARGUMENT_GAME_PLAYERS = 'gamePlayers';
    
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            -> setName('play:cards')
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
        //add players to the table
        for ($i = 1; $i <= $gamePlayers; $i++) {
            $table->addPlayer(new CasualPlayer('player '.$i));
        }
        
        //create a new game
        switch($gameType) {
            case Sevens::GAME_NAME:
                // add new game to the table
                $table->addCardGame(new Sevens(new Deck()));
                //output information
                $output->writeln("\nA new game of ".Sevens::gameName()." has been created with ".$table->getPlayerCount()." player/s! and an unshuffled deck.\n");
                break;
        }

        //if the table has a game then continue
        if ($table->hasCardGame()) {
            //ask if the deck should be shown
            $this->showDeck($output, $table);
            
            //ask if the deck should be shuffled
            $this->shuffleDeck($output, $table);

            //ask if the round should begin
            $this->beginRound($output, $table);
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
        $defaultType = Sevens::gameName();
        $question = array(
            "\n\n******************************GAMES AVALABLE******************************\n\n"
            . Sevens::gameInformation()
            . "**************************************************************************\n\n",
            "<question>Please choose a card game to play:</question> [<comment>$defaultType</comment>] ",
        );
        $gameType = $this->getHelper('dialog')->askAndValidate($output, $question, function($typeInput) {
            if (!in_array($typeInput, array(
                    Sevens::gameName()
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
     * @param OutputInterface $output
     * @param Table $table
     * @return 
     */
    protected function showDeck(OutputInterface $output, Table $table)
    {
        if ($this->getHelper('dialog')->askConfirmation(
            $output,
            "<question>Would you like to see the current deck?</question> [<comment>y or n</comment>] ",
            false
        )) {
            //view Deck
            $output = $table->getGame()->getDeck()->view($output);
            return;
        }
        //output
        $output->writeln("\n");
    }
    
    /**
     * shuffleDeck - interaction to shuffle deck
     *
     * @param OutputInterface $output
     * @param Table $table
     * @return 
     */
    protected function shuffleDeck(OutputInterface $output, Table $table)
    {
        if ($this->getHelper('dialog')->askConfirmation(
            $output,
            "<question>Would you like to shuffle the current deck?</question> [<comment>y or n</comment>] ",
            false
        )) {
            //shuffle the deck
            $table->getGame()->getDeck()->shuffle();
            
            //output
            $output->writeln("\nDeck has been shuffled.\n");
            
            //ask if the deck should be shown
            $this->showDeck($output, $table);
            
            return;
        }
        
        //output
        $output->writeln("\n");
    }
    
    /**
     * beginRound - interaction to begin the round
     *
     * @param OutputInterface $output
     * @param Table $table
     *
     * @return 
     */
    protected function beginRound(OutputInterface $output, $table)
    {
        if ($this->getHelper('dialog')->askConfirmation(
            $output,
            "<question>Would you like to start the round?</question> [<comment>y or n</comment>] ",
            false
        )) {
            //start new round
            $round = new Round($table);
            $output = $round->start($output);
            
            if ($round->isFinished()) {
                $winners = $round->getWinner();
                //check to see if we have winners
                if($winners !== null) {
                    //output information
                    $output->writeln("\n".count($winners)." winner/s of that round.");
                    //lop through the winners and show the hand
                    foreach ($winners as $winner) {
                        //output
                        $output->write("\n".$winner->getName()." had the following winning hand: ");
                        //loop through each card and show
                        foreach ($winner->getHand()->show() as $card) {
                            $output = $card->view($output);
                        }
                    }
                } else {
                    //output information
                    $output->writeln("\nThere were no winners of that round.");
                }
            }
            
            $output->writeln("\n");
            
            return;
        }
    }
}
