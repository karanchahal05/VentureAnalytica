<?php 
    include_once 'database.php';
    include 'header.php';

    if(isset($_GET['id'])){
        $emailofuser = $_SESSION['userinformation'][0];
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql2= "SELECT * FROM spam WHERE id='$id';";
        $qry2 = mysqli_query($conn, $sql2);
        $thespaminfoarr = mysqli_fetch_all($qry2, MYSQLI_ASSOC);
        if($thespaminfoarr[0]['email'] == $emailofuser) {
?>
    <div class="commentsgrid">
        <div></div>
        <div class="grid">
            <br><br>
            <div class="titletext-black">Problem</div>
            <div class="normaltext-black"><?php echo $thespaminfoarr[0]['problem']; ?></div>
            <br>
            <div class="titletext-black">Solution</div>
            <div class="normaltext-black"><?php echo $thespaminfoarr[0]['solution']; ?></div>
        </div>
        <div></div>
    </div>
    

<?php 
        }
    } 

?>
