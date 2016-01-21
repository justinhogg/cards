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
        $this->object = $this->getMockForAbstractClass('Cilex\Cards\Hand', array());
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
     */
    public function testAddCard()
    {
        
    }
    
    /**
     * @covers Cilex\Cards\Hand::removeCard
     */
    public function testRemoveCard()
    {
        
    }
    
    /**
     * @covers Cilex\Cards\Hand::getCardCount
     */
    public function testGetCardCount()
    {
        
    }
    
    /**
     * @covers Cilex\Cards\Hand::getCardPosition
     */
    public function testGetCardPosition()
    {
        
    }
    
    /**
     * @covers Cilex\Cards\Hand::sortBySuit
     */
    public function testSortBySuit()
    {
        
    }
    
    /**
     * @covers Cilex\Cards\Hand::sortByValue
     */
    public function testSortByValue()
    {
        
    }
    
    /**
     * @covers Cilex\Cards\Hand::show
     */
    public function testShow()
    {
        
    }
}
