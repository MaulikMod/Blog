<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Thoughts | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@1&family=Montserrat:wght@300;600&display=swap"
        rel="stylesheet">
</head>
<style>
    /* ── Flash Alert Messages ── */
    .alert-flash {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        margin: 18px 0 10px;
        animation: fadeSlideIn 0.35s ease;
    }

    @keyframes fadeSlideIn {
        from { opacity: 0; transform: translateY(-8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .alert-flash--error {
        background: rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.35);
        color: #fca5a5;
    }

    .alert-flash--success {
        background: rgba(34, 197, 94, 0.12);
        border: 1px solid rgba(34, 197, 94, 0.30);
        color: #86efac;
    }

    .alert-flash--info {
        background: rgba(79, 140, 255, 0.12);
        border: 1px solid rgba(79, 140, 255, 0.30);
        color: #93c5fd;
    }
    :root {
        --paper: rgba(28, 28, 28, 0.85);
        --ink: #ffffff;
        --accent: #d4af37;
        --soft: #b0b0b0;
        --border: rgba(255, 255, 255, 0.08);
        --shadow: rgba(0, 0, 0, 0.6);
    }

    :root {

        --bg-main: #1f1f24;
        --card-bg: #2a2d33;
        --card-light: #34373d;

        --text-main: #e4e6eb;
        --text-soft: #a1a5b0;

        --accent: #4f8cff;

        --border: #3a3f45;

        --shadow: rgba(0, 0, 0, 0.35);
    }

    /* Background */

    body {

        background: linear-gradient(rgba(31, 31, 36, 0.85), rgba(31, 31, 36, 0.90)),
            url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=2070&auto=format&fit=crop');

        background-size: cover;
        background-position: center;
        background-attachment: fixed;

        font-family: 'Montserrat', sans-serif;

        height: 100vh;

        display: flex;
        align-items: center;
        justify-content: center;

        margin: 0;
    }

    /* Card */

    .journal-sheet {

        background: var(--card-bg);

        width: 100%;
        max-width: 420px;

        padding: 45px 40px;

        border-radius: 10px;

        border: 1px solid var(--border);

        box-shadow: 0 15px 40px var(--shadow);

        transition: 0.3s;
    }

    .journal-sheet:hover {

        background: var(--card-light);

        transform: translateY(-3px);
    }

    /* Title */

    .journal-title {

        font-family: 'Libre Baskerville', serif;

        color: var(--text-main);

        font-size: 2.2rem;
    }

    .journal-subtitle {

        color: var(--text-soft);

        font-size: 13px;

        margin-bottom: 35px;
    }

    /* Inputs */

    .input-line {

        position: relative;

        margin-bottom: 30px;
    }

    .input-line input {

        width: 100%;

        background: transparent;

        border: none;
        border-bottom: 1px solid var(--border);

        padding: 10px 0;

        color: var(--text-main);

        font-size: 15px;

        outline: none;
    }

    .input-line label {

        position: absolute;

        left: 0;
        top: 10px;

        color: var(--text-soft);

        transition: 0.3s;
    }

    .input-line input:focus~label,
    .input-line input:valid~label {

        top: -14px;

        font-size: 11px;

        color: var(--accent);
    }

    .line-bar {

        position: absolute;

        bottom: 0;

        left: 0;

        width: 0;

        height: 2px;

        background: var(--accent);

        transition: 0.3s;
    }

    .input-line input:focus~.line-bar {

        width: 100%;
    }

    /* Button */

    .btn-ink {

        background: var(--accent);

        color: white;

        border: none;

        padding: 10px 25px;

        border-radius: 6px;

        font-size: 14px;

        transition: 0.3s;
    }

    .btn-ink:hover {

        background: #6ea3ff;

        transform: translateY(-2px);
    }

    /* Links */

    .alt-link,
    .forgot-link {

        color: var(--text-soft);

        text-decoration: none;

        font-size: 13px;
    }

    .alt-link:hover,
    .forgot-link:hover {

        color: var(--accent);
    }
</style>

<body>

    <div class="writer-container">
        <div class="journal-sheet">
            <div class="sheet-header text-center">
                <h1 class="journal-title">Dear Muse,</h1>
                <p class="journal-subtitle">Pause for a moment. What's on your mind today?</p>
            </div>

            {{-- ── Flash Messages ── --}}
            @if(session('error'))
                <div class="alert-flash alert-flash--error" role="alert" id="flash-error">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right:6px;flex-shrink:0">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert-flash alert-flash--success" role="alert" id="flash-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right:6px;flex-shrink:0">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('status'))
                <div class="alert-flash alert-flash--info" role="alert" id="flash-status">
                    {{ session('status') }}
                </div>
            @endif

            <form class="journal-form mt-4" action="/login_user" method="POST">
                @csrf
                <div class="input-line mb-5">
                    <input type="text" name="username" id="login-username" required autocomplete="username">
                    <label for="login-username">Username</label>
                    <span class="line-bar"></span>
                </div>

                <div class="input-line mb-2">
                    <input type="password" name="password" id="login-password" required autocomplete="current-password">
                    <label for="login-password">Secret Key</label>
                    <span class="line-bar"></span>
                </div>

                <div class="text-end mb-5">
                    <a href="/forgot-password" class="forgot-link">Forgotten your key?</a>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-5">
                    <a href="/register" class="alt-link">New Author?</a>
                    <button type="submit" class="btn-ink" id="login-submit-btn">Sign Entry</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
