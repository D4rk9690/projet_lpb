<?php
    include_once './header.php'
?>
<section class="house-section">
    <div class="house-container">
        <!-- House cards will be dynamically generated by the PHP code -->
        <?php include '../includes/display_houses.php'; ?>
    </div>
    <div id="calendar"></div>
</section>
    
<?php
    include_once './footer.php'
?>
    <script>
        // JavaScript code to handle the button click event
        document.addEventListener('DOMContentLoaded', function() {
            var showDescriptionButtons = document.getElementsByClassName('btn-show-description');
            for (var i = 0; i < showDescriptionButtons.length; i++) {
                showDescriptionButtons[i].addEventListener('click', function() {
                    var container = this.parentNode;
                    var descriptionBox = container.getElementsByClassName('description-box')[0];

                    // Toggle visibility of the description box
                    if (descriptionBox.style.display === 'none') {
                        descriptionBox.style.display = 'block';
                    } else {
                        descriptionBox.style.display = 'none';
                    }
                });
            }
        });
    </script>
    <script src="../script.js"></script>
</body>
</html>