<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Jika user sudah login tapi datanya ada yang kosong
        if ($user && (!$user->whatsapp_number || !$user->address || !$user->photo_path)) {

            // Format respons API JSON
            return response()->json([
                'status' => 'error',
                'message' => 'Warning: Harap lengkapi data profil Anda (Foto, Alamat, Nomor WhatsApp) sebelum melanjutkan.',
                'action_required' => 'complete_profile'
            ], 403);
        }

        return $next($request);
    }
}
