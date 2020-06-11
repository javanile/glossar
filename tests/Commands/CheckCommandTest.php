<?php

namespace Javanile\Glossar\Tests\Commands;

use Javanile\Glossar\Commands\CheckCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Filesystem;

class CheckCommandTest extends TestCase
{
    public function testCheckWithFilter()
    {
        $scaffoldDirectoryName = 'tests/output/my-blog';
        $scaffoldDirectory = __DIR__.'/../'.$scaffoldDirectoryName;

        if (file_exists($scaffoldDirectory)) {
            (new Filesystem())->remove($scaffoldDirectory);
        }

        $app = new Application('Glossar');
        $app->add(new CheckCommand());

        $tester = new CommandTester($app->find('check'));

        $statusCode = $tester->execute(['--filter' => 'array']);

        $this->assertEquals($statusCode, 0);
        $this->assertDirectoryExists($scaffoldDirectory.'/app');
        $this->assertFileExists($scaffoldDirectory.'/.env.example');
        $this->assertEquals('Name 1', trim($tester->getDisplay()));
    }
}
