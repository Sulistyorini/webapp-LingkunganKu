<?php
// Ganti isi halaman pengalihan dengan layar loading yang rapi
if (isset($response) && $response->isRedirect() && $response->headers->get('Location')) {
    $tujuan = $response->headers->get('Location');
    $h = htmlspecialchars($tujuan, ENT_QUOTES, 'UTF-8');
    $j = json_encode($tujuan, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES);
    $response->headers->set('Content-Type', 'text/html; charset=UTF-8');
    $response->setContent('<!DOCTYPE html><html lang="id"><meta charset="UTF-8">'
        . '<meta name="viewport" content="width=device-width, initial-scale=1">'
        . '<meta http-equiv="refresh" content="0;url=' . $h . '"><title>Memproses...</title>'
        . '<style>@keyframes p{to{transform:rotate(360deg)}}</style>'
        . '<body style="margin:0;min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:14px;background:#F1F5FF;color:#334155;font:600 16px system-ui,sans-serif">'
        . '<div style="width:44px;height:44px;border:4px solid #C7D7FA;border-top-color:#2563EB;border-radius:50%;animation:p .8s linear infinite"></div>'
        . '<span>Memproses...</span><script>location.replace(' . $j . ');</script></body></html>');
}
