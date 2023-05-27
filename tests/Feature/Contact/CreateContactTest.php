<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Contact;

class CreateContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_creation_cant_be_rendered_without_being_authenticated()
    {
        $response = $this->get('/contacts/create');

        $response->assertStatus(302);
        $response->assertRedirect('/login');

    }

    public function test_contact_creation_can_be_rendered_when_authenticated()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/contacts/create');

        $response->assertStatus(200);
    }

    public function test_user_can_create_contact()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/contacts', [
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => 'johnDoe@gmail.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHas('message', 'Contact created successfully.');
    }

    public function test_user_can_see_created_contact()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/contacts', [
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => 'john_doe@gmail.com'
        ]);

        $response = $this->actingAs($user)->get('/');
        $response->assertSee('John Doe');
        $response->assertSee('123456789');
        $response->assertSee('john_doe@gmail.com');
    }


    public function test_user_cant_create_contact_with_invalid_email()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->from('/contacts/create')->post('/contacts', [
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => 'johnDoe',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/contacts/create');
        $response->assertSessionHasErrors(['email']);
    }

    public function test_user_cant_create_contact_with_invalid_contact()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->from('/contacts/create')->post('/contacts', [
            'name' => 'John Doe',
            'contact' => '1234567890',
            'email' => 'email@g.c',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/contacts/create');
        $response->assertSessionHasErrors(['contact']);
    }

    public function test_user_cant_create_contact_with_invalid_name()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->from('/contacts/create')->post('/contacts', [
            'name' => 'John',
            'contact' => '123456789',
            'email' => 'email@g.c',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/contacts/create');
        $response->assertSessionHasErrors(['name']);
    }

    public function test_user_cant_create_contact_with_repeating_email()
    {
        $user = User::factory()->create();
        $contact = Contact::factory()->create();

        $response = $this->actingAs($user)->from('/contacts/create')->post('/contacts', [
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => $contact->email,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/contacts/create');
        $response->assertSessionHasErrors(['email']);
    }

    public function test_user_cant_create_contact_with_repeating_contact()
    {
        $user = User::factory()->create();
        $contact = Contact::factory()->create();

        $response = $this->actingAs($user)->from('/contacts/create')->post('/contacts', [
            'name' => 'John Doe',
            'contact' => $contact->contact,
            'email' => 'john@g.c',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/contacts/create');
        $response->assertSessionHasErrors(['contact']);
    }

    public function test_user_can_create_email_that_already_exists_if_it_was_deleted(){
        $user = User::factory()->create();
        $contact = Contact::factory()->create();
        $contact2 = Contact::factory()->create();

        $contact2->delete();

        $response = $this->actingAs($user)->put("/contacts/$contact->id", [
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => $contact2->email,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHas('message', 'Contact updated successfully.');
    }

    public function test_user_can_create_number_that_already_exists_if_it_was_deleted(){
        $user = User::factory()->create();
        $contact = Contact::factory()->create();
        $contact2 = Contact::factory()->create();

        $contact2->delete();

        $response = $this->actingAs($user)->put("/contacts/$contact->id", [
            'name' => 'John Doe',
            'contact' => $contact2->contact,
            'email' => 'john_doe@gmail.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHas('message', 'Contact updated successfully.');

    }

}
