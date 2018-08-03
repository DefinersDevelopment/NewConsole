<?php

    $html = new \DOMDocument();
 
    // set error level
    $internalErrors = libxml_use_internal_errors(true);

 if (FALSE){


    $links[]='';

    for ($x = 1; $x <= 82; $x++) {

        $page = "https://www.nflpa.com/agents/agentsearch?h=true&page=" . $x;
        echo "getting page $page\n";
    
        $html->loadHTMLFile($page);
    
        foreach ($html->getElementsByTagName('a') as $node) {

            $href =  $node->getAttribute("href");
            $text = trim(preg_replace("/[\r\n]+/", " ", $node->nodeValue));
            if (preg_match('|^\/agents\/profile|', $href) == 1){
                //echo "this is href yo $href\n";
                $links[] = $href;
            }
        }  
    }

    echo "unique profile links\n";
    $links = array_unique($links);
    
    $myfile = fopen("agent_profile_links.txt", "w") or die("Unable to open file!");

    
    foreach ($links as $link) {
        fwrite($myfile, $link . "\n");
    }

    fclose($myfile); 




$myfile = fopen("agent_profile_links.txt", "r") or die ('could not open for reading');
$outfile = fopen("agent_contact_info.txt", "w") or die ('could not open for writing');

echo "Burn the first line " . fgets($myfile);
    $count = 0;
    while(!feof($myfile)) {
        $link = fgets($myfile);
        $link = rtrim($link);

        $page = 'https://www.nflpa.com' . $link;
        echo "this is link $page\n";
        $html->loadHTMLFile($page);

        $xpath = new DOMXpath($html);

        $name = $xpath->query("//title");
        $name = trim($name[0]->nodeValue );
        $name = str_replace('NFL Players Association -', "", $name);
        $name = str_replace('Agent Profile', "", $name);
        // echo "name is\n$name\n";
        fwrite($outfile, "NAME: $name\n");


        $address = $xpath->query("//div[@id='profile-address']");
        $address = trim($address[0]->nodeValue );
        $address = preg_replace('|\s+|', " ", $address);
        // echo "address is\n$address\n";
        fwrite($outfile, "Company/Address: $address\n");
        
        $work_phone = $xpath->query("//div[@id='WorkPhone']");
        $work_phone = trim($work_phone[0]->nodeValue );
        // echo "work phone is\n$work_phone\n";
        fwrite($outfile, "Phone: $work_phone\n");

        $email = $xpath->query("//div[@id='Email']");
        $email = trim($email[0]->nodeValue );
        // echo "Email is\n$email\n";
        fwrite($outfile, "Email: $email\n");

        $profile = $xpath->query("//div[@class='profile-col']");
        $profile = trim($profile[0]->nodeValue);
        $profile = preg_replace('|\s+|', " ", $profile);
        fwrite($outfile, "Profile: $profile\n");

        $services = $xpath->query("//div[@class='profile-section-body']");
        $services = trim($services[0]->nodeValue );
        $services = preg_replace('|\s+|', " ", $services);
        // echo "services is\n$services\n";
        fwrite($outfile, "services provided: $services\n");


        // $count++;

        // if ($count > 11){ die;}

        fwrite($outfile, "=========================================\n");

        sleep(2);

    } 

} // end if we should run the first part

$myfile = fopen("agent_contact_info.txt", "r") or die ('could not open for reading');
$cur_email = '';
$num_contracts = '';
$name = '';
$emails[]='';
$emails_names[]='';

while(!feof($myfile)) {
        $line = fgets($myfile);
         if (preg_match('|^NAME:  (.*)|', $line, $matches) == 1){

            $name = $matches[1];
            // echo "$cur_email\n";
        }
        if (preg_match('|^Email: (.*)|', $line, $matches) == 1){

            $cur_email = $matches[1];
            // echo "$cur_email\n";
        }

        if (preg_match('|^Profile: Current NFL Player Contracts Negotiated (.*)|', $line, $matches) == 1){

            $num_contracts = $matches[1];
            $emails[$cur_email] = $num_contracts;
            $emails_names[$cur_email] = $name;
            // echo "$num_contracts\n";
            $cur_email = '';
            $num_contracts = '';
        }
}

arsort($emails);
$count = 1;

foreach ($emails as $key => $value) {
    echo $emails_names[$key];
    echo "  $key\n";

    $count++;

}


    // now go and and get each individual page

