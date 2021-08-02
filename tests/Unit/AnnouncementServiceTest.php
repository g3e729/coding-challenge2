<?php

namespace Tests\Unit;

use App\Services\AnnouncementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnnouncementServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function getAnnouncements()
    {
        $createdActive = \App\Models\Announcement::factory(3)->create([
            'active'    => 1,
            'startDate' => now()->subDay(),
            'endDate'   => now()->addDays(rand(1, 10)),
        ]);

        \App\Models\Announcement::factory(7)->create();
        
        $active = (new AnnouncementService)->getAnnouncements();

        $this->assertTrue(count($createdActive) == count($active));
    }

    /** @test **/
    public function getUserAnnouncements()
    {
        $user = \App\Models\User::factory()->create();
        $created = \App\Models\Announcement::factory(10)->create([
            'user_id'   => $user->id,
        ]);
        
        $userAnnouncements = (new AnnouncementService)->getUserAnnouncements($user->id);

        $this->assertTrue(count($created) == count($userAnnouncements));
    }

    /** @test **/
    public function createAnnouncement()
    {
        $user = \App\Models\User::factory()->create();
        $title = 'test announcement!';

        $announcement = (new AnnouncementService)->createAnnouncement([
            'user_id'   => $user->id,
            'title'     => $title,
            'content'   => 'test announcement content!',
            'active'    => 1,
            'startDate' => now()->subDay(),
            'endDate'   => now()->addHours(5),
        ]);

        $toCheck = \App\Models\Announcement::find($announcement->id);

        $this->assertTrue($title == $toCheck->title);
    }

    /** @test **/
    public function updateAnnouncement()
    {
        $user = \App\Models\User::factory()->create();
        $title = 'test announcement!';

        $announcement = (new AnnouncementService)->createAnnouncement([
            'user_id'   => $user->id,
            'title'     => $title,
            'content'   => 'test announcement content!',
            'active'    => 1,
            'startDate' => now()->subDay(),
            'endDate'   => now()->addHours(5),
        ]);

        $title .= ' Updated';

        (new AnnouncementService)->updateAnnouncement($announcement->id, [
            'title'     => $title,
        ]);

        $toCheck = \App\Models\Announcement::find($announcement->id);

        $this->assertTrue($title == $toCheck->title);
    }

    /** @test **/
    public function deleteAnnouncement()
    {
        $user = \App\Models\User::factory()->create();
        $title = 'test announcement!';

        $announcement = (new AnnouncementService)->createAnnouncement([
            'user_id'   => $user->id,
            'title'     => $title,
            'content'   => 'test announcement content!',
            'active'    => 1,
            'startDate' => now()->subDay(),
            'endDate'   => now()->addHours(5),
        ]);

        $toCheck = \App\Models\Announcement::find($announcement->id);

        $this->assertTrue($title == $toCheck->title);

        $status = (new AnnouncementService)->delete($toCheck->id);

        $this->assertTrue($status);
    }
}
