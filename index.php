<?php 
    include 'header.php';
?>
        <div class="colgrid">
            <div id="addventurespage" class="grid backgrounddarkblue divclick subtitle-white">
                <div class="center">Add Ventures</div>
            </div>
            <div id="analyticspage" class="grid divclick subtitle-black">
                <div class="center">Analytics</div>
            </div>
        </div>
        <div id="businesspageload"></div>
        <script type="text/javascript">
            function dNav(num) {
                const ids = ["addventurespage", "analyticspage"];
                var elementclicked = document.getElementById(ids[num]);

                elementclicked.classList.add("subtitle-white");
                
                if (elementclicked.classList.contains("subtitle-black") == true) {
                    elementclicked.classList.remove("subtitle-black");
                    elementclicked.classList.add("subtitle-white");
                }

                if (elementclicked.classList.contains('backgrounddarkblue') == false) {
                    elementclicked.classList.add("backgrounddarkblue");
                }

                for (let i = 0; i < 2; i++) {
                    if (i != num) {
                        var element = document.getElementById(ids[i]);
                        if (element.classList.contains("backgrounddarkblue") == true) {
                            element.classList.remove("backgrounddarkblue");
                        }
                        if (element.classList.contains("subtitle-white") == true) {
                            element.classList.remove("subtitle-white");
                        }
                        if (element.classList.contains("subtitle-black") == false) {
                            element.classList.add("subtitle-black");
                        }
                    }
                }
            }
        </script>
        <script>
            $(document).ready(function(){
                $("#addventurespage").click(function() {
                    window.location.replace('index.php?page=addventures');
                });
                $("#analyticspage").click(function() {
                    window.location.replace('index.php?page=analyticspage');
                });
            });
        </script>
        <?php
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
        ?>
        <script>
            $(document).ready(function() {
                var page = <?php echo json_encode($page);?>

                if (page == 'addventures') {
                    dNav(0);
                    $("#businesspageload").load('addventures.php');
                }
                else if (page == 'analyticspage') {
                    dNav(1);
                    $("#businesspageload").load('analytics.php');
                }
                else if (page == 'spampage') {
                    dNav(1);
                    $("#businesspageload").load('spampage.php');
                }
            });
        </script>
        <?php 
            } else {
        ?>  
            <script>
                $("#businesspageload").load('addventures.php');
            </script>
        <?php  
            } 
        ?>
    </body>
</html>