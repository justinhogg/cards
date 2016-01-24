<?php
/**
 * Description of TableTest
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Tests\Players;

class TableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cilex\Players\Table
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
        $this->object = new \Cilex\Players\Table();
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
     * @covers Cilex\Players\Table::__construct
     */
    public function testConstruct()
    {
    }
    
    /**
     * @covers Cilex\Players\Table::getPlayers
     */
    public function testGetNoPlayers()
    {
        $this->assertCount(0, $this->object->getPlayers());
    }
    
    /**
     * @covers Cilex\Players\Table::getPlayers
     * @covers Cilex\Players\Table::addPlayer
     */
    public function testGetPlayers()
    {
        $mockPlayer = $this->getMock('Cilex\Players\CasualPlayer');
        $this->object->addPlayer($mockPlayer);
        $this->assertCount(1, $this->object->getPlayers());
    }
    
    /**
     * @covers Cilex\Players\Table::getPlayerCount
     */
    public function testGetPlayerCount()
    {
        $this->assertEquals(0, $this->object->getPlayerCount());
    }
    
    /**
     * @covers Cilex\Players\Table::getGame
     * @covers Cilex\Players\Table::addCardGame
     */
    public function testGetCardGame()
    {
        $mockDeck = $this->getMock('Cilex\Cards\Deck');
        $mockCardGame = $this->getMock('Cilex\Games\Sevens', null, array($mockDeck));
        $this->object->addCardGame($mockCardGame);
        
        $this->assertInstanceOf('\Cilex\Games\CardGame', $this->object->getGame());
    }
    
     /**
     * @covers Cilex\Players\Table::hasCardGame
     * @covers Cilex\Players\Table::addCardGame
     */
    public function testHasCardGame()
    {
        $mockDeck = $this->getMock('Cilex\Cards\Deck');
        $mockCardGame = $this->getMock('Cilex\Games\Sevens', null, array($mockDeck));
        $this->object->addCardGame($mockCardGame);
        
        $this->assertTrue($this->object->hasCardGame());
    }
    
     /**
     * @covers Cilex\Players\Table::hasCardGame
     * @covers Cilex\Players\Table::addCardGame
     */
    public function testHasNoCardGame()
    {
        $this->assertFalse($this->object->hasCardGame());
    }
}

