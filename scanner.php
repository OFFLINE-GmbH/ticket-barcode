<!DOCTYPE html>
<html>

<head>

  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/quagga/dist/quagga.js"></script>
  <script src="script/scanner.js"></script>

</head>
<body>
<?php

  include(__DIR__ . '/vendor/autoload.php');

  use Hashids\Hashids;

  // Check if parameter hash is set
  if( isset( $_GET['hash'] ) ) {

    // Get the Hash-ID
    $hashId = $_GET['hash'];

    // Make new Hashids-instance
    $hashIdInstance = new Hashids();

    // Decode the Hash-ID
    $ticketId = $hashIdInstance->decode($hashId);

    echo 'Ticket: '. $ticketId[0];

  } else {

    // Scanner if no hash is set
    echo '<div id="scanner" style="width: 100vw; height: 100vh;"></div>';

  }

?>


</body>

</html>
