<?php 
?>
<br>
<div class="addventuresgrid">
    <div></div>
    <div>
        <div class="headingtitle-black">Venture Form</div>
        <form method="POST" class="grid gap-r-15" onsubmit="return false" enctype="multipart/form-data">
            <div class="grid">
                <div class="normal-bold-black">Problem</div>
                <textarea class="inputfield2 styleremove" placeholder="Describe the problem" name="problem" type="text" rows=8 cols=1></textarea>
            </div>
            <div class="grid">
                <div class="normal-bold-black">Solution</div>
                <textarea class="inputfield2 styleremove" placeholder="Describe the solution" name="solution" type="text" rows=8 cols=1></textarea>
            </div>
            <p id="ventureerror" class="smalltext-error highlight-g"></p>
            <button type="submit" name="submitventure" class="normaltext-white buttonstyleremove toppadding bottompadding sidetosidepadding buttondark backgrounddarkblue center">Submit</button>
        </form>
        <br>

        <script type="text/javascript">
            $(document).ready(function(){
                $("button[name='submitventure']").click(function(){
                    console.log('ddd');
                    var problem = $("textarea[name='problem']").val();
                    var solution = $("textarea[name='solution']").val();

                    var formdata = new FormData();
                    formdata.append('problem', problem);
                    formdata.append('solution', solution);
                    console.log('dd');
                    $.ajax({
                        url: 'venturesubmission.php',
                        dataType: 'text',
                        cache: false,
                        contentType:false,
                        processData: false,
                        data: formdata,
                        type: 'post',
                        success: function(response) {
                            console.log('d');
                            console.log(response);
                            if(response == "success") {
                                $("#ventureerror").html("Submitted the solution and problem.");
                            }
                        }
                    });
                })
            });
        </script>
    </div>
    <div></div>
</div>

<?php 
?>