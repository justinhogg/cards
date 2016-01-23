<?php
/**
 * Description of SevensTest
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Tests\Games;

class SevensTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cilex\Games\Sevens
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
        
        $mockDeck = $this->getMock('Cilex\Cards\Deck');
        //set up mock table
        $mockTable = $this->getMock('Cilex\Players\Table', array('getPlayers','getPlayerCount'));
        
        switch ($this->getName()) {
            case 'testGetWinnerNoPlayers':
                $mockTable->expects($this->any())->method('getPlayerCount')->will($this->returnValue(0));
                break;
            case 'testGetWinnerNoHand':
                $mockHand->expects($this->any())->method('getCardCount')->will($this->returnValue(0));
                $mockTable->expects($this->any())->method('getPlayerCount')->will($this->returnValue(1));
                $mockTable->expects($this->any())->method('getPlayers')->will($this->returnValue(array(0=>$mockPlayer)));
                break;
            default:
                $mockHand->expects($this->any())->method('getCardCount')->will($this->returnValue(1));
                $mockTable->expects($this->any())->method('getPlayerCount')->will($this->returnValue(1));
                $mockTable->expects($this->any())->method('getPlayers')->will($this->returnValue(array(0=>$mockPlayer)));
                break;
        }

        $this->object = new \Cilex\Games\Sevens($mockDeck, $mockTable);
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
     * @covers Cilex\Games\Sevens::__construct
     */
    public function testConstruct()
    {
    }
    
    /**
     * @covers Cilex\Games\Sevens::getTable
     */
    public function testGetTable()
    {
        $this->assertInstanceOf('\Cilex\Players\Table', $this->object->getTable());
    }
    
    /**
     * @covers Cilex\Games\Sevens::getDeck
     */
    public function testGetDeck()
    {
        $this->assertInstanceOf('\Cilex\Cards\Deck', $this->object->getDeck());
    }
    
    /**
     * @covers Cilex\Games\Sevens::maxCardsPerRound
     */
    public function testMaxCardsPerRound()
    {
        $this->assertEquals(7, $this->object->maxCardsPerRound());
    }
    
    /**
     * @covers Cilex\Games\Sevens::getWinner
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Not enough players to determine a winner!
     */
    public function testGetWinnerNoPlayers()
    {
        $this->object->getWinner();
    }
    
    /**
     * @covers Cilex\Games\Sevens::getWinner
     */
    public function testGetWinnerNoHand()
    {
        $winner = $this->object->getWinner();
        $this->assertArrayHasKey(0, $winner);
        $this->assertInstanceOf('\Cilex\Players\Player', $winner[0]);
    }
    
    /**
     * @covers Cilex\Games\Sevens::getWinner
     */
    public function testGetWinner()
    {
        $winner = $this->object->getWinner();
        $this->assertArrayHasKey(0, $winner);
        $this->assertInstanceOf('\Cilex\Players\Player', $winner[0]);
    }
    
    /**
     * @covers Cilex\Games\Sevens::getName
     */
    public function testGetName()
    {
        $this->assertEquals('sevens', $this->object->getName());
    }
    
    /**
     * @covers Cilex\Games\Sevens::getInformation
     */
    public function testInformation()
    {
        $this->assertStringMatchesFormat('%a', \Cilex\Games\Sevens::getInformation());
    }
}
