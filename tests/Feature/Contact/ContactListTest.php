<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Contact;

class ContactListTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_list_can_be_rendered_without_being_authenticated()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_contact_list_can_be_rendered_when_authenticated()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_see_contact_list()
    {
        $user = User::factory()->create();
        $first_contact = Contact::factory()->create();
        $second_contact = Contact::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertSeeText('Contact List');

        $response->assertSeeText($first_contact->name);
        $response->assertSeeText($first_contact->contact);
        $response->assertSeeText($first_contact->email);
        $response->assertSeeText($second_contact->name);
        $response->assertSeeText($second_contact->contact);
        $response->assertSeeText($second_contact->email);
        $response->assertDontSeeText('No contacts yet. Add a contact.');
    }

    public function test_user_open_contact_list_but_there_is_no_contacts()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertSeeText('Contact List');
        $response->assertSeeText('No contacts yet. Add a contact.');
        $response->assertSeeText('Add a contact');
    }


}
