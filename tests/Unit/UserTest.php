<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Enums\Role;
use Tests\TestCase;

uses(TestCase::class);

test('a user can be created with role', function () {
    $user = User::factory()->make([
        'name' => 'Kusum Limbu',
        'email' => 'kusum@example.com',
        'password' => Hash::make('secret123'),
        'role' => Role::TEACHER,
    ]);

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->name)->toBe('Kusum Limbu')
        ->and($user->email)->toBe('kusum@example.com')
        ->and($user->role)->toBe(Role::TEACHER); 
});
