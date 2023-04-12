<?php

namespace App\Http\Middleware;

use App\Models\Posts;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PemilikPostingan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        $post = Posts::findOrFail($request->id);

        if ($currentUser->id != $post->author) {
            return response()->json(['message' => 'Data not Found'], 404);
        }

        return $next($request);
    }
}
