<?php

include(__DIR__ . '/vendor/autoload.php');

use Hashids\Hashids;

class Barcode {

    /*
     * Ticket-id
     */
    protected $id;

    /*
     * Hashid
     */
    protected $hashId;

    /*
     * Declare the Hashids class
     */
    public function __construct() {
        $this->hashId = new Hashids();
    }

    /*
     * Return the id of the ticket
     * return int
     */
    public function getId() {
        return $this->id;
    }

    /*
     * Set the id of the ticket
     * @param int $id
     */
    public function setId( $id ) {
        $this->id = $id;
    }

    /*
     * Encode hash-id
     * @param int $id
     * return int
     */
    public function encodeId( $id ) {
        return $this->hashId->encode( $id );
    }

    /*
     * Decode hash-id
     * return int
     */
    public function decodeId() {
        return $this->hashId->decode( $this->hashId );
    }

}

/*
 * Check if valid ID-parameter
 */
if( isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ) {

  // Create barcode class
  $barcode = new Barcode();

  // Set the ID to the class
  $barcode->setId( intval($_GET['id']) );

  // Encode hash based on the clean ID
  $encodedId = $barcode->encodeId( $barcode->getId() );

  // Make the barcode-image instance
  $generateBarcode = new \Picqer\Barcode\BarcodeGeneratorPNG();

  // Generate and print the image based on the hash-ID
  echo '<img src="data:image/png;base64,' . base64_encode($generateBarcode->getBarcode($encodedId, $generateBarcode::TYPE_CODE_128)) . '" style="width: 150px"><br />';

  // Print the hash-encoded id
  echo '<p style="width: 150px; text-align: center; line-height: 0;">' . $encodedId . '</p>';

} else {

  // String if the ID is not given or not valid
  echo 'Ticket nicht valide oder kein Ticket ausgewählt.';

}
