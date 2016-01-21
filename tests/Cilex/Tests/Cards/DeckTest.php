<?php
/**
 * Description of DeckTest
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Tests\Cards;

class DeckTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cilex\Cards\Deck
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
        $this->object = $this->getMockForAbstractClass('Cilex\Cards\Deck', array());
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
     * @covers Cilex\Cards\Deck::__construct
     */
    public function testConstruct()
    {
    }
    
    /**
     * @covers Cilex\Cards\Deck::shuffle
     */
    public function testShuffle()
    {
        
    }
    
    /**
     * @covers Cilex\Cards\Deck::cardsLeft
     */
    public function testCardsLeft()
    {
        
    }
    
    /**
     * @covers Cilex\Cards\Deck::deal
     */
    public function testDeal()
    {
        
    }
    
    /**
     * @covers Cilex\Cards\Deck::hasJokers
     */
    public function testHasJokers()
    {
        
    }
    
    /**
     * @covers Cilex\Cards\Deck::hasJokers
     */
    public function testHasNoJokers()
    {
        
    }
}
