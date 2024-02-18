<nav style="width: 100%; height: 32px; background: gray; text-align: center;padding: 4px;">
    <a href="index.php" style="color: white;">Top</a>
    <a href="../sleep/sleep.php?return_to=<?php echo urlencode($_SERVER['REQUEST_URI']) ?>"
       style="color: white;">Sleep <?php echo $_SESSION['sleep_duration'] ?></a>
</nav>
