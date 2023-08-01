var audioBlob = null;
var audioBlob1 = null;
var noteStringAudio = '';
var noteStringAudio1 = '';
const recordAudio = () =>
    new Promise(async (resolve) => {
        const stream = await navigator.mediaDevices.getUserMedia({audio: true});
        const mediaRecorder = new MediaRecorder(stream);
        const audioChunks = [];
        mediaRecorder.addEventListener("dataavailable", (event) => {
            audioChunks.push(event.data);
        });

        const start = () => {
            if(isPlaying){
                togglePlayback()
            }
            mediaRecorder.start()
        };

        const stop = () =>
            new Promise((resolve) => {
                mediaRecorder.addEventListener("stop", () => {

                    if(recordEleIndex === 0){

                        audioBlob = new Blob(audioChunks);
                        recorder_audio_url = URL.createObjectURL(audioBlob);
                        const audio = new Audio(recorder_audio_url);
                        const play = () => audio.play();
                        const stop1 = () => audio.stop();
                        resolve({audioBlob, recorder_audio_url , stop1});
                    }else{

                        audioBlob1 = new Blob(audioChunks);
                        recorder_audio_url = URL.createObjectURL(audioBlob1);
                        const audio = new Audio(recorder_audio_url);
                        const play = () => audio.play();
                        const stop1 = () => audio.stop();

                        resolve({audioBlob1, recorder_audio_url , stop1});
                    }

                });
                mediaRecorder.stop();
            });
        resolve({start, stop});
    });

const sleep = (time) => new Promise((resolve) => setTimeout(resolve, time));

var record = true;
var recordEleIndex = 0;//top Recorder => 0

const startRecording = async () => {
    const recording = await recordAudio();
    const recorder = document.getElementById("recorder");
    const recorderDown = document.getElementById("recorderDown");
    recorder.disabled = true;
    recorderDown.disabled = true;
    recording.start();
    while (record == true) {
        await sleep(1);
    }
    const audio = await recording.stop();
    await sleep(2000);
    //audio.play();
    console.log(this)
    analyzeRecording()
    recorder.disabled = false;
    recorderDown.disabled = false;
};

document.getElementById("recorder").addEventListener("click", (e) => {
    if (document.getElementById("recorder").classList.contains("recording")) {
        document.getElementById("recorder").classList.remove("recording");
        record = false;
        setUIState(3)
    } else if (
        !document.getElementById("recorder").classList.contains("recording") &&
        !document.getElementById("recorder").classList.contains("download")
    ) {
        document.getElementById("recorder").classList.remove("out");
        document.getElementById("recorder").classList.add("recording");
        record = true;
        recordEleIndex = 0;
        startRecording();
        setUIState(2)
    }
});
document.getElementById("recorderDown").addEventListener("click", (e) => {
    if (document.getElementById("recorderDown").classList.contains("recording")) {
        document.getElementById("recorderDown").classList.remove("recording");
        record = false;
        setUIState(3,1)
    } else if (
        !document.getElementById("recorderDown").classList.contains("recording") &&
        !document.getElementById("recorderDown").classList.contains("download")
    ) {
        document.getElementById("recorderDown").classList.remove("out");
        document.getElementById("recorderDown").classList.add("recording");
        record = true;
        recordEleIndex = 1;
        startRecording();
        setUIState(2,1)
    }
});

function setUIState(state , indexOfRecorder = 0) {
    let step_start = $('.step_start')
    let step_recording = $('.step_recording')
    let step_result = $('.step_result')
    step_start.eq(indexOfRecorder).css('display' , 'none')
    step_recording.eq(indexOfRecorder).css('display' , 'none')
    step_result.eq(indexOfRecorder).css('display' , 'none')
    switch (state) {
        case 1: {
            step_start.eq(indexOfRecorder).css('display' , 'block')
            break
        }
        case 2: {
            step_recording.eq(indexOfRecorder).css('display' , 'block')
            break
        }
        case 3: {
            step_result.eq(indexOfRecorder).css('display' , 'block')
            break
        }
    }
}


window.AudioContext = window.AudioContext || window.webkitAudioContext;

var recorded_audio_array_buffer = new ArrayBuffer(0);
var audioContext = null;
var isPlaying = false;
var sourceNode = null;
var analyser = null;
var theBuffer = null;
var DEBUGCANVAS = null;
var mediaStreamSource = null;
var detectorElem,
    canvasElem,
    waveCanvas,
    pitchElem,
    noteElem,
    detuneElem,
    detuneAmount;

