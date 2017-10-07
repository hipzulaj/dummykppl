<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class display_test extends TestCase
{

	public function setUp()
    {
        $this->resetInstance();
    }

	public function test_display_index()
	{
		$output = $this->request('GET', 'display/index');
		$this->assertContains('<title>AEO</title>', $output);
	}

	public function test_display_login()
	{
		$output = $this->request('GET', 'display/login');
		$this->assertContains('<title>Login &amp; Register </title>', $output);
	}

	public function test_display_login_mimin()
	{
		$output = $this->request('GET', 'display/login_mimin');
		$this->assertContains('<title>Admin Login Form</title>', $output);
	}

	public function test_display_categorize()
	{
		$output = $this->request('GET', 'display/categorize');
		$this->assertContains('<title>AEO</title>', $output);
	}

	public function test_login()
	{
		//$this->assertFalse( isset($_SESSION['admin']) );
		$this->request(
			'POST',
			'Mimin_perih/login',
				[
					'u' => 'admin',
					'p' => '1234',
				]
		);
		$this->assertEquals('admin', $_SESSION['admin']);
	}

	public function test_display_dashboard()
	{
		$this->request('GET', 'display/Dashboard');
		//$this->assertEquals('<title>SB Admin - Start Bootstrap Template</title>', $output);
	}
	
	public function test_Logout(){
		$this->request('GET', 'Mimin_perih/logout');
        $this->request('GET', 'user/logout');
        $this->assertFalse( isset($_SESSION['admin']) );
        $this->assertFalse( isset($_SESSION['eo']) );
        $this->assertFalse( isset($_SESSION['customer']) );
    }

	public function test_register_cus()
	{	
		$this->request(
			'POST',
			'user/register',
				[
					'form-name' => 'testcus',
					'form-email' => 'testcus@gmail.com',
					'form-username' => 'testcus',
					'form-password' => '123',
					'user' => 'Customer'
				]
		);
		$output = $this->request('GET', 'display/index');
		$this->assertContains('Hi! testcus', $output);
	}

	public function test_register_eo()
	{	
		$this->request(
			'POST',
			'user/register',
				[
					'form-name' => 'testeo',
					'form-email' => 'testeo@gmail.com',
					'form-username' => 'testeo',
					'form-password' => '123',
					'user' => 'EO'
				]
		);
		$output = $this->request('GET', 'display/index');
		$this->assertContains('<title>AEO</title>', $output);
	}

	public function test_method_404()
	{
		$this->request('GET', 'welcome/method_not_exist');
		$this->assertResponseCode(404);
	}

	public function test_APPPATH()
	{
		$actual = realpath(APPPATH);
		$expected = realpath(__DIR__ . '/../..');
		$this->assertEquals(
			$expected,
			$actual,
			'Your APPPATH seems to be wrong. Check your $application_folder in tests/Bootstrap.php'
		);
	}
}
