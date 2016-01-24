<?php
/**
 * Description of CasualPlayerTest
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Tests\Players;

class CasualPlayerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cilex\Players\CasualPlayer
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
        $this->object = new \Cilex\Players\CasualPlayer();
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
     * @covers Cilex\Players\CasualPlayer::__construct
     * @covers Cilex\Players\Player::__construct
     */
    public function testConstruct()
    {
    }
    
    /**
     * @covers Cilex\Players\CasualPlayer::getHand
     */
    public function testGetNoHandSet() 
    {
        $this->assertNull($this->object->getHand());
    }
    
    /**
     * @covers Cilex\Players\CasualPlayer::getHand
     * @covers Cilex\Players\CasualPlayer::newHand
     */
    public function testGetHand() 
    {
        $mockHand = $mockHand = $this->getMock('Cilex\Cards\Hand', array());
        $this->object->newHand($mockHand);
        
        $this->assertInstanceOf('Cilex\Cards\Hand', $this->object->getHand());
        
    }
}

