<?php
/**
 * @see       https://github.com/zendframework/zend-http for the canonical source repository
 * @copyright Copyright (c) 2005-2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-http/blob/master/LICENSE.md New BSD License
 */

namespace ZendTest\Http\Header;

use PHPUnit\Framework\TestCase;
use Zend\Http\Header\ContentMD5;

class ContentMD5Test extends TestCase
{
    public function testContentMD5FromStringCreatesValidContentMD5Header()
    {
        $contentMD5Header = ContentMD5::fromString('Content-MD5: xxx');
        $this->assertInstanceOf('Zend\Http\Header\HeaderInterface', $contentMD5Header);
        $this->assertInstanceOf('Zend\Http\Header\ContentMD5', $contentMD5Header);
    }

    public function testContentMD5GetFieldNameReturnsHeaderName()
    {
        $contentMD5Header = new ContentMD5();
        $this->assertEquals('Content-MD5', $contentMD5Header->getFieldName());
    }

    public function testContentMD5GetFieldValueReturnsProperValue()
    {
        $this->markTestIncomplete('ContentMD5 needs to be completed');

        $contentMD5Header = new ContentMD5();
        $this->assertEquals('xxx', $contentMD5Header->getFieldValue());
    }

    public function testContentMD5ToStringReturnsHeaderFormattedString()
    {
        $this->markTestIncomplete('ContentMD5 needs to be completed');

        $contentMD5Header = new ContentMD5();

        // @todo set some values, then test output
        $this->assertEmpty('Content-MD5: xxx', $contentMD5Header->toString());
    }

    /** Implementation specific tests here */

    /**
     * @see http://en.wikipedia.org/wiki/HTTP_response_splitting
     * @group ZF2015-04
     */
    public function testPreventsCRLFAttackViaFromString()
    {
        $this->expectException('Zend\Http\Header\Exception\InvalidArgumentException');
        $header = ContentMD5::fromString("Content-MD5: xxx\r\n\r\nevilContent");
    }

    /**
     * @see http://en.wikipedia.org/wiki/HTTP_response_splitting
     * @group ZF2015-04
     */
    public function testPreventsCRLFAttackViaConstructor()
    {
        $this->expectException('Zend\Http\Header\Exception\InvalidArgumentException');
        $header = new ContentMD5("xxx\r\n\r\nevilContent");
    }
}
