<!DOCTYPE html>
<html lang="en" data-bs-theme="light" id="htmlRoot">
<head>
    <meta charset="UTF-8">
    <title>AI Content Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body.dark-mode {
            background: #23272f;
            color: #f2f2f2;
        }
        .dark-mode .card, .dark-mode .table {
            background: #24282f;
            color: #f2f2f2;
        }
        .dark-mode .table-bordered th, .dark-mode .table-bordered td {
            border-color: #414141;
        }
        .highlight {
            background: #fff7cc;
            font-weight: bold;
        }
        .dark-mode .highlight {
            background: #433d22;
        }
        /* layouts/app.blade.php-এ <style> এর ভিতরে যোগ করুন: */
        .dark-mode .main-content-box {
            background: #23272f !important;
            color: #f2f2f2;
        }
        .main-content-box {
            background: #f6f8fa;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">AI Content Generator</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Generate</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('history') }}">History</a></li>
          </ul>
          <button id="darkModeToggle" class="btn btn-outline-light ms-3" title="Toggle Dark Mode">🌗</button>
        </div>
      </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dark mode toggle
        document.getElementById('darkModeToggle').onclick = function() {
            document.body.classList.toggle('dark-mode');
            document.getElementById('htmlRoot').setAttribute('data-bs-theme',
                document.body.classList.contains('dark-mode') ? 'dark' : 'light'
            );
            localStorage.setItem('darkMode', document.body.classList.contains('dark-mode') ? '1' : '0');
        };
        // Auto-load dark mode from localStorage
        if (localStorage.getItem('darkMode') === '1') {
            document.body.classList.add('dark-mode');
            document.getElementById('htmlRoot').setAttribute('data-bs-theme','dark');
        }
    </script>
</body>
</html>
