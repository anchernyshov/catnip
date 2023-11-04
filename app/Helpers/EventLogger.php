<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class EventLogger
{
    public static function add($action, $target, $target_id, $details) {
        try {
            $event = new \App\Models\Event();
            $event->action = $action;
            $event->user_id = Auth::user()->id;
            $event->target = $target;
            $event->target_id = $target_id;
            $event->details = $details;
            $event->save();
        } catch(\Exception $e) {
            abort(500);
        }
    }
}