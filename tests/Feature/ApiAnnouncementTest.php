<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiAnnouncementTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function getAnnouncements()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->get('/api/announcements');

        $response->assertStatus(200);
    }

    /** @test **/
    public function createAnnouncement()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->post('/api/announcements', [
                'user_id'   => $this->user->id,
                'title'     => 'test announcement title',
                'content'   => 'test announcement content',
                'startDate' => now()->subDay(),
                'endDate'   => now()->addDays(2),
            ]);

        $response->assertJsonFragment(['title' => 'test announcement title']);
    }

    /** @test **/
    public function showAnnouncement()
    {
        $announcement = \App\Models\Announcement::factory()->create();

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->get('/api/announcements/' . $announcement->id);

        $response->assertJsonFragment(['title' => $announcement->title]);
    }

    /** @test **/
    public function updateAnnouncement()
    {
        $announcement = \App\Models\Announcement::factory()->create();

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->get('/api/announcements/' . $announcement->id);

        $response->assertJsonFragment(['title' => $announcement->title]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->patch('/api/announcements/' . $announcement->id, [
                'title' => $announcement->title . ' Updated',
            ]);

        $response->assertJsonFragment(['title' => $announcement->title . ' Updated']);
    }
}
