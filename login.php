<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap Navbar Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        

.footer {
  background-color: #343a40;
  color: #f8f9fa;
  padding: 2rem 0;
  text-align: center;
  position: relative;
}
.footer .container {
  max-width: 960px;
  margin: 0 auto;
}
.footer p {
  margin: 0;
}
.footer a {
  color: #17a2b8;
  text-decoration: none;
  font-weight: bold;
}
.footer a:hover {
  color: #f8f9fa;
  text-decoration: underline;
}
.footer .social-icons {
  margin: 1rem 0;
}
.footer .social-icons a {
  color: #f8f9fa;
  font-size: 1.5rem;
  margin: 0 0.5rem;
  transition: color 0.3s;
}
.footer .social-icons a:hover {
  color: #17a2b8;
}
.footer .back-to-top {
  position: absolute;
  bottom: 1rem;
  right: 1rem;
}
.footer .back-to-top a {
  color: #f8f9fa;
  background-color: #17a2b8;
  border-radius: 50%;
  padding: 0.5rem;
  font-size: 1.25rem;
  transition: background-color 0.3s;
}
.footer .back-to-top a:hover {
  background-color: #138496;
}
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand nav-link" href="#">Ayoh Cepetan Login</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pembelian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Your Company. All rights reserved.</p>
            <div class="social-icons">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin-in"></a>
            </div>
            <p>
                <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
            </p>
            <div class="back-to-top">
                <a href="#" title="Back to top" class="fas fa-chevron-up"></a>
            </div>
        </div>
    </footer>
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>