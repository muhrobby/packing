<?php

namespace Tests\Feature\User;

use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserStoreTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(['name' => 'admin']);


        Store::create(['store_code' => 'A314' , 'store_name' =>'AZKO Mall Artha Gading']);
    }

    public function testuserCanBeSuccessfully(){
            Event::fake();

            $userData = [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'password' => '12345678',
                'password_confirmation' => '12345678',
                'nik' => Str::random(6),
                'store_code' => 'A314',
                'role' => 'admin',

            ];


            $response = $this->post(route('user.store'),$userData);

            
            $response->assertSessionHasNoErrors();
            $response->assertRedirect(route('user.create'));

            $user = User::where('email', $userData['email'])->first();

            $this->assertNotNull($user);

            $this->assertTrue($user->hasRole('admin'));

    }
}
