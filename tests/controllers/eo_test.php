<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */
class eo_test extends TestCase
{	
    protected $backupGlobalsBlacklist = array( '_SESSION' );

	public function setUp()
    {
        if ( !isset( $_SESSION ) ) $_SESSION = array( );
    }

    public function test_Login_eo()
	{	
		//$this->assertFalse( isset($_SESSION['eo']) );
		$this->request(
			'POST',
			'user/login',
				[
					'form-username' => 'eo',
					'form-password' => '123',
					'user' => 'EO'
				]
		);
		$this->assertEquals('eo', $_SESSION['eo']);
	}

    public function test_display_Dashboard_eo()
	{	
		//$_SESSION['eo'] = 'eo';
		$output = $this->request('GET', 'display/Dashboard_eo');
		//$this->assertEquals('eo', $_SESSION['eo']);
	}
}