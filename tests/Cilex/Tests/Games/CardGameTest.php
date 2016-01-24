<?php
/**
 * Description of CardGameTest
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Tests\Games;

class CardGameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cilex\Games\CardGame
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
        $mockDeck = $this->getMock('Cilex\Cards\Deck');
        
        $this->object = $this->getMockForAbstractClass('Cilex\Games\CardGame', array($mockDeck));
    }
    
    /**
     * Tears down the fixture.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
    
    /**
     * @covers Cilex\Games\CardGame::getDeck
     */
    public function testGetDeck()
    {
        $this->assertInstanceOf('Cilex\Cards\Deck', $this->object->getDeck());
    }
}

