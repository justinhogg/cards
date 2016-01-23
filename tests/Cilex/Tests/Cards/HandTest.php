<?php
/**
 * Description of HandTest
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Tests\Players;

class HandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cilex\Cards\Hand
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
        $this->object = new \Cilex\Cards\Hand();
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
     * @covers Cilex\Cards\Hand::__construct
     */
    public function testConstruct()
    {
    }
    
    /**
     * @covers Cilex\Cards\Hand::addCard
     * @covers Cilex\Cards\Hand::show
     */
    public function testAddCard()
    {
        $mockCard = $this->getMock('Cilex\Cards\Card', null, array(1,1));
        
        $this->object->addCard($mockCard);
        
        $this->assertCount(1, $this->object->show());

    }
    
    /**
     * @covers Cilex\Cards\Hand::getCardCount
     */
    public function testGetCardCount()
    {
        $this->assertEquals(0, $this->object->getCardCount());
    }
    
    /**
     * @covers Cilex\Cards\Hand::sortBySuit
     */
    public function testSortBySuit()
    {
        $this->assertNull($this->object->sortBySuit());
    }
    
    /**
     * @covers Cilex\Cards\Hand::sortByValue
     */
    public function testSortByValue()
    {
        $this->assertNull($this->object->sortByValue());
    }
    
    /**
     * @covers Cilex\Cards\Hand::show
     */
    public function testShow()
    {
        $this->assertCount(0, $this->object->show());
    }
}
