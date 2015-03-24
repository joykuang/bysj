var SFX = function(loaded) {

  var buffer, _this = this;

  try {

    var context = new (window.AudioContext || window.webkitAudioContext)();

    var request = new XMLHttpRequest();
    request.open('GET', '/500/audio/pop.mp3', true);
    request.responseType = 'arraybuffer';

    // Decode asynchronously
    request.onload = function() {
      context.decodeAudioData(request.response, function(b) {
        buffer = b;
        loaded();
      }, onError);
    };

    request.send();


    this.pop = function(t) {
      var source = context.createBufferSource(); // creates a sound source

      var gain = context.createGain();
      gain.gain = 0.4;

      gain.connect(context.destination);

      source.playbackRate.value = Math.pow(Math.random(), 2)*0.9 + 0.25;
      source.connect(gain)
      // source.gain.value = 0.4;
      
      source.buffer = buffer;                    // tell the source which sound to play
      source.connect(gain);       // connect the source to the context's destination (the speakers)
      source.start(t || 0);                          // play the source now
    };


  } catch(e) {

    onError();

  }

  function onError() {

    loaded();
    
    _this.pop = function() {

    };

  }
  
};
