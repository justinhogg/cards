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
        $this->object = $this->getMockForAbstractClass('Cilex\Games\Sevens', array());
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
     * @covers Cilex\Games\Game::__construct
     */
    public function testConstruct()
    {
    }
    
    /**
     * @covers Cilex\Games\Game::setPlayers
     */
    public function testSetPlayers()
    {
        
    }
    
    /**
     * @covers Cilex\Games\Game::getPlayers
     */
    public function testGetPlayers()
    {
        
    }
    
    /**
     * @covers Cilex\Games\Game::getDeck
     */
    public function testGetDeck()
    {
        
    }
    
    /**
     * @covers Cilex\Games\Game::nextMove
     */
    public function testNextMove()
    {
        
    }
    
    /**
     * @covers Cilex\Games\Game::hasFinished
     */
    public function testHasFinished()
    {
        
    }
    
    /**
     * @covers Cilex\Games\Game::setFinished
     */
    public function testSetFinished()
    {
        
    }
}
