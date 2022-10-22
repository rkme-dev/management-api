<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function create(Request $request): void
    {
        $request->validate([
            'message' => 'required'
        ]);

        $user = Auth::user();

        \broadcast(new MessageEvent((string) $user, $request->get('message')));
    }
}
