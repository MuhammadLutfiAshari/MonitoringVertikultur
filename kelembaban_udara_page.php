<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Vertikultur Finance Dashboard Page" />
    <meta name="keywords" content="HTML, CSS, JavaScript, Bootstrap, Chart JS" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Rachma | @rachmadzii" />

    <title>Monitor - Vertikultur</title>

    <script type="text/javascript" src="assets/js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="jquery-latest.js"></script>

    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />

    <!-- External CSS -->
    <link rel="stylesheet" href="assets/css/styles.css" type="text/css" media="screen" />

    <!-- CDN Fontawesome -->
    <script src="https://kit.fontawesome.com/32f82e1dca.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <!-- Nav Sidebar -->
    <nav class="sidebar offcanvas-md offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false">
        <div class="d-flex justify-content-end m-3 d-block d-md-none">
            <button aria-label="Close" data-bs-dismiss="offcanvas" data-bs-target=".sidebar" class="btn p-0 border-0 fs-4">
                <i class="fas fa-close"></i>
            </button>
        </div>
        <div class="d-flex justify-content-center mt-md-5 mb-5">
            <img src="assets/images/logo.svg" alt="Logo" width="140px" height="40px" />
        </div>
        <div class="pt-2 d-flex flex-column gap-5">
            <div class="menu p-0">
                <p>Daily Use</p>
                <a href="index.php" class="item-menu">
                    <i class="icon ic-stats"></i>
                    Overview
                </a>
                <a href="suhu_page.php" class="item-menu">
                    <i class="icon ic-trans"></i>
                    Suhu
                </a>
                <a href="#" class="item-menu active">
                    <i class="icon ic-msg"></i>
                    Kelembaban udara
                </a>
                <a href="kelembaban_tanah_page.php" class="item-menu">
                    <i class="icon ic-fill"></i>
                    Kelembaban tanah
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="content">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div>
                    <button class="sidebarCollapseDefault btn p-0 border-0 d-none d-md-block" aria-label="Hamburger Button">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <button data-bs-toggle="offcanvas" data-bs-target=".sidebar" aria-controls="sidebar" aria-label="Hamburger Button" class="sidebarCollapseMobile btn p-0 border-0 d-block d-md-none">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
                <div class="d-flex align-items-center justify-content-end gap-4">
                    <input type="text" placeholder="Search report .." class="search form-control" />
                    <button class="btn btn-search d-flex justify-content-center align-items-center p-0" type="button">
                        <img src="assets/images/ic_search.svg" width="20px" height="20px" />
                    </button>
                    <img src="assets/images/avatar.jpg" alt="Photo Profile" class="avatar" />
                </div>
            </div>
        </nav>
        <section class="p-3">
            <header>
                <h3>Overview</h3>
                <p>Manage data for monitor vertikultur</p>
            </header>
            <div class="information d-flex flex-column gap-5">
                <div class="row px-1 d-flex justify-content-between">
                    <div class="d-flex align-items-center justify-content-end gap-4 mb-4">
                        <input type="date" placeholder="Search report .." class="search form-control" />
                    </div>

                    <?php include 'kelembaban_udara.php' ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="assets/js/donut_chart.js"></script>
    <!-- <script src="assets/js/line_chart.js"></script> -->
    <!-- <script src="assets/js/line_chart2.js"></script> -->

    <script>
        $(document).ready(function() {
            $('.sidebarCollapseDefault').on('click', function() {
                $('.sidebar').toggleClass('active');
                $('.content').toggleClass('active');
            });
        });
    </script>
</body>

</html>