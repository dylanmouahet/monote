<?php

namespace App\Http\Controllers;

use App\models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notifications = Notification::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('page.notification_index',
                        [
                            'title' => 'Notification',
                            'notifications' => $notifications,
                        ]
        );
    }

    public function destroy($id)
    {
        $notification = Notification::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();
        $notification->delete();

        msg_flash('Notification supprimée avec succès', "success");
        return redirect()->route('notification');
    }

    public function destroyAll()
    {
        DB::table('notifications')->delete();

        msg_flash('Notifications supprimées avec succès', "success");
        return redirect()->route('notification');
    }


}
