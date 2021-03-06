<?php
/**
 * Description of PlayerTest
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Tests\Players;

class PlayerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cilex\Players\Player
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
        $this->object = $this->getMockForAbstractClass('Cilex\Players\Player', array('test'));
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
     * @covers Cilex\Players\Player::setName
     * @covers Cilex\Players\Player::getName
     */
    public function testConstruct()
    {
        $this->assertEquals('test', $this->object->getName());
    }
    
    /**
     * @covers Cilex\Players\Player::getName
     */
    public function testGetDefaultName()
    {
        $mockObject = $this->getMockForAbstractClass('Cilex\Players\Player');
        $this->assertEquals('player', $mockObject->getName());
    }
    
    /**
     * @covers Cilex\Players\Player::getLosses
     */
    public function testGetLosses()
    {
        $this->assertEquals(0, $this->object->getLosses());
    }
    
    /**
     * @covers Cilex\Players\Player::setLosses
     * @covers Cilex\Players\Player::getLosses
     */
    public function testSetLosses()
    {
        $this->object->setLosses();
        
        $this->assertEquals(1, $this->object->getLosses());
    }
    
    /**
     * @covers Cilex\Players\Player::getWins
     */
    public function testGetWins()
    {
        $this->assertEquals(0, $this->object->getWins());
    }
    
    /**
     * @covers Cilex\Players\Player::setWins
     * @covers Cilex\Players\Player::getWins
     */
    public function testSetWins()
    {
        $this->object->setWins();
        
        $this->assertEquals(1, $this->object->getWins());
    }
    
}

