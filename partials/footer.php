<?php require 'config/database.php'; ?>

    <!--footer-->
    <footer>
        <div class="footer_socials">
            <a href="https://youtube.com" target="_blank"><i class="uil uil-youtube"></i></a>
            <a href="https://www.facebook.com" target="_blank"><i class="uil uil-facebook-f"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="uil uil-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="uil uil-instagram"></i></a>
            <a href="https://www.linkedin.com" target="_blank"><i class="uil uil-linkedin-alt"></i></a>
        </div>
        <div class="container footer_container">
            <article>
                <h4>Categories</h4>            
            </article>
            <article>
                <h4>Support</h4>
                <ul>
                    <li><a href="">Online support</a></li>
                    <li><a href="">Call numbers</a></li>
                    <li><a href="">Emails</a></li>
                    <li><a href="">Social Support</a></li>
                    <li><a href=""> Location</a></li>                                        
                </ul>
            </article>
            <article>
                <h4>Blog</h4>
                <ul>
                    <li><a href="">Safery</a></li>
                    <li><a href="">Repair</a></li>
                    <li><a href="">Popular</a></li>
                    <li><a href="">Categories</a></li>                                       
                </ul>
            </article>
            <article>
                <h4>Permalinks</h4>
                <ul>
                    <li><a href="<?= ROOT_URL?>index.php">Home</a></li>
                    <li><a href="<?= ROOT_URL?>blog.php">Blog</a></li>
                    <li><a href="<?= ROOT_URL?>about.php">About</a></li>
                    <li><a href="<?= ROOT_URL?>servises.php">Servises</a></li>
                    <li><a href="<?= ROOT_URL?>contact.php">Contact</a></li>                   
                </ul>
            </article>
        </div>
        <div class="footer_copyright">
            <small>Copyright &copy; 2024 REMA</small>
        </div>
    </footer>
    <script src="<?= ROOT_URL ?>js/main.js"></script>
</body>
</html>