@extends('layouts.auth')

@section('title', 'No Internet Connection')

@section('content')
<div style="width: 100%; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 40px 20px; background-color: #ffffff; text-align: center; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">

    <!-- No Internet Icon -->
    <svg style="width: 80px; height: 80px; color: #2563eb; margin-bottom: 20px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 0 1 7.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 0 1 1.06 0Z" />
        <line x1="3" y1="3" x2="21" y2="21" stroke="#ef4444" stroke-width="1.8" stroke-linecap="round"/>
    </svg>

    <h2 style="font-size: 22px; font-weight: 600; color: #1e293b; margin-bottom: 6px;">No Internet Connection</h2>
    <p style="color: #64748b; font-size: 14px; margin-bottom: 12px;">Check your internet connection and try again.</p>


    <button onclick="window.location.reload()" style="background-color: #2563eb; color: #ffffff; border: none; padding: 10px 28px; border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer;">
        Try again
    </button>



</div>
@endsection
