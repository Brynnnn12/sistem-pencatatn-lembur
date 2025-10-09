<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// Registration routes are disabled in this application
// test('registration screen can be rendered', function () {
//     $response = $this->get('/register');

//     $response->assertStatus(200);
// });

// test('new users can register', function () {
//     $response = $this->post('/register', [
//         'nik' => 12345678,
//         'email' => 'test@example.com',
//         'password' => 'password',
//         'password_confirmation' => 'password',
//     ]);

//     $this->assertAuthenticated();
//     $response->assertRedirect(route('dashboard', absolute: false));
// });
