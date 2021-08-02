<?php

namespace App\Services;

use App\Models\Announcement;

class AnnouncementService
{
    public function getAnnouncements($scheduled = true)
    {
        if ($scheduled) {
            return Announcement::isActive()->where('startDate', '<', now())->where('endDate', '>', now())->get();
        }

        return Announcement::isActive()->get();
    }

    public function getUserAnnouncements($user_id)
    {
        return Announcement::where('user_id', $user_id)->get();
    }

    public function searchAnnouncements($word = null)
    {
        if (is_null($word)) {
            return collect([]);
        }

        return Announcement::isActive()->where('title', 'LIKE', "%{$word}%")
            ->orWhere('content', 'LIKE', "%{$word}%")
            ->get();
    }

    public function getAnnouncement($id)
    {
        return Announcement::find($id);
    }

    public function createAnnouncement($request = [])
    {
        $announcement = new Announcement;
        $columns      = self::columns();

        foreach ($columns as $column) {
            if (isset($request[$column])) {
                $announcement->$column = $request[$column];
            }
        }

        $announcement->user_id = $request['user_id'] ?? auth()->id();
        $announcement->save();

        return $announcement;
    }

    public function updateAnnouncement($id, $request = [])
    {
        $announcement = $this->getAnnouncement($id);
        $columns      = self::columns();

        foreach ($columns as $column) {
            if (isset($request[$column])) {
                $announcement->$column = $request[$column];
            }
        }

        $announcement->save();

        return $announcement;
    }

    public function delete($id)
    {
        $announcement = $this->getAnnouncement($id);

        return $announcement->delete();
    }

    public static function columns()
    {
        return (new Announcement)->getFillable();
    }
}