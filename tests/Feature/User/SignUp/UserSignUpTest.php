<?php

namespace Tests\Feature\User\SignUp;

use App\Models\User;
use Database\Seeders\UserTableSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserSignUpTest extends TestCase
{
    // use DatabaseMigrations;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_see_sign_up_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_introducer_link_works_properly()
    {
        $server = $this->prepareCookiesForRequest();

        // $this->call('GET', '/?introducer_id=1', ["test" => "test"]);
        // $response = $this->call('GET', '/1/', '1');
        // $response->asser
        // $this->get(route('user.singUp.show', '1'));
        // $this->visit('/', 1);
        // $this->get(route('user.singUp.show', ['introducer_id' => 1, 'hello' => 'hi']) . '?pay_type=payment_gateway');
    }

    
    public function test_user_can_sign_up_filling_all_the_fields()
    {
        Storage::fake('local');
        $this->seed(UserTableSeeder::class);
        $response = $this->post(route('user.singUp.store'), [
            'name' => 'محمد امین مشایخان',
            'email' => 'mashayekhan@gmail.com',
            'phone_number' => '09156145546',
            'user_image' => UploadedFile::fake()->image('fakeImage.jpg'),
            'age' => 25,
            'introducer_id' => 1,
            'password' => 'Mm-6571',
        ]);
        $response->assertRedirect(route('user.singUp.show'));
        $this->assertEquals(User::count(), 2);
    }

    
    public function test_user_can_sign_up_filling_only_the_required_fields()
    {
        Storage::fake('local');
        $response = $this->post(route('user.singUp.store'), [
            'name' => 'محمد امین مشایخان',
            'email' => 'mashayekhan.mohammadamin@gmail.com',
            'phone_number' => '09156145545',
            'password' => bcrypt('Mm-6571'),
        ]);
        $response->assertRedirect(route('user.singUp.show'));
        $this->assertEquals(User::count(), 1);
    }
}
