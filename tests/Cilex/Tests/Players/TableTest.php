<?php
/**
 * Description of TableTest
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Tests\Players;

class TableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cilex\Players\Table
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
        $this->object = $this->getMock('Cilex\Players\Table', array());
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
     * @covers Cilex\Players\Table::__construct
     */
    public function testConstruct()
    {
    }
    
    /**
     * @covers Cilex\Players\Table::getPlayers
     */
    public function testGetPlayers()
    {
    }
    
    /**
     * @covers Cilex\Players\Table::getPlayerCount
     */
    public function testGetPlayerCount()
    {
    }
    
    /**
     * @covers Cilex\Players\Table::addPlayer
     */
    public function testAddPlayer()
    {
    }
}

