<?php
/**
 * @see       https://github.com/zendframework/zend-http for the canonical source repository
 * @copyright Copyright (c) 2005-2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-http/blob/master/LICENSE.md New BSD License
 */

namespace ZendTest\Http\Header;

use PHPUnit\Framework\TestCase;
use Zend\Http\Header\WWWAuthenticate;

class WWWAuthenticateTest extends TestCase
{
    public function testWWWAuthenticateFromStringCreatesValidWWWAuthenticateHeader()
    {
        $wWWAuthenticateHeader = WWWAuthenticate::fromString('WWW-Authenticate: xxx');
        $this->assertInstanceOf('Zend\Http\Header\HeaderInterface', $wWWAuthenticateHeader);
        $this->assertInstanceOf('Zend\Http\Header\WWWAuthenticate', $wWWAuthenticateHeader);
    }

    public function testWWWAuthenticateGetFieldNameReturnsHeaderName()
    {
        $wWWAuthenticateHeader = new WWWAuthenticate();
        $this->assertEquals('WWW-Authenticate', $wWWAuthenticateHeader->getFieldName());
    }

    public function testWWWAuthenticateGetFieldValueReturnsProperValue()
    {
        $this->markTestIncomplete('WWWAuthenticate needs to be completed');

        $wWWAuthenticateHeader = new WWWAuthenticate();
        $this->assertEquals('xxx', $wWWAuthenticateHeader->getFieldValue());
    }

    public function testWWWAuthenticateToStringReturnsHeaderFormattedString()
    {
        $this->markTestIncomplete('WWWAuthenticate needs to be completed');

        $wWWAuthenticateHeader = new WWWAuthenticate();

        // @todo set some values, then test output
        $this->assertEmpty('WWW-Authenticate: xxx', $wWWAuthenticateHeader->toString());
    }

    /** Implementation specific tests here */

    /**
     * @see http://en.wikipedia.org/wiki/HTTP_response_splitting
     * @group ZF2015-04
     */
    public function testPreventsCRLFAttackViaFromString()
    {
        $this->expectException('Zend\Http\Header\Exception\InvalidArgumentException');
        $header = WWWAuthenticate::fromString("WWW-Authenticate: xxx\r\n\r\nevilContent");
    }

    /**
     * @see http://en.wikipedia.org/wiki/HTTP_response_splitting
     * @group ZF2015-04
     */
    public function testPreventsCRLFAttackViaConstructor()
    {
        $this->expectException('Zend\Http\Header\Exception\InvalidArgumentException');
        $header = new WWWAuthenticate("xxx\r\n\r\nevilContent");
    }
}
