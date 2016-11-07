<?php

namespace SocialEngineers\Tests\SOAP\Parser;

use SocialEngineers\SOAP\Parser\Request;
use SocialEngineers\Tests\TestHelper;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    const EXPECTED_FUNCTION = "searchContactFromParameters";
    const EXPECTED_PARAMS = [
        "username"          => "support",
        "password"          => "TEST_PASSWORD",
        "contact_type"      => "individual",
        "first_name"        => "dejan",
        "last_name"         => "lukic",
        "contact_number"    => "",
        "contact_email"     => "",
        "birth_date"        => "",
        "feedback_id"       => "",
        "organisation_name" => "",
        "abn"               => "",
        "address1"          => "13 test st",
        "address2"          => "",
        "suburb"            => "Harris Park",
        "postcode"          => "2150",
        "state_short_name"  => "NSW",
        "country"           => "Australia",
        "limit"             => "10",
        "offset"            => "0"
    ];

    private static $test_soap_xml;

    /* @var Request $test_soap_request */
    private static $test_soap_request;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $xml_file_path = TestHelper::getResourcePath("test_soap_request.xml");

        self::$test_soap_xml = new \SimpleXMLElement(file_get_contents($xml_file_path));
        self::$test_soap_request = new Request(self::$test_soap_xml);
    }

    public function testCanConstruct()
    {
        $this->assertInstanceOf(\SimpleXMLElement::class, self::$test_soap_request->getRequest());
    }

    public function testGetFunction()
    {
        $this->assertSame(self::EXPECTED_FUNCTION, self::$test_soap_request->getFunction());
    }

    public function testGetParams()
    {
        $params = self::$test_soap_request->getParams();

        $this->assertSame(self::EXPECTED_PARAMS, $params);
    }

    public function testParseParams()
    {
        // This should be the same as testing the get params, expect it's the
        // static version.
        $function = self::$test_soap_xml->children('env', true)->Body->children('ns1', true);
        $params = $function->children();

        $result = Request::parseParams($params);

        $this->assertSame(self::EXPECTED_PARAMS, $result);
    }
}
