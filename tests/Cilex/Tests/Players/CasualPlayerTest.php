<?php
/**
 * Description of PlayerTest
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
        $this->object = $this->getMockForAbstractClass('Cilex\Players\CasualPlayer', array());
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
     */
    public function testConstruct()
    {
    }
}

