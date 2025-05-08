<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oracle Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <header class="bg-dark text-white py-3">
        <div class="container">
            <h1 class="text-center mb-2">Oracle Web</h1>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="/">Головна</a></li>
                            <li class="nav-item"><a class="nav-link" href="/customer">DEMO.CUSTOMER</a></li>
                            <li class="nav-item"><a class="nav-link" href="/employee">SCOTT.EMP</a></li>
                            <li class="nav-item"><a class="nav-link" href="/employee/search">Пошук працівників за
                                    відділом</a></li>
                            <li class="nav-item"><a class="nav-link" href="/mygroup">Моя група</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="py-4">
        <div class="container">
            <?php echo $content; ?>
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p class="mb-0">Oracle Web &copy; <?php echo date('Y'); ?></p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/app.js"></script>
</body>

</html>