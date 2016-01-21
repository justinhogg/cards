<?php
/**
 * Description of CardTest
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Tests\Cards;

class CardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cilex\Cards\Card
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
        $this->object = $this->getMockForAbstractClass('Cilex\Cards\Card', array());
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
     * @covers Cilex\Cards\Card::__construct
     */
    public function testConstruct()
    {
    }
    
    /**
     * @covers Cilex\Cards\Card::setCard
     */
    public function testSetCard()
    {
        
    }
    
    /**
     * @covers Cilex\Cards\Card::getSuit
     */
    public function testGetSuit()
    {
        
    }
    
    /**
     * @covers Cilex\Cards\Card::getValue
     */
    public function testGetValue()
    {
        
    }
}
