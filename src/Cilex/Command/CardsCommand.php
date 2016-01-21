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

class CardsCommand extends Command
{
    
    const ARGUMENT_GAME_TYPE    = 'gameType';
    const ARGUMENT_GAME_PLAYERS = 'gamePlayers';
    const GAME_SEVENS           = 'sevens';
    
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
        $text = array();
        
        $gameType    = $input->getArgument(self::ARGUMENT_GAME_TYPE);
        $gamePlayers = $input->getArgument(self::ARGUMENT_GAME_PLAYERS);
        
        //create a new account
        switch($gameType) {
            case self::GAME_SEVENS:
                $game = new \Cilex\Games\Sevens();
                break;
        }
        
        //output
        $output->writeln($text);
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
        $defaultType = self::GAME_SEVENS;
        $question = array(
            "<comment>". self::GAME_SEVENS ."</comment>: A game that deals seven random cards to players. The highest value of all cards determines the winner. \n",
            "<question>Please choose a card game to play:</question> [<comment>$defaultType</comment>] ",
        );
        $gameType = $this->getHelper('dialog')->askAndValidate($output, $question, function($typeInput) {
            if (!in_array($typeInput, array(
                    self::GAME_SEVENS
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
            "<comment>1</comment>: Default number of players for this game.\n",
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
    
}
