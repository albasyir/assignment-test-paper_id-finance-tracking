<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FinanceAccountTest extends TestCase
{
    public function test_unauthenticated_for_list()
    {
        $response = $this->getJson('/api/finance/account/');

        $response->assertStatus(401);
    }

    public function test_unauthenticated_for_delete()
    {
        $response = $this->deleteJson('/api/finance/account/1');

        $response->assertStatus(401);
    }

    public function test_unauthenticated_for_update()
    {
        $response = $this->putJson('/api/finance/account/1');

        $response->assertStatus(401);
    }

    public function test_unauthenticated_for_create()
    {
        $response = $this->postJson('/api/finance/account/', [
            'name' => 'BCA'
        ]);

        $response->assertStatus(401);
    }

    public function test_unauthenticated_for_show()
    {
        $response = $this->getJson('/api/finance/account/1');

        $response->assertStatus(401);
    }

    public function test_create_new_account()
    {
        $response = $this->postJson('/api/finance/account/', [
            'name' => 'BCA'
        ]);

        $response->assertStatus(401);
    }
}