function analyzeRecording() {
    audioContext = new AudioContext();
    MAX_SIZE = Math.max(4, Math.floor(audioContext.sampleRate / 5000));	// corresponds to a 5kHz signal

    var request = new XMLHttpRequest();
    request.open("GET", recorder_audio_url, true);
    request.responseType = "arraybuffer";
    request.onload = function () {
        audioContext.decodeAudioData(request.response, function (buffer) {
            theBuffer = buffer;
            togglePlayback()
        });
    }
    request.send();

    if(recordEleIndex === 0){

        detectorElem = document.getElementById("detector");
        canvasElem = document.getElementById("output");
        DEBUGCANVAS = document.getElementById("waveform");
        if (DEBUGCANVAS) {
            waveCanvas = DEBUGCANVAS.getContext("2d");
            waveCanvas.strokeStyle = "black";
            waveCanvas.lineWidth = 1;
        }
        pitchElem = document.getElementById("pitch");
        noteElem = document.getElementById("note");
        detuneElem = document.getElementById("detune");
        detuneAmount = document.getElementById("detune_amt");
    }else{

        detectorElem = document.getElementById("detector1");
        canvasElem = document.getElementById("output1");
        DEBUGCANVAS = document.getElementById("waveform1");
        if (DEBUGCANVAS) {
            waveCanvas = DEBUGCANVAS.getContext("2d");
            waveCanvas.strokeStyle = "black";
            waveCanvas.lineWidth = 1;
        }
        pitchElem = document.getElementById("pitch1");
        noteElem = document.getElementById("note1");
        detuneElem = document.getElementById("detune1");
        detuneAmount = document.getElementById("detune_amt1");
    }


}

function error() {
    alert('Stream generation failed.');
}

function getUserMedia(dictionary, callback) {
    try {
        navigator.getUserMedia =
            navigator.getUserMedia ||
            navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia;
        navigator.getUserMedia(dictionary, callback, error);
    } catch (e) {
        alert('getUserMedia threw exception :' + e);
    }
}

function gotStream(stream) {
    // Create an AudioNode from the stream.
    mediaStreamSource = audioContext.createMediaStreamSource(stream);

    // Connect it to the destination.
    analyser = audioContext.createAnalyser();
    analyser.fftSize = 2048;
    mediaStreamSource.connect(analyser);
    updatePitch();
}

function toggleOscillator() {
    if (isPlaying) {
        //stop playing and return
        sourceNode.stop(0);
        sourceNode = null;
        analyser = null;
        isPlaying = false;
        if (!window.cancelAnimationFrame)
            window.cancelAnimationFrame = window.webkitCancelAnimationFrame;
        window.cancelAnimationFrame(rafID);
        return "play oscillator";
    }
    sourceNode = audioContext.createOscillator();

    analyser = audioContext.createAnalyser();
    analyser.fftSize = 2048;
    sourceNode.connect(analyser);
    analyser.connect(audioContext.destination);
    sourceNode.start(0);
    isPlaying = true;
    isLiveInput = false;
    updatePitch();

    return "stop";
}

function toggleLiveInput() {
    if (isPlaying) {
        //stop playing and return
        sourceNode.stop(0);
        sourceNode = null;
        analyser = null;
        isPlaying = false;
        if (!window.cancelAnimationFrame)
            window.cancelAnimationFrame = window.webkitCancelAnimationFrame;
        window.cancelAnimationFrame(rafID);
    }
    getUserMedia(
        {
            "audio": {
                "mandatory": {
                    "googEchoCancellation": "false",
                    "googAutoGainControl": "false",
                    "googNoiseSuppression": "false",
                    "googHighpassFilter": "false"
                },
                "optional": []
            },
        }, gotStream);
}

function togglePlayback() {
    if (isPlaying) {
        //stop playing and return
        sourceNode.stop(0);
        sourceNode = null;
        analyser = null;
        isPlaying = false;
        if (!window.cancelAnimationFrame)
            window.cancelAnimationFrame = window.webkitCancelAnimationFrame;
        window.cancelAnimationFrame(rafID);
        return "start";
    }

    sourceNode = audioContext.createBufferSource();
    sourceNode.buffer = theBuffer;
    sourceNode.loop = true;

    analyser = audioContext.createAnalyser();
    analyser.fftSize = 2048;
    sourceNode.connect(analyser);
    analyser.connect(audioContext.destination);
    sourceNode.start(0);
    isPlaying = true;
    isLiveInput = false;
    updatePitch();

    return "stop";
}

var rafID = null;
var tracks = null;
var buflen = 2048;
var buf = new Float32Array(buflen);

var noteStrings = ["C", "C#", "D", "D#", "E", "F", "F#", "G", "G#", "A", "A#", "B"];

function noteFromPitch(frequency) {
    var noteNum = 12 * (Math.log(frequency / 440) / Math.log(2));
    return Math.round(noteNum) + 69;
}

function frequencyFromNoteNumber(note) {
    return 440 * Math.pow(2, (note - 69) / 12);
}

