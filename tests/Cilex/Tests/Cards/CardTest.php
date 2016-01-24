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
        switch ($this->getName()) {
            default:
                $this->object = new \Cilex\Cards\Card(1, 1);
                break;
        }
        
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
     * @covers Cilex\Cards\Card::getSuit
     * @covers Cilex\Cards\Card::getValue
     */
    public function testConstruct()
    {
        $this->assertEquals(1, $this->object->getSuit());
        $this->assertEquals(1, $this->object->getValue());
    }
    
    /**
     * Tests whether the constructor instantiates the correct dependencies.
     * @covers Cilex\Cards\Card::__construct
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Invalid card suit or value
     */
    public function testBadSuitConstruct()
    {
        new \Cilex\Cards\Card(10,1);
    }
    
    /**
     * Tests whether the constructor instantiates the correct dependencies.
     * @covers Cilex\Cards\Card::__construct
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Invalid card suit or value
     */
    public function testBadValueConstruct()
    {
        new \Cilex\Cards\Card(1,14);
    }
    
    /**
     * @covers Cilex\Cards\Card::getSuitAsString
     */
    public function testGetSuitAsString()
    {
        $this->assertEquals('hearts', $this->object->getSuitAsString());
    }
    
    /**
     * @covers Cilex\Cards\Card::getSuitAsString
     */
    public function testGetJokerAsString()
    {
        $object = new \Cilex\Cards\Card(0,1);
        
        $this->assertEquals('joker', $object->getSuitAsString());
    }
    
    /**
     * @covers Cilex\Cards\Card::getValueAsString
     */
    public function testGetAceValueAsString()
    {
        $object = new \Cilex\Cards\Card(1,1);
        
        $this->assertEquals('ace', $object->getValueAsString());
    }
    
    /**
     * @covers Cilex\Cards\Card::getValueAsString
     */
    public function testGetJackValueAsString()
    {
        $object = new \Cilex\Cards\Card(1,11);
        
        $this->assertEquals('jack', $object->getValueAsString());
    }
    
    /**
     * @covers Cilex\Cards\Card::getValueAsString
     */
    public function testGetQueenValueAsString()
    {
        $object = new \Cilex\Cards\Card(1,12);
        
        $this->assertEquals('queen', $object->getValueAsString());
    }
    
    /**
     * @covers Cilex\Cards\Card::getValueAsString
     */
    public function testGetKingValueAsString()
    {
        $object = new \Cilex\Cards\Card(1,13);
        
        $this->assertEquals('king', $object->getValueAsString());
    }
    
    /**
     * @covers Cilex\Cards\Card::getValueAsString
     */
    public function testGetValueAsString()
    {
        $object = new \Cilex\Cards\Card(1,2);
        
        $this->assertEquals('2', $object->getValueAsString());
    }
    
    /**
     * @covers Cilex\Cards\Card::view
     */
    public function testView()
    {
        $mockOutput = $this->getMockForAbstractClass('Symfony\Component\Console\Output\OutputInterface');
        
        $this->assertInstanceOf('\Symfony\Component\Console\Output\OutputInterface',  $this->object->view($mockOutput));
    }
    
}
