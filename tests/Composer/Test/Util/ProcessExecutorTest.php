<?php

/*
 * This file is part of Composer.
 *
 * (c) Nils Adermann <naderman@naderman.de>
 *     Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Composer\Test\Util;

use Composer\Util\ProcessExecutor;
use Composer\Test\TestCase;

class ProcessExecutorTest extends TestCase
{
    public function testExecuteCapturesOutput()
    {
        $process = new ProcessExecutor;
        $process->execute('echo foo', $output);
        $this->assertEquals("foo".PHP_EOL, $output);
    }

    public function testExecuteOutputsIfNotCaptured()
    {
        $process = new ProcessExecutor;
        ob_start();
        $process->execute('echo foo');
        $output = ob_get_clean();
        $this->assertEquals("foo".PHP_EOL, $output);
    }

    public function testSplitLines()
    {
        $process = new ProcessExecutor;
        $this->assertEquals(array(), $process->splitLines(''));
        $this->assertEquals(array(), $process->splitLines(null));
        $this->assertEquals(array('foo'), $process->splitLines('foo'));
        $this->assertEquals(array('foo', 'bar'), $process->splitLines("foo\nbar"));
        $this->assertEquals(array('foo', 'bar'), $process->splitLines("foo\r\nbar"));
        $this->assertEquals(array('foo', 'bar', ''), $process->splitLines("foo\r\nbar\n"));
    }
}
