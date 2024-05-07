<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use App\Models\Task;
use App\Models\User;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $user = User::factory()->create();
        $response = $this->from(route('task.store'))->post('create', [
            'title'   => 'title',
            'content'   => 'contet',
            'status'    => 'to_do',
            'file_path' => 'images/filepath.jpg',
        ]);
        $this->assertTrue(true);
    }
}