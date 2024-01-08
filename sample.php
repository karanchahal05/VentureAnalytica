<?php 
    $ch = curl_init();

    $OPENAI_API_KEY = "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";

    $headers = [
        "Content-Type: application/json",
        'Authorization: Bearer '.$OPENAI_API_KEY,
    ];

    $model = "ft:gpt-3.5-turbo-0613:personal::8eFzogsv";

    $problem = "The fashion industry is one of the top contributors to global pollution. The mass production, distribution and disposal of clothing is not sustainable long-term, leading to the release of greenhouse gases from manufacturing, shipping and wasted clothing in landfills.";
    $solution = "The proposed solution is a garment rental service. Such a service should work closely with major clothing brands. When buying items, customers should have the option to buy or rent. This model would be like a subscription service where customers can select a set number of items each month, wear them, then return them for other items. Clothing would be professionally cleaned between customers and repaired as necessary to maximize its life cycle. When a garment is no longer suitable for rental, it can be recycled into new clothes. This solution reduces the number of garments produced, the amount of transportation needed, and the quantity of clothes going to landfills. Completely damaged or unusable textiles can be reused or recycled into new products. It also gives financial value to businesses as it transforms fashion from a single-purchase model into a subscription service, creating a continuous income stream. Its feasibility and scalability depend on factors such as location, culture, and income level. However, as digital platforms become more common for commerce, this concept could be globally implemented.";

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

    $choices = $response->choices;
    $messagedelivered = $choices[0]->message->content;
    echo $messagedelivered;

?>