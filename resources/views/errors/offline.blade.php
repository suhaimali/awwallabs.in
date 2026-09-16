@extends('layouts.auth')

@section('title', 'Service Offline | ' . config('app.name', 'SUHAIM SOFT LAB'))

@section('content')
<div style="width: 100%; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 40px 20px; background-color: #0f172a; text-align: center; font-family: 'Inter', sans-serif;">
    <div style="max-width: 520px; background: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 40px 32px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);">
        <div style="width: 68px; height: 68px; margin: 0 auto 20px; border-radius: 50%; background: rgba(239, 68, 68, 0.15); display: flex; align-items: center; justify-content: center;">
            <i class="fa fa-wifi-slash" style="font-size: 30px; color: #ef4444;"></i>
        </div>

        <h1 style="font-size: 26px; font-weight: 700; color: #f8fafc; margin-bottom: 8px;">Service Offline / Disconnected</h1>
        <p style="font-size: 14px; color: #94a3b8; line-height: 1.6; margin-bottom: 24px;">
            Unable to connect to the database or application service. Please verify your internet or local network connection and retry.
        </p>

        <div style="display: flex; gap: 12px; justify-content: center;">
            <button onclick="window.location.reload()" style="background: #2563eb; color: #ffffff; border: none; padding: 11px 24px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: background 0.2s;">
                <i class="fa fa-rotate-right"></i> Reconnect Now
            </button>
            <a href="{{ url('/') }}" style="background: rgba(255, 255, 255, 0.08); color: #cbd5e1; border: 1px solid #475569; padding: 11px 20px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                <i class="fa fa-home"></i> Home
            </a>
        </div>
    </div>
</div>
@endsection
