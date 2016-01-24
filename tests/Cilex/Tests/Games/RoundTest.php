<?php
/**
 * Description of RoundTest
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Tests\Games;

class RoundTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cilex\Games\Round
     */
    protected $object;
     /**
     * @var class
     */
    protected $class;
    /**
     *
     * @var array
     */
    protected $attributes;
    
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {

        //set up test object
        $mockCard = $this->getMock('Cilex\Cards\Card', array('getValue'), array(1,5));
        $mockCard->expects($this->any())->method('getValue')->will($this->returnValue(5));
        
        $mockHand = $this->getMock('Cilex\Cards\Hand', array('addCard', 'show', 'getCardCount'));
        $mockHand->expects($this->any())->method('addCard')->will($this->returnValue($mockCard));
        $mockHand->expects($this->any())->method('show')->will($this->returnValue(array(0=>$mockCard)));
        
        $mockPlayer = $this->getMock('Cilex\Players\CasualPlayer', array('getHand'));
        $mockPlayer->expects($this->any())->method('getHand')->will($this->returnValue($mockHand));
       
        $mockDeck = $this->getMock('Cilex\Cards\Deck', array('cards'));
        $mockDeck->expects($this->any())->method('cards')->will($this->returnValue(array(0=>$mockCard)));
        
        $mockGame = $this->getMock('Cilex\Games\Sevens', array('getDeck','gameLogic'), array($mockDeck));
        $mockGame->expects($this->any())->method('getDeck')->will($this->returnValue($mockDeck));
        $mockGame->expects($this->any())->method('gameLogic')->will($this->returnValue(array(0=>$mockPlayer)));
        
        //set up mock table
        $mockTable = $this->getMock('Cilex\Players\Table', array('getPlayers','getPlayerCount', 'getGame'));
        $mockTable->expects($this->any())->method('getGame')->will($this->returnValue($mockGame));
        
        switch ($this->getName()) {
            case 'testGetWinnerNotEnoughPlayers':
                $mockTable->expects($this->any())->method('getPlayerCount')->will($this->returnValue(0));
                break;
            default:
                $mockHand->expects($this->any())->method('getCardCount')->will($this->returnValue(1));
                $mockTable->expects($this->any())->method('getPlayerCount')->will($this->returnValue(1));
                $mockTable->expects($this->any())->method('getPlayers')->will($this->returnValue(array(0=>$mockPlayer)));
                break;
        }
        
        $this->object = new \Cilex\Games\Round($mockTable);
    }
    
    /**
     * Tears down the fixture.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
    
    /**
     * Tests whether the constructor instantiates the correct dependencies.
     * @covers Cilex\Games\Round::__construct
     */
    public function testConstruct()
    {
    }
    
    /**
     * @covers Cilex\Games\Round::isFinished
     */
    public function testIsNotFinished()
    {
        $this->assertFalse($this->object->isFinished());
    }
    
    /**
     * @covers Cilex\Games\Round::isFinished
     * @covers Cilex\Games\Round::setFinished
     */
    public function testIsFinished()
    {
        $this->object->setFinished();
        
        $this->assertTrue($this->object->isFinished());
    }
    
    /**
     * @covers Cilex\Games\Round::getWinner
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage The round is not yet finished!
     */
    public function testGetWinnerRoundNotFinished()
    {
        $this->object->getWinner();
    }
    
    /**
     * @covers Cilex\Games\Round::getWinner
     * @covers Cilex\Games\Round::setFinished
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Not enough players to determine a winner!
     */
    public function testGetWinnerNotEnoughPlayers()
    {
        $this->object->setFinished();
        
        $this->object->getWinner();
    }
    
    /**
     * @covers Cilex\Games\Round::getWinner
     * @covers Cilex\Games\Round::setFinished
     */
    public function testGetWinner()
    {
        $this->object->setFinished();
        
        $winner = $this->object->getWinner();
        
        $this->assertArrayHasKey(0, $winner);
        $this->assertInstanceOf('Cilex\Players\Player', $winner[0]);
    }
    
    /**
     * @covers Cilex\Games\Round::start
     */
    public function testStart()
    {
        $mockOutput = $this->getMockForAbstractClass('Symfony\Component\Console\Output\OutputInterface');
        
        $this->assertInstanceOf('\Symfony\Component\Console\Output\OutputInterface',  $this->object->start($mockOutput));
    }
    
}
