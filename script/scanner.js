$('document').ready(function(){

  Quagga.init({
      inputStream : {
        name : "Live",
        type : "LiveStream",
        target: document.querySelector('#scanner')
      },
      decoder : {
        readers : ["code_128_reader"]
      }
    }, function(err) {
        if (err) {
            console.log(err);
            return
        }
        console.log("Initialization finished. Ready to start");
        Quagga.start();
    });


    Quagga.onDetected(function(data) {
      window.location.href = 'scanner.php?hash='+data.codeResult.code;
    });

});