function centsOffFromPitch(frequency, note) {
    return Math.floor(1200 * Math.log(frequency / frequencyFromNoteNumber(note)) / Math.log(2));
}


function autoCorrelate(buf, sampleRate) {
    // Implements the ACF2+ algorithm
    var SIZE = buf.length;
    var rms = 0;

    for (var i = 0; i < SIZE; i++) {
        var val = buf[i];
        rms += val * val;
    }
    rms = Math.sqrt(rms / SIZE);
    if (rms < 0.01) // not enough signal
        return -1;

    var r1 = 0, r2 = SIZE - 1, thres = 0.2;
    for (var i = 0; i < SIZE / 2; i++)
        if (Math.abs(buf[i]) < thres) {
            r1 = i;
            break;
        }
    for (var i = 1; i < SIZE / 2; i++)
        if (Math.abs(buf[SIZE - i]) < thres) {
            r2 = SIZE - i;
            break;
        }

    buf = buf.slice(r1, r2);
    SIZE = buf.length;

    var c = new Array(SIZE).fill(0);
    for (var i = 0; i < SIZE; i++)
        for (var j = 0; j < SIZE - i; j++)
            c[i] = c[i] + buf[j] * buf[j + i];

    var d = 0;
    while (c[d] > c[d + 1]) d++;
    var maxval = -1, maxpos = -1;
    for (var i = d; i < SIZE; i++) {
        if (c[i] > maxval) {
            maxval = c[i];
            maxpos = i;
        }
    }
    var T0 = maxpos;

    var x1 = c[T0 - 1], x2 = c[T0], x3 = c[T0 + 1];
    a = (x1 + x3 - 2 * x2) / 2;
    b = (x3 - x1) / 2;
    if (a) T0 = T0 - b / (2 * a);

    return sampleRate / T0;
}

function updatePitch(time) {
    var cycles = new Array;
    analyser.getFloatTimeDomainData(buf);
    var ac = autoCorrelate(buf, audioContext.sampleRate);
    // TODO: Paint confidence meter on canvasElem here.

    if (DEBUGCANVAS) {  // This draws the current waveform, useful for debugging
        waveCanvas.clearRect(0, 0, 512, 256);
        waveCanvas.strokeStyle = "#0A93F1";
        waveCanvas.beginPath();
        // waveCanvas.moveTo(0,buf[0]);
        for (var i = 1; i < 512; i++) {
            waveCanvas.lineTo(i, 128 + (buf[i] * 128));
        }
        waveCanvas.stroke();
    }

    if (ac == -1) {
        pitchElem.innerText = "0 Hz";
        noteElem.innerText = "";
        detuneAmount.innerText = "0cents";
    } else {
        pitch = ac;
        pitchElem.innerText = Math.round(pitch) + "Hz";
        var note = noteFromPitch(pitch);
        noteElem.innerHTML = noteStrings[note % 12];

        if(recordEleIndex === 0){
            noteStringAudio += `${noteStrings[note % 12]} ,`;
        }else{
            noteStringAudio1 += `${noteStrings[note % 12]} ,`;
        }


        var detune = centsOffFromPitch(pitch, note);
        if (detune == 0) {
            detuneAmount.innerHTML = "0cents";
        } else {
            if (detune < 0)
                detuneAmount.innerHTML = Math.abs(detune) + "cents ♭";
            else
                detuneAmount.innerHTML = Math.abs(detune) + "cents ♯";
        }
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = window.webkitRequestAnimationFrame;
    rafID = window.requestAnimationFrame(updatePitch);
}

function submit() {
    if (audioBlob != null && audioBlob1 != null) {
        var url = (window.URL || window.webkitURL).createObjectURL(audioBlob);
        var url1 = (window.URL || window.webkitURL).createObjectURL(audioBlob1);

        var data = new FormData();
        const csrf = document.querySelector('meta[name="csrf-token"]').content;

        data.append('file', audioBlob);
        data.append('file1', audioBlob1);
        data.append('number_1', noteStringAudio);
        data.append('number_2', noteStringAudio1);
        data.append('_token', csrf);


        $.ajax({
            type: 'POST',
            url: '/voice',
            data: data,
            processData: false,
            contentType: false
        }).done(function(data) {
            if (data.status == true) {
                $('#submit_voice_btn').text('ارسال شد')
                setTimeout(function (){
                    window.location = '/'
                }, 2000)
            }
        });




        /* console.log(audioBlob)
         const csrf = document.querySelector('meta[name="csrf-token"]').content;

     var xhr = new XMLHttpRequest;
     xhr.open("POST", '/voice', false);
         xhr.onload = function (oEvent) {
             console.log(xhr.response)
         };
         xhr.send(audioBlob);*/
    }
}
