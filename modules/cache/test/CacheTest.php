<?php
declare(strict_types=1);

namespace test\labo86\cache;

use labo86\cache\Cache;
use labo86\exception_with_data\ExceptionWithData;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;

class CacheTest extends TestCase
{
    private vfsStreamDirectory $root;

    public function setUp(): void
    {
        $this->root = vfsStream::setup();
    }

    /**
     * @throws ExceptionWithData
     */
    public function testBasic() {
        $path = $this->root->url();
        $directory = $path . "/cache";

        $cache = new Cache($directory);
        $entry = $cache->getEntry('hola');
        $this->assertEquals($directory . '/hola', $entry->getFilename());
    }

    /**
     * @throws ExceptionWithData
     */
    public function testClearUnusedEmpty() {
        $path = $this->root->url();
        $directory = $path . "/cache";

        $cache = new Cache($directory);
        $entry = $cache->getEntry('hola');
        $this->assertEquals($directory . '/hola', $entry->getFilename());
        $cleared_entry_list = $cache->clearUnusedEntries();
        $this->assertEquals([], $cleared_entry_list);
    }

    /**
     * @throws ExceptionWithData
     */
    public function testClearUnused() {
        $path = $this->root->url();
        $directory = $path . "/cache";

        $cache = new Cache($directory);
        $entry = $cache->getEntry('hola');
        $this->assertEquals($directory . '/hola', $entry->getFilename());
        touch($entry->getFilename());
        $this->assertFileExists($entry->getFilename());
        $cleared_entry_list = $cache->clearUnusedEntries();
        $this->assertEquals([], $cleared_entry_list);
        $this->assertFileExists($entry->getFilename());
    }

    /**
     * @throws ExceptionWithData
     */
    public function testClearUnusedOutdated() {
        $path = $this->root->url();
        $directory = $path . "/cache";

        $cache = new Cache($directory);
        $entry = $cache->getEntry('hello');
        touch($entry->getFilename());
        $this->assertFileExists($entry->getFilename());

        $cache = new Cache($directory);
        $cleared_entry_list = $cache->clearUnusedEntries();
        $this->assertEquals(['hello'], $cleared_entry_list);
        $this->assertFileNotExists($entry->getFilename());
    }


    public function testCacheDirectoryFileExists() {
        $path = $this->root->url();
        $directory = $path . "/cache";

        try {
             touch($directory);

             new Cache($directory);
             $this->fail('should throw');

        } catch (ExceptionWithData $exception) {
            $this->assertEquals("cache directory is a file", $exception->getMessage());
            $this->assertEquals(["directory" => $directory], $exception->getData());
        }

    }

    public function testCacheDirectoryFailToCreate() {
        $path = $this->root->url();
        $directory = $path . "/cache/can_not_be_created";

        try {
            touch($path . '/cache');


            new Cache($directory);
            $this->fail('should throw');

        } catch (ExceptionWithData $exception) {
            $this->assertEquals("error creating cache directory", $exception->getMessage());
            $this->assertEquals(["directory" => $directory], $exception->getData());
        }

    }

}