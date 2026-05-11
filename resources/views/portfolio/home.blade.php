<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio App</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            margin: 0;
            background: linear-gradient(160deg, #f6efe5 0%, #dbe8ef 100%);
            color: #1f2937;
        }
        .container {
            max-width: 860px;
            margin: 0 auto;
            padding: 3rem 1rem;
        }
        .card {
            background: #ffffffdd;
            border: 1px solid #d1d5db;
            border-radius: 14px;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        h1 {
            margin-top: 0;
            font-size: 2rem;
        }
        .muted {
            color: #4b5563;
        }
        pre {
            white-space: pre-wrap;
            background: #111827;
            color: #f9fafb;
            padding: 0.8rem;
            border-radius: 8px;
            min-height: 5rem;
        }
    </style>
</head>
<body>
<main class="container">
    <section class="card">
        <h1>IT Development Portfolio</h1>
        <p class="muted">Eerste werkende implementatie met publieke portfolio API.</p>

        <h2>API resultaat /api/v1/portfolio</h2>
        <pre id="api-output">Laden...</pre>
    </section>
</main>

<script>
    fetch('/api/v1/portfolio')
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Kon portfolio data niet ophalen');
            }

            return response.json();
        })
        .then(function (data) {
            document.getElementById('api-output').textContent = JSON.stringify(data, null, 2);
        })
        .catch(function (error) {
            document.getElementById('api-output').textContent = error.message;
        });
</script>
</body>
</html>
