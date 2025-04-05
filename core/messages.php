<?php


function setMessage($type, $messages) {
    if (!is_array($messages)) {
        $messages = [$messages];
    }
    
    $_SESSION['messages'] = [
        'type' => $type,
        'texts' => $messages
    ];
}

function getMessage()
{
    if (!empty($_SESSION['messages'])) {
        $type = $_SESSION['messages']['type'];
        $texts = $_SESSION['messages']['texts']; 
        
        foreach ($texts as $text) {
            echo "<div class='container mt-4'>
                    <div class='alert alert-$type'>
                        $text  
                    </div>
                  </div>";
        }

        unset($_SESSION['messages']);
    }
}


?>
