<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Contact;

class EditContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_edition_cant_be_rendered_without_being_authenticated()
    {
        $contact = Contact::factory()->create();

        $response = $this->get("/contacts/$contact->id/edit");

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_contact_edition_can_be_rendered_when_authenticated()
    {
        $user = User::factory()->create();
        $contact = Contact::factory()->create();

        $response = $this->actingAs($user)->get("/contacts/$contact->id/edit");

        $response->assertStatus(200);
    }

    public function test_user_can_edit_contact()
    {
        $user = User::factory()->create();
        $contact = Contact::factory()->create();

        $response = $this->actingAs($user)->put("/contacts/$contact->id", [
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => 'mr_john_doe@gmail.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHas('message', 'Contact updated successfully.');
    }

    public function test_user_can_see_edited_contact()
    {
        $user = User::factory()->create();
        $contact = Contact::factory()->create();

        $this->actingAs($user)->put("/contacts/$contact->id", [
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => 'mr_john_doe@gmail.com',
        ]);

        $response = $this->get("/");

        $response->assertStatus(200);
        $response->assertSeeText('Contact List');
        $response->assertSeeText('John Doe');
        $response->assertSeeText('123456789');
        $response->assertSeeText('mr_john_doe@gmail.com');
    }

    public function test_user_cant_edit_contact_with_invalid_email()
    {
        $user = User::factory()->create();
        $contact = Contact::factory()->create();

        $response = $this->actingAs($user)->from("/contacts/$contact->id/edit")->put("/contacts/$contact->id", [
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => 'johnDoe',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect("/contacts/$contact->id/edit");
        $response->assertSessionHasErrors(['email']);
    }

    public function test_user_cant_edit_contact_with_invalid_contact()
    {
        $user = User::factory()->create();
        $contact = Contact::factory()->create();

        $response = $this->actingAs($user)->from("/contacts/$contact->id/edit")->put("/contacts/$contact->id", [
            'name' => 'John Doe',
            'contact' => '1234567890',
            'email' => 'john_doe@gmail.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect("/contacts/$contact->id/edit");
        $response->assertSessionHasErrors(['contact']);
    }

    public function test_user_cant_edit_contact_with_invalid_name()
    {
        $user = User::factory()->create();
        $contact = Contact::factory()->create();

        $response = $this->actingAs($user)->from("/contacts/$contact->id/edit")->put("/contacts/$contact->id", [
            'name' => 'John',
            'contact' => '123456789',
            'email' => 'john_doe@gmail.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect("/contacts/$contact->id/edit");
        $response->assertSessionHasErrors(['name']);
    }

    public function test_user_cant_edit_contact_email_to_an_email_already_used()
    {
        $user = User::factory()->create();
        $contact = Contact::factory()->create();
        $contact2 = Contact::factory()->create();

        $response = $this->actingAs($user)->from("/contacts/$contact->id/edit")->put("/contacts/$contact->id", [
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => $contact2->email,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect("/contacts/$contact->id/edit");
        $response->assertSessionHasErrors(['email']);
    }

    public function test_user_cant_edit_contact_number_to_a_number_already_used(){
        $user = User::factory()->create();
        $contact = Contact::factory()->create();
        $contact2 = Contact::factory()->create();

        $response = $this->actingAs($user)->from("/contacts/$contact->id/edit")->put("/contacts/$contact->id", [
            'name' => 'John Doe',
            'contact' => $contact2->contact,
            'email' => 'john_doe@gmail.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect("/contacts/$contact->id/edit");
        $response->assertSessionHasErrors(['contact']);
    }

    public function test_user_can_edit_an_email_to_an_email_that_was_deleted()
    {
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

    public function test_user_can_edit_a_number_to_a_number_that_was_deleted()
    {
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
