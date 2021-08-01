<?php

namespace App\Http\Controllers;

use App\Services\AnnouncementService;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->get('user_id');

        if ($request->has('search')) {
            $data = (new AnnouncementService)->searchAnnouncements($request->get('search'));
        } elseif (!is_null($user_id)) {
            $data = (new AnnouncementService)->getUserAnnouncements($user_id);
        } else {
            $data = (new AnnouncementService)->getAnnouncements();
        }

        return response()->json(['data' => $data, 'items' => count($data)]);
    }

    public function store(Request $request)
    {
        $data = (new AnnouncementService)->createAnnouncement($request);

        return response()->json(compact('data'));
    }

    public function show($id)
    {
        $data = (new AnnouncementService)->getAnnouncement($id);

        return response()->json(compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = (new AnnouncementService)->updateAnnouncement($id, $request->all());

        return response()->json(compact('data'));
    }

    public function destroy($id)
    {
        $status = (new AnnouncementService)->delete($id);

        return response()->json(compact('status'));
    }
}
