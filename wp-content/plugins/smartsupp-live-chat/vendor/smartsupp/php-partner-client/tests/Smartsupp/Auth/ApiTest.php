<?php
namespace Smartsupp\Auth;

use Exception;

class ApiTest extends \PHPUnit_Framework_TestCase
{
    public function test_constructor()
    {
        $api = new Api();
        $this->assertNotNull($api);
    }

    public function test_login()
    {
        $data = array(
            'email' => 'test5@kurzor.net',
            'password' => 'xxx'
        );

        $response = array(
            'account' => array(
                'key' => 'CHAT_KEY',
                'lang' => 'en'
            )
        );

        $http = $this->getMock('Smartsupp\Auth\Request\HttpRequest');
        $http->expects($this->any())
            ->method('execute')
            ->will($this->returnValue(json_encode($response)));

        // create class under test using $http instead of a real CurlRequest
        $api = new Api($http);
        $this->assertEquals($response, $api->login($data));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Foo is at bar!
     */
    public function test_response_error()
    {
        $data = array(
            'email' => 'test5@kurzor.net',
            'password' => 'xxx'
        );

        $http = $this->getMock('Smartsupp\Auth\Request\HttpRequest');
        $http->expects($this->any())
            ->method('execute')
            ->will($this->returnValue(false));

        $http->expects($this->any())
            ->method('getLastErrorMessage')
            ->will($this->returnValue('Foo is at bar!'));

        // create class under test using $http instead of a real CurlRequest
        $api = new Api($http);
        $api->login($data);
    }

    public function test_create()
    {
        $data = array(
            'email' => 'LOGIN_EMAIL',           // required
            'password' => 'YOUR_PASSWORD',      // optional, min length 6 characters
            'name' => 'John Doe',               // optional
            'lang' => 'en',                     // optional, lowercase; 2 characters
            'partnerKey' => 'PARTNER_API_KEY'   // optional
        );

        $response = array(
            'account' => array(
                'key' => 'CHAT_KEY',
                'lang' => 'en'
            ),
            'user' => array(
                'email' => 'LOGIN_EMAIL',
                'name' => 'John Doe',
                'password' => 'YOUR_PASSWORD'
            )
        );

        $http = $this->getMock('Smartsupp\Auth\Request\HttpRequest');
        $http->expects($this->any())
            ->method('execute')
            ->will($this->returnValue(json_encode($response)));

        // create class under test using $http instead of a real CurlRequest
        $api = new Api($http);
        $this->assertEquals($response, $api->create($data));
    }
}
