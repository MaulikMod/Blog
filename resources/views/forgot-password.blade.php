<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>The Daily Muse | Reset Secret Key</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@1&family=Montserrat:wght@300;600&display=swap" rel="stylesheet">

<style>

:root {

    --bg-main: #1f1f24;
    --card-bg: #2a2d33;
    --card-light: #34373d;

    --text-main: #e4e6eb;
    --text-soft: #a1a5b0;

    --accent: #4f8cff;

    --border: #3a3f45;

    --shadow: rgba(0,0,0,0.35);
}

/* Background */

body {

    background: linear-gradient(rgba(31,31,36,0.85), rgba(31,31,36,0.90)),
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

    margin-bottom: 25px;
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

.input-line input:focus ~ label,
.input-line input:valid ~ label {

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

.input-line input:focus ~ .line-bar {

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

.alt-link {

    color: var(--text-soft);

    text-decoration: none;

    font-size: 13px;
}

.alt-link:hover {

    color: var(--accent);
}

</style>

</head>

<body>

<div class="writer-container">

<div class="journal-sheet">

<div class="sheet-header text-center">

<h1 class="journal-title">Lost Secret Key?</h1>

<p class="journal-subtitle">
Create a new key and continue your writing journey.
</p>

</div>

<form action="/update-password" method="POST">

@csrf

<input type="hidden" name="username" value="{{ session('username') }}">

<div class="input-line">

<input type="password" name="password" required>

<label>New Secret Key</label>

<span class="line-bar"></span>

</div>

<div class="input-line">

<input type="password" name="confirm_password" required>

<label>Confirm Secret Key</label>

<span class="line-bar"></span>

</div>

<div class="d-flex justify-content-between align-items-center mt-4">

<a href="/login" class="alt-link">
Return to Login
</a>

<button type="submit" class="btn-ink">
Restore Access
</button>

</div>

</form>

</div>

</div>

</body>
</html>