<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daily Thoughts | Welcome</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@1&family=Montserrat:wght@300;400;600&display=swap"
        rel="stylesheet">

    <style>
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

            margin: 0;

            font-family: 'Montserrat', sans-serif;

            background: linear-gradient(rgba(31, 31, 36, 0.85), rgba(31, 31, 36, 0.95)),
                url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=2070&auto=format&fit=crop');

            background-size: cover;
            background-position: center;
            background-attachment: fixed;

            height: 100vh;
        }

        /* Hero Section */

        .hero-section {

            height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            text-align: center;
        }

        /* Title */

        .hero-title {

            font-family: 'Libre Baskerville', serif;

            font-size: 3.5rem;

            color: var(--text-main);
        }

        .hero-title span {

            color: var(--accent);
        }

        /* Subtitle */

        .hero-subtitle {

            color: var(--text-soft);

            font-size: 16px;

            margin-top: 10px;
            margin-bottom: 40px;
        }

        /* Buttons */

        .btn-main {

            background: var(--accent);

            color: white;

            border: none;

            padding: 12px 35px;

            border-radius: 6px;

            font-weight: 500;

            transition: 0.3s;

            box-shadow: 0 5px 15px var(--shadow);
        }

        .btn-main:hover {

            background: #6ea3ff;

            transform: translateY(-2px);
        }

        .btn-outline-custom {

            border: 1px solid var(--border);

            color: var(--text-main);

            padding: 12px 35px;

            border-radius: 6px;

            transition: 0.3s;
        }

        .btn-outline-custom:hover {

            background: var(--card-light);

            border-color: var(--accent);

            color: var(--accent);

            transform: translateY(-2px);
        }
    </style>

</head>

<body>

    <section class="hero-section">

        <div>

            <h1 class="hero-title">
                Daily <span>Thoughts</span>
            </h1>

            <p class="hero-subtitle">
                Capture your thoughts. Share your stories. Begin your writing journey.
            </p>

            <div class="d-flex justify-content-center gap-3">

                <a href="/login">
                    <button class="btn-main">
                        Login
                    </button>
                </a>

                <a href="/register">
                    <button class="btn-main">
                        Register
                    </button>
                </a>

            </div>

        </div>

    </section>

</body>

</html>
