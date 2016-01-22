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
        $mockPlayer = $this->getMock('\Cilex\Players\CasualPlayer');
        $mockDeck = $this->getMock('Cilex\Cards\Deck');
        //set up mock table
        $mockTable = $this->getMock('Cilex\Players\Table', array('getPlayers'));
        $mockTable->expects($this->any())->method('getPlayers')->will($this->returnValue(array(0=>$mockPlayer)));
        
        $this->object = $this->getMock('Cilex\Games\Sevens', null, array($mockDeck, $mockTable));
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
     * @covers Cilex\Games\Sevens::getPlayers
     */
    public function testGetPlayers()
    {
        $this->assertCount(1, $this->object->getPlayers());
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
}
