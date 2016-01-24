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
        $this->object = new \Cilex\Cards\Deck();
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
     * @covers Cilex\Cards\Deck::newDeck
     * @covers Cilex\Cards\Deck::hasJokers
     * @covers Cilex\Cards\Deck::cards
     */
    public function testConstructNoJokers()
    {
        $this->assertFalse($this->object->hasJokers());
        
        $this->assertCount(52, $this->object->cards());
    }
    
    /**
     * Tests whether the constructor instantiates the correct dependencies.
     * @covers Cilex\Cards\Deck::__construct
     * @covers Cilex\Cards\Deck::newDeck
     * @covers Cilex\Cards\Deck::hasJokers
     * @covers Cilex\Cards\Deck::cards
     */
    public function testConstructWithJokers()
    {
        $object = new \Cilex\Cards\Deck(true);
        
        $this->assertTrue($object->hasJokers());
        
        $this->assertCount(54, $object->cards());
    }
    
    /**
     * @covers Cilex\Cards\Deck::shuffle
     */
    public function testShuffle()
    {
       $this->assertTrue($this->object->shuffle());
    }
    
    /**
     * @covers Cilex\Cards\Deck::cardsLeft
     */
    public function testCardsLeft()
    {
        $this->assertEquals(52, $this->object->cardsLeft());
    }
    
    /**
     * @covers Cilex\Cards\Deck::cardsLeft
     * @covers Cilex\Cards\Deck::deal
     */
    public function testCardsLeftAfterDeal()
    {
        $this->object->deal();
        $this->assertEquals(51, $this->object->cardsLeft());
    }
    
    /**
     * @covers Cilex\Cards\Deck::cards
     */
    public function testCards()
    {
        $this->assertCount(52, $this->object->cards());
    }
    
    /**
     * @covers Cilex\Cards\Deck::deal
     */
    public function testDeal()
    {
        $this->object->deal();
        $this->assertEquals(51, $this->object->cardsLeft());
    }
    
    /**
     * @covers Cilex\Cards\Deck::deal
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage No more cards left in this deck!
     */
    public function testDealNoMoreCards()
    {
        foreach ($this->object->cards() as $card) {
            $this->object->deal();
        }
        
        $this->object->deal();
    }
    
    /**
     * @covers Cilex\Cards\Deck::view
     */
    public function testView()
    {
        $mockOutput = $this->getMockForAbstractClass('Symfony\Component\Console\Output\OutputInterface');
        
        $this->assertInstanceOf('\Symfony\Component\Console\Output\OutputInterface',  $this->object->view($mockOutput));
    }
}
