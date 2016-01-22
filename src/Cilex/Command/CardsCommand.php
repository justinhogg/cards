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
        $gameType    = $input->getArgument(self::ARGUMENT_GAME_TYPE);
        $gamePlayers = $input->getArgument(self::ARGUMENT_GAME_PLAYERS);
        
        //create a table with players
        $table = new \Cilex\Players\Table();
        //add players
        for ($i = 1; $i <= $gamePlayers; $i++) {
            $player = new \Cilex\Players\CasualPlayer();
            $player->setName('player '.$i);
            $table->addPlayer($player);
        }
        
        //create a new game
        switch($gameType) {
            case self::GAME_SEVENS:
             
                //new game
                $game = new \Cilex\Games\Sevens(new \Cilex\Cards\Deck(false), $table);
                
                //output information
                $output->writeln("\nA new game of ".self::GAME_SEVENS." has been created with ".$gamePlayers." player/s! and an unshuffled deck.");
                
                //ask if the deck should be shown
                $this->showDeck($input, $output, array_reverse($game->getDeck()->cards(), true));
                
                //ask if the deck should be shuffled
                $this->shuffleDeck($input, $output, $game->getDeck());
                
                //ask if the deck should be dealt
                $this->deal($input, $output, $game);
                
                break;
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
        $defaultType = self::GAME_SEVENS;
        $question = array(
            "\n\n******************************GAMES AVALABLE******************************\n\n"
            . "<comment>". self::GAME_SEVENS ."</comment>: A game that deals seven random cards to players. The highest value of all cards determines the winner.\n\n"
            . "**************************************************************************\n\n",
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
            $output->write("\n|");
            //loop through each card
            foreach ($cards as $card) {
                //output
                $output->write(" ".$card->getValueAsString()." of ".$card->getSuitAsString()." |");
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
    protected function shuffleDeck(InputInterface $input, OutputInterface $output, \Cilex\Cards\Deck $deck)
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
            $this->showDeck($input, $output, array_reverse($deck->cards(), true));
            
            return $deck;
        }
    }
    
    /**
     * dealDeck - interaction to deal the deck
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param mixed $game
     * @return 
     */
    protected function deal(InputInterface $input, OutputInterface $output, $game)
    {
        //output
        $output->writeln("\n");
        
        if ($this->getHelper('dialog')->askConfirmation(
            $output,
            "<question>Would you like to deal?</question> ",
            false
        )) {
            $cardsUsed = 0;
            $cards = $game->getDeck()->cards();
            $players = $game->getPlayers();
            
            for ($i = 0; $i < $game->maxCardsPerRound(); $i++) {
                foreach ($players as $player) {
                    //create a new hand if one does not exist
                    ($player->getHand() === null) ? $player->newHand(new \Cilex\Cards\Hand()):false;
                    //deal a card from the deck
                    $game->getDeck()->deal();
                    //add card to the player's hand
                    $player->getHand()->addCard($cards[$cardsUsed]);
                    $cardsUsed++;
                }
            }
            //TODO sort shuffle out
            //var_dump($players[0]->getHand()->show(), $players[1]->getHand()->show());exit;
            return;
        }
    }
}
