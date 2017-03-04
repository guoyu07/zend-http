<?php
/**
 * @see       https://github.com/zendframework/zend-http for the canonical source repository
 * @copyright Copyright (c) 2005-2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-http/blob/master/LICENSE.md New BSD License
 */

namespace ZendTest\Http\Header;

use PHPUnit\Framework\TestCase;
use Zend\Http\Header\TE;

class TETest extends TestCase
{
    public function testTEFromStringCreatesValidTEHeader()
    {
        $tEHeader = TE::fromString('TE: xxx');
        $this->assertInstanceOf('Zend\Http\Header\HeaderInterface', $tEHeader);
        $this->assertInstanceOf('Zend\Http\Header\TE', $tEHeader);
    }

    public function testTEGetFieldNameReturnsHeaderName()
    {
        $tEHeader = new TE();
        $this->assertEquals('TE', $tEHeader->getFieldName());
    }

    public function testTEGetFieldValueReturnsProperValue()
    {
        $this->markTestIncomplete('TE needs to be completed');

        $tEHeader = new TE();
        $this->assertEquals('xxx', $tEHeader->getFieldValue());
    }

    public function testTEToStringReturnsHeaderFormattedString()
    {
        $this->markTestIncomplete('TE needs to be completed');

        $tEHeader = new TE();

        // @todo set some values, then test output
        $this->assertEmpty('TE: xxx', $tEHeader->toString());
    }

    /** Implementation specific tests here */

    /**
     * @see http://en.wikipedia.org/wiki/HTTP_response_splitting
     * @group ZF2015-04
     */
    public function testPreventsCRLFAttackViaFromString()
    {
        $this->expectException('Zend\Http\Header\Exception\InvalidArgumentException');
        $header = TE::fromString("TE: xxx\r\n\r\nevilContent");
    }

    /**
     * @see http://en.wikipedia.org/wiki/HTTP_response_splitting
     * @group ZF2015-04
     */
    public function testPreventsCRLFAttackViaConstructor()
    {
        $this->expectException('Zend\Http\Header\Exception\InvalidArgumentException');
        $header = new TE("xxx\r\n\r\nevilContent");
    }
}
