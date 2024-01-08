<?php 
    include_once 'database.php';
    include 'header.php';

    if(isset($_GET['id'])){
        $emailofuser = $_SESSION['userinformation'][0];
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql2= "SELECT * FROM ventures WHERE id='$id';";
        $qry2 = mysqli_query($conn, $sql2);
        $theventureinfoarr = mysqli_fetch_all($qry2, MYSQLI_ASSOC);
        if($theventureinfoarr[0]['email'] == $emailofuser) {
?>
    <div class="ratingscirclegrid">
        <div></div>
        <div class="ratingsgrid">
            <div class="grid">
                <svg viewBox="0 0 64 64" class="pie center">
                    <circle class="background" r="25%" cx="50%" cy="50%"></circle>
                    <circle class="chart" r="25%" cx="50%" cy="50%" stroke-dasharray="<?php echo $theventureinfoarr[0]['innovation']*10;?> 100" transform="rotate(-90 32 32)"> </circle>
                    <text x="50%" y="50%" text-anchor="middle" dominant-baseline="middle" class="normaltext-black" font-size="size"><?php echo $theventureinfoarr[0]['innovation'];?></text>
                </svg>
                <text class="subtitle-black center">Innovation Rating</text>
            </div>
            <div class="grid">
                <svg viewBox="0 0 64 64" class="pie center">
                    <circle class="background" r="25%" cx="50%" cy="50%"></circle>
                    <circle class="chart" r="25%" cx="50%" cy="50%" stroke-dasharray="<?php echo $theventureinfoarr[0]['impact']*10;?> 100" transform="rotate(-90 32 32)"> </circle>
                    <text x="50%" y="50%" text-anchor="middle" dominant-baseline="middle" class="normaltext-black" font-size="size"><?php echo $theventureinfoarr[0]['impact'];?></text>
                </svg>
                <text class="subtitle-black center">Impact Rating</text>
            </div>
            <div class="grid">
                <svg viewBox="0 0 64 64" class="pie center">
                    <circle class="background" r="25%" cx="50%" cy="50%"></circle>
                    <circle class="chart" r="25%" cx="50%" cy="50%" stroke-dasharray="<?php echo $theventureinfoarr[0]['feasability']*10;?> 100" transform="rotate(-90 32 32)"> </circle>
                    <text x="50%" y="50%" text-anchor="middle" dominant-baseline="middle" class="normaltext-black" font-size="size"><?php echo $theventureinfoarr[0]['feasability'];?></text>
                </svg> 
                <text class="subtitle-black center">Feasability Rating</text>
            </div>
            <div class="grid">
                <svg viewBox="0 0 64 64" class="pie center">
                    <circle class="background" r="25%" cx="50%" cy="50%"></circle>
                    <circle class="chart" r="25%" cx="50%" cy="50%" stroke-dasharray="<?php echo $theventureinfoarr[0]['overall_rating']*10;?> 100" transform="rotate(-90 32 32)"> </circle>
                    <text x="50%" y="50%" text-anchor="middle" dominant-baseline="middle" class="normaltext-black" font-size="size"><?php echo $theventureinfoarr[0]['overall_rating'];?></text>
                </svg> 
                <text class="subtitle-black center">Overall Rating</text>
            </div>
        </div>
        <div></div>
    </div>
    <br><br>
    <div class="commentsgrid">
        <div></div>
        <div class="grid">
            <div class="titletext-black">Comments</div>
            <div class="normaltext-black"><?php echo $theventureinfoarr[0]['custominput']; ?></div>
        </div>
        <div></div>
    </div>

<?php 
        }
    } 

?>

