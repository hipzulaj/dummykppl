<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */
class user_test extends TestCase
{	
    protected $backupGlobalsBlacklist = array( '_SESSION' );

	public function setUp()
    {
        if ( isset( $_SESSION ) ) $_SESSION = array( );
    }

    public function test_Login_cus()
	{
		//$this->assertFalse( isset($_SESSION['customer']) );
		$this->request(
			'POST',
			'user/login',
				[
					'form-username' => 'customer',
					'form-password' => '123',
					'user' => 'Customer'
				]
		);
		$this->assertEquals('customer', $_SESSION['customer']);
	}

    public function test_Dashboard_cus()
	{
		$output = $this->request('GET', 'display/Dashboard_cus');
		//$this->assertEquals('customer', $_SESSION['customer']);
	}

	public function test_booking()
	{
		$this->request(
			'POST',
			'customer/booking',
				[
					'user' => 'customer',
					'jenis' => 'birthday',
					'name' => 'aaa',
					'biaya' => '20000'
				]
		);
	}   
}