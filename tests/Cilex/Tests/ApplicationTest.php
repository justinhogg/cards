<?php

/*
 * This file is part of the Cilex framework.
 *
 * (c) Mike van Riel <mike.vanriel@naenius.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cilex\Tests;

use Cilex\Application;
use Cilex\Command\GamesCommand;

/**
 * Application test cases.
 *
 * @author Mike van Riel <mike.vanriel@naenius.com>
 */
class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    const NAME    = 'Test';
    const VERSION = '1.0.1';

    /**
     * Sets up the test app.
     */
    public function setUp()
    {
        $this->app = new Application(self::NAME, self::VERSION);
    }

    /**
     * Tests whether the constructor instantiates the correct dependencies and
     * correctly sets the name on the Console's Application.
     */
    public function testConstruct()
    {
        $this->assertInstanceOf('Symfony\Component\Console\Application', $this->app['console']);

        $this->assertEquals(self::NAME, $this->app['console']->getName());
        $this->assertEquals(self::VERSION, $this->app['console']->getVersion());
    }

    public function testCustomInputOutput()
    {
        $input = $this->getMock('Symfony\Component\Console\Input\InputInterface');
        $output = $this->getMock('Symfony\Component\Console\Output\OutputInterface');

        $this->app['console'] = $this->getMock('Symfony\Component\Console\Application');
        $this->app['console']->expects($this->once())->method('run')->with($input, $output);


        $this->app->run($input, $output);

    }

    /**
     * Tests the command method to see if the command is properly set and the
     * Cilex application is added as container.
     */
    public function testCardsCommand()
    {
        $this->assertFalse($this->app['console']->has('play:cards'));

        $this->app->command(new GamesCommand());

        $this->assertTrue($this->app['console']->has('play:cards'));

        $this->assertSame($this->app, $this->app['console']->get('play:cards')->getContainer());
    }

}
