<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Movies List')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        /* Global tone: reduce pure whites, stronger blacks */
        html, body {
            background-color: #f7f7f7;
            color: #080808;
            min-height: 100%;
        }

        /* Page background image (place your image at public/images/bg.jpg) */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image: url('/img/imageBg.jpg');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            opacity: 0.20; /* /* subtle */
            filter: saturate(0.5) contrast(0.5);
            pointer-events: none;
        }
        a { color: #0d6efd; }
        a:hover { color: #0b5ed7; }

        /* Shared styles for collapsible panels (forms, header, footer) */
        .h1-toggle {
            cursor: pointer;
            user-select: none;
            margin-bottom: 0;
            transition: opacity 0.5s ease;
        }

        .h1-toggle:hover { opacity: 0.6; }

        .collapsible-content {
            max-height: 0;
            overflow: hidden;
            padding-top: 0; 
            padding-bottom: 0;
            opacity: 0;
            transition: max-height 0.6s ease-in-out, padding 0.6s ease, opacity 0.6s ease;
            /* slightly lighter than page background but not pure white */
            background-color: #f2f2f2;
            border-radius: 0 0 5px 5px;
            border: 0px solid #dcdcdc;
        }

        .collapsible-content.show {
            max-height: 800px;
            padding: 15px;
            opacity: 1;
            border: 1px solid #e0e0e0;
            border-top: none;
        }

        /* Header / Footer specifics */
        .site-header, .site-footer {
            position: fixed;
            left: 0;
            right: 0;
            z-index: 1040;
            /* soft grey translucent to avoid stark white */
            background: rgba(247,247,247,0.95);
            backdrop-filter: blur(4px);
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }

        .site-header { top: 0; transform: translateY(-100%); transition: transform 0.35s ease; }
        .site-header.show { transform: translateY(0); }

        .site-footer { bottom: 0; transform: translateY(100%); transition: transform 0.35s ease; }
        .site-footer.show { transform: translateY(0); }

        .top-trigger, .bottom-trigger {
            position: fixed; left: 0; right: 0; height: 8px; z-index: 1050;
        }
        .top-trigger { top: 0; }
        .bottom-trigger { bottom: 0; }

        .nav-home { font-weight: 700; color: #080808; }

        main.container { padding-top: 80px; padding-bottom: 80px; position: relative; z-index: 1; }

        /* Content panels use an opaque surface so text stays readable over the background image */
        .collapsible-content, .table, .alert {
            background-clip: padding-box;
        }
    </style>
</head>

<body>

    <div class="top-trigger" id="top-trigger" aria-hidden="true"></div>
    <header class="site-header" id="site-header">
        @section('header')
            <div class="container py-2 d-flex justify-content-between align-items-center">
                <div>
                    <span class="nav-home selected">HOME</span>
                </div>
                <nav>
                    <!-- placeholder for future nav -->
                </nav>
            </div>
        @show
    </header>

    <main class="container">
        @if (session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

    <div class="bottom-trigger" id="bottom-trigger" aria-hidden="true"></div>
    <footer class="site-footer" id="site-footer">
        @section('footer')
            <div class="container py-3 text-center small text-muted">
                EST 2025 · ALL RIGHTS RESERVED · 
                <a href="https://github.com/Aniol-N" target="_blank">github.com/Aniol-N</a>
            </div>
        @show
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const topTrigger = document.getElementById('top-trigger');
            const header = document.getElementById('site-header');
            const bottomTrigger = document.getElementById('bottom-trigger');
            const footer = document.getElementById('site-footer');

            topTrigger.addEventListener('mouseenter', () => header.classList.add('show'));
            header.addEventListener('mouseleave', () => { if (!topTrigger.matches(':hover')) header.classList.remove('show'); });
            header.addEventListener('mouseenter', () => header.classList.add('show'));

            bottomTrigger.addEventListener('mouseenter', () => footer.classList.add('show'));
            footer.addEventListener('mouseleave', () => { if (!bottomTrigger.matches(':hover')) footer.classList.remove('show'); });
            footer.addEventListener('mouseenter', () => footer.classList.add('show'));

            // Reuse collapsible behaviour for h1-toggle panels inside content
            const headings = document.querySelectorAll('.h1-toggle');
            headings.forEach(heading => {
                const content = heading.nextElementSibling;
                if (content && content.classList.contains('collapsible-content')) {
                    heading.addEventListener('mouseenter', () => content.classList.add('show'));
                    heading.addEventListener('mouseleave', () => { if (!content.matches(':hover')) content.classList.remove('show'); });
                    content.addEventListener('mouseenter', function() { this.classList.add('show'); });
                    content.addEventListener('mouseleave', function() { if (!heading.matches(':hover')) this.classList.remove('show'); });
                }
            });
        });
    </script>

</body>

</html>
