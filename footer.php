    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<footer>
    
<nav class="row align-items-center navbar navbar-light bg-light" style="margin: 150px;">
        <div class="side-bar">
            <?php
                $activePage = basename($_SERVER['PHP_SELF'], ".php");
            ?>
            <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">
                <li class="nav-item" role="presentation">
                    <a href="don.php" class="nav-link rounded-5 <?php echo ($activePage == 'don') ? 'active' : ''; ?>">Don</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="campagne_de_collecte.php" class="nav-link rounded-5 <?php echo ($activePage == 'campagne') ? 'active' : ''; ?>">Campagne</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="commentaire.php" class="nav-link rounded-5 <?php echo ($activePage == 'commentaire') ? 'active' : ''; ?>">Commentaire</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="article.php" class="nav-link rounded-5 <?php echo ($activePage == 'article') ? 'active' : ''; ?>">Article</a>
                </li>
            </ul>
        </div>
    </nav>

<?php
if(isset($_GET['page'])) {
    $page = $_GET['page'];
    switch($page) {
        case 'don':
            header("Location: don.php");
            break;
        case 'campagne':
            header("Location: campagne_de_collecte.php");
            break;
        case 'commentaire':
            header("Location: commentaire.php");
            break;
        case 'article':
            header("Location: article.html");
            break;
        default:
            header("Location: don.php");
    }
    exit;
}
?>

</footer>