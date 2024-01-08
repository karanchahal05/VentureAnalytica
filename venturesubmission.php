<?php 
    include_once 'database.php';

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    if(session_id()) {
        echo "";
    }
    else {
        session_start();
    } 

    if(isset($_SESSION['login'])) {
        if($_SESSION['login'] == true) {
            if(isset($_POST['problem'])) {
                if(isset($_POST['solution'])) {
                    $problem = mysqli_real_escape_string($conn, $_POST['problem']);
                    $solution = mysqli_real_escape_string($conn, $_POST['solution']);

                    $ch = curl_init();

                    $OPENAI_API_KEY = "API_KEY";

                    $headers = [
                        "Content-Type: application/json",
                        'Authorization: Bearer '.$OPENAI_API_KEY,
                    ];

                    $model = "ft:gpt-3.5-turbo-0613:personal::8eTewBZY";

                    $data = [
                        "model" => $model,
                        "messages" => array(
                            array(
                                "role" => "system",
                                "content" => "An assistant on the VentureAnalytica platform that helps our customers especially venture capitalists rate and analyze ventures. You analyze and provide advice on ventures from the perspective of a top tier venture capitalist."
                            ),
                            array(
                                "role" => "user",
                                "content" => "Problem:".$problem."|"."Solution:".$solution
                            )
                        )
                    ];

                    $data = json_encode($data);

                    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $response = curl_exec($ch);
                    $response = json_decode($response);

                    curl_close($ch);

                    $ch1 = curl_init();

                    $data1 = [
                        "model" => "gpt-3.5-turbo",
                        "messages" => array(
                            array(
                                "role" => "system",
                                "content" => "An assistant on the VentureAnalytica platform that helps our customers especially venture capitalists rate and analyze ventures. You analyze and provide advice on ventures from the perspective of a top tier venture capitalist."
                            ),
                            array(
                                "role" => "user",
                                "content" => "Given the following problem and solution, provide the title of the solution. If a title is not provided explicitely in the problem or solution then generate one that suites the problem and solution. Output the title only and nothing else (DO NOT WRITE 'Title: __'). Problem:".$problem."|"."Solution:".$solution
                            )
                        )
                    ];

                    $data1 = json_encode($data1);

                    curl_setopt($ch1, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
                    curl_setopt($ch1, CURLOPT_POST, 1);
                    curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch1, CURLOPT_POSTFIELDS, $data1);
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

                    $response1 = curl_exec($ch1);
                    $response1 = json_decode($response1);

                    curl_close($ch1);

                    $choices = $response->choices;
                    $messagefromAI = $choices[0]->message->content;

                    $AIinforarray = explode('|.|', $messagefromAI);
                    
                    $innovationarr = explode("=", $AIinforarray[0]);
                    $innovation = $innovationarr[1];

                    $impactarr = explode("=", $AIinforarray[1]);
                    $impact = $impactarr[1];

                    $feasabilityarr = explode("=", $AIinforarray[2]);
                    $feasability = $feasabilityarr[1];

                    $overall_ratingarr = explode("=", $AIinforarray[3]);
                    $overall_rating = $overall_ratingarr[1];

                    $custominputarr = explode("=", $AIinforarray[4]);
                    $custominput = $custominputarr[1];

                    $choices1 = $response1->choices;
                    $title1 = $choices1[0]->message->content;
                    $title = str_replace('Title:', '', $title1);

                    $email = $_SESSION['userinformation'][0];

                    if($innovation != "SPAM" and $innovation != "spam" ) {
                        $sql = "INSERT INTO ventures(email, problem, solution, title, innovation, impact, feasability, overall_rating, custominput) VALUES('$email','$problem', '$solution', '$title', '$innovation', '$impact', '$feasability', '$overall_rating', '$custominput');";
                        mysqli_query($conn, $sql);
                        echo "success";
                    } else {
                        echo "dddl";
                        $sql = "INSERT INTO spam(email, problem, solution, title) VALUES('$email','$problem', '$solution', '$title');";
                        mysqli_query($conn, $sql);
                        echo "success";
                    }
                }
            }
        }
    }
?>