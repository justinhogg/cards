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
     * @var Cilex\Players\Player
     */
    protected $mockPlayer;
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
        //set up test objects
        
        //set up test object
        $mockCard = $this->getMock('Cilex\Cards\Card', array('getValue'), array(1,5));
        $mockCard->expects($this->any())->method('getValue')->will($this->returnValue(5));
        
        $mockHand = $this->getMock('Cilex\Cards\Hand', array('addCard', 'show', 'getCardCount'));
        $mockHand->expects($this->any())->method('addCard')->will($this->returnValue($mockCard));
        $mockHand->expects($this->any())->method('show')->will($this->returnValue(array(0=>$mockCard)));
        
        switch ($this->getName()) {
            case 'testGameLogicWithNoWinner':
                $mockHand->expects($this->any())->method('getCardCount')->will($this->returnValue(0));
                break;
            default:
                $mockHand->expects($this->any())->method('getCardCount')->will($this->returnValue(1));
                break;
        }
        
        $this->mockPlayer = $this->getMock('Cilex\Players\CasualPlayer', array('getHand'));
        $this->mockPlayer->expects($this->any())->method('getHand')->will($this->returnValue($mockHand));
        
        $mockDeck = $this->getMock('Cilex\Cards\Deck');
        
        $this->object = new \Cilex\Games\Sevens($mockDeck);
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
     * @covers Cilex\Games\CardGame::__construct
     */
    public function testConstruct()
    {
    }
    
    /**
     * @covers Cilex\Games\Sevens::getDeck
     */
    public function testGetDeck()
    {
        $this->assertInstanceOf('\Cilex\Cards\Deck', $this->object->getDeck());
    }
    
    /**
     * @covers Cilex\Games\Sevens::maxCardsPerPlayer
     */
    public function testMaxCardsPerPlayer()
    {
        $this->assertEquals(7, $this->object->maxCardsPerPlayer());
    }
    
    /**
     * @covers Cilex\Games\Sevens::gameName
     */
    public function testGetName()
    {
        $this->assertEquals('sevens', \Cilex\Games\Sevens::gameName());
    }
    
    /**
     * @covers Cilex\Games\Sevens::gameInformation
     */
    public function testInformation()
    {
        $this->assertStringMatchesFormat('%a', \Cilex\Games\Sevens::gameInformation());
    }
    
    /**
     * @covers Cilex\Games\Sevens::gameLogic
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Invalid player in this game!
     */
    public function testGameLogicWithABadPlayer()
    {
        $this->object->gameLogic(array('test'));
    }
    
    /**
     * @covers Cilex\Games\Sevens::gameLogic
     */
    public function testGameLogicWithNoWinner()
    {
        $this->assertNull($this->object->gameLogic(array(0=>$this->mockPlayer)));
    }
    
    /**
     * @covers Cilex\Games\Sevens::gameLogic
     */
    public function testGameLogic()
    {
        $this->assertCount(1, $this->object->gameLogic(array(0=>$this->mockPlayer)));
    }
    
    /**
     * @covers Cilex\Games\Sevens::gameRules
     */
    public function testGameRules()
    {
        $this->assertNull($this->object->gameRules());
    }
}
