<?php
// chatbot.php

$API_KEY = ""; // add your Google Cloud Gemini API key here



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $userMessage = $data["message"];
   
    // Example: Respond with a message and potentially buttons with URLs or predefined responses

    // gemini starts
    
    
        $input = $userMessage ;
        
        
        $curl = curl_init();
        
        $input = " ".$input;
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key='.$API_KEY,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
              "contents": [{
                "parts":[{
                  "text": "'.$input.'"}]}]}',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        //echo $response->candidates;
        $response = json_decode($response, true);
         $candidate = $response['candidates'][0];
         
         $text = $candidate['content']['parts'][0]['text']; 
    
    // gemini ends
    
    
    $response = ["message" => "You said: " . $userMessage];

    // Simulating an external API response with buttons and an image
    $externalApiResponse = [
        "quote" => $text
    ];


   
    
    
    // Add the external API's quote and image to the response
    $response["message"] .= "\nChatbot: " . $externalApiResponse["quote"];
    if (isset($externalApiResponse["image"])) {
        $response["image"] = $externalApiResponse["image"];
    }

    // Add buttons to the response with external links or reply text
    $response["buttons"] = [];
    foreach ($externalApiResponse["buttons"] as $button) {
        if (isset($button["url"])) {
            $response["buttons"][] = ["text" => $button["text"], "url" => $button["url"]];
           
        } else if (isset($button["reply"])) {
            $response["buttons"][] = ["text" => $button["text"], "reply" => $button["reply"]];
            
        }
    }

    echo json_encode($response);
}
