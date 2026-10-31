<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $data = null;

        try {
            $raw = $request->cookie('admin_token');
            if ($raw) {
                $data = json_decode(Crypt::decryptString($raw), true);
            }
        } catch (\Throwable $e) {
            $data = null;
        }

        if (!$data || empty($data['id']) || ($data['exp'] ?? 0) < time()) {
            return redirect()->route('admin.login');
        }

        // Supaya view yang memakai session('admin_name') dll tetap jalan
        session([
            'admin_id'    => $data['id'],
            'admin_name'  => $data['name'] ?? 'Admin',
            'admin_email' => $data['email'] ?? '',
        ]);

        return $next($request);
    }
}
