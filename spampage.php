<?php 
    if(session_id()) {
        echo "";
    }
    else {
        session_start();
    } 
    
    include_once 'database.php';
    $emailofuser= mysqli_real_escape_string($conn, $_SESSION['userinformation'][0]);
    $sql1 = "SELECT * FROM spam WHERE email='$emailofuser';";
    $qry1 = mysqli_query($conn, $sql1);
    $spamarr = mysqli_fetch_all($qry1, MYSQLI_ASSOC);
?>
<br><br>
<div class="spambuttongrid">
    <div></div>
    <div class="spambuttongrid1">
        <button name="ventures" class="normaltext-white buttonstyleremove toppadding bottompadding sidetosidepadding buttondark backgrounddarkblue">Back to Ventures</button>
        <div></div>
    </div>
    <div></div>
</div>
<div class="venturesgrid">
    <div></div>
    <div class="grid gap-r-15">
        <?php foreach ($spamarr as $spam) {?>

            <div class="venturesgapping boxshadow">
                <div></div>
                <div class="grid">
                    <br>
                    <div class="grid">
                        <a href=<?php echo "spampage11.php?id=".$spam['id'];?> class="toppadding bottompaddin normaltext-black linkstyleremove divclick linkcolor"><?php if (strlen($spam['title'])>35) {echo substr($spam['title'], 0, 35)."...";} else {echo$spam['title'];};?> </a>
                    </div>
                    <br>
                </div>
                <div></div>
            </div>

        <?php } ?>
    </div>
    <div></div>
</div>

<script>
    $(document).ready(function() {
        $("button[name='ventures']").click(function(){
            window.location.replace('index.php?page=analyticspage')
        })
    });
</script>