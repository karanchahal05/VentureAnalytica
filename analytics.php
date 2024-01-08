<?php 
    if(session_id()) {
        echo "";
    }
    else {
        session_start();
    } 
    
    include_once 'database.php';
    $emailofuser= mysqli_real_escape_string($conn, $_SESSION['userinformation'][0]);
    $sql1 = "SELECT * FROM ventures WHERE email='$emailofuser' ORDER BY overall_rating DESC;";
    $qry1 = mysqli_query($conn, $sql1);
    $venturearr = mysqli_fetch_all($qry1, MYSQLI_ASSOC);
?>
<br><br>
<div class="spambuttongrid">
    <div></div>
    <div class="spambuttongrid1">
        <button name="spambutton" class="normaltext-white buttonstyleremove toppadding bottompadding sidetosidepadding buttondark backgrounddarkblue">Spam</button>
        <div></div>
    </div>
    <div></div>
</div>
<div class="venturesgrid">
    <div></div>
    <div class="grid gap-r-15">
        <?php foreach ($venturearr as $venture) {?>

            <div class="venturesgapping boxshadow">
                <div></div>
                <div class="grid">
                    <br>
                    <div class="ventureboxgrid">
                        <a href=<?php echo "venturepage.php?id=".$venture['id'];?> class="toppadding bottompaddin normaltext-black linkstyleremove divclick linkcolor"><?php if (strlen($venture['title'])>35) {echo substr($venture['title'], 0, 35)."...";} else {echo$venture['title'];};?> </a>
                        <div class="center normaltext"><?php echo $venture['overall_rating'];?> </div>
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
        $("button[name='spambutton']").click(function(){
            window.location.replace('index.php?page=spampage')
        })
    });
</script>
