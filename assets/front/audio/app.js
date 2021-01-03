//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; //stream from getUserMedia()
var rec; //Recorder.js object
var input; //MediaStreamAudioSourceNode we'll be recording

// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record

var recordButton = document.getElementById("recordButton");
var stopButton = document.getElementById("stopButton");
var pauseButton = document.getElementById("pauseButton");



//Get URL function
// var url = $(location).attr('href'),
//     parts = url.split("/"),
//     last_part = parts[parts.length-2];
// alert(last_part);

document.getElementById('pauseButton').title = 'Pause';
document.getElementById('stopButton').title = 'Stop';
//add events to those 2 buttons
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);
pauseButton.addEventListener("click", pauseRecording);

function startRecording() {
	console.log("recordButton clicked");
	$('.show_record #controls #stopButton').show();
	$('.show_record #controls #pauseButton').show();
	var pay_customer_id = $('#pay_customer_id').val();
	$('#qus_status').val('3');
	if (pay_customer_id == '') {
		$('#add_card_details').modal('toggle');
		$('#add_card_details').modal('show');
		return false;
		//add_card_details();
	}

	/*
		Simple constraints object, for more advanced audio features see
		https://addpipe.com/blog/audio-constraints-getusermedia/
	*/
	// $('#stopButton').css('color','#2fc659');
	$('.show_record #controls #stopButton').removeClass('red');
	$('.status_record').css('color','green');
	$('.status_record').html('');
	$('.mic_icon').css('background-color','#d21224');
	$('.status_record1').css('display','none');

	var constraints = {
		audio: true,
		video: false
	}

	/*
    	Disable the record button until we get a success or fail from getUserMedia() 
	*/

	recordButton.disabled = true;
	stopButton.disabled = false;
	pauseButton.disabled = false

	/*
    	We're using the standard promise based getUserMedia() 
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/
	$('#recordingsList li').remove();
	navigator.mediaDevices.getUserMedia(constraints).then(function (stream) {
		console.log("getUserMedia() success, stream created, initializing Recorder.js ...");
		$('.edqc_note p').innerHTML = 'Your audio recording is start!';

		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();

		//update the format 
		//document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"

		/*  assign to gumStream for later use  */
		gumStream = stream;

		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);

		/* 
			Create the Recorder object and configure to record mono sound (1 channel)
			Recording 2 channels  will double the file size
		*/
		rec = new Recorder(input, {
			numChannels: 1
		})

		//start the recording process
		rec.record()

		console.log("Recording started");

	}).catch(function (err) {
		//enable the record button if getUserMedia() fails
		recordButton.disabled = false;
		stopButton.disabled = true;
		pauseButton.disabled = true
	});
}

function pauseRecording() {
	console.log("pauseButton clicked rec.recording=", rec.recording);
	
	if (rec.recording) {
		//pause
		rec.stop();
		$('.status_record').css('color','red');
		$('.status_record').html('Recording Paused');
		$('.status_record1').css('display','block');
		$('.status_record1').css('color','green');
		$('.status_record1').html('Resume Recording');

		$('.show_record #controls #stopButton').addClass('red');
		$('.show_record #controls #stopButton').hide();
		pauseButton.innerHTML = '<div class="play-circle"></div>';
		

	} else {
		//resume
		rec.record();
		$('.status_record').css('color','green');
		$('.status_record').html('Start Recording');
		$('.status_record1').css('display','none');
		$('.show_record #controls #stopButton').removeClass('red');
		$('.show_record #controls #stopButton').show();
		pauseButton.innerHTML = '<i class="fa fa-pause-circle" aria-hidden="true"></i>';
	}
}

function stopRecording() {
	console.log("stopButton clicked");
	$('.status_record').css('color','blue');
	$('.status_record').html('Recording Completed');
	$('.mic_icon').css('background-color','#203569');
	$('.status_record1').css('display','none');
	//disable the stop button, enable the record too allow for new recordings
	stopButton.disabled = true;
	recordButton.disabled = false;
	pauseButton.disabled = true;

	//reset button just in case the recording is stopped while paused
	pauseButton.innerHTML = '<i class="fa fa-pause-circle" aria-hidden="true"></i>';

	//tell the recorder to stop the recording
	rec.stop();
	$('.show_record #controls #stopButton').hide();
	$('.show_record #controls #pauseButton').hide();
	//stop microphone access
	gumStream.getAudioTracks()[0].stop();

	//create the wav blob and pass it on to createDownloadLink
	rec.exportWAV(createDownloadLink);
}

function createDownloadLink(blob) {

	var url = URL.createObjectURL(blob);
	var au = document.createElement('audio');
	var li = document.createElement('li');
	var link = document.createElement('a');

	//name of .wav file to use during upload and download (without extendion)
	var filename = new Date().toISOString();

	//add controls to the <audio> element
	au.controls = true;
	au.src = url;

	//save to disk link
	link.href = url;
	link.download = filename + ".wav"; //download forces the browser to donwload the file using the  filename
	//link.innerHTML = "Save to disk";

	//add the new audio element to li
	li.appendChild(au);

	//add the filename to the li
	//li.appendChild(document.createTextNode(filename+".wav "))

	//add the save to disk link to li
	li.appendChild(link);

	//clear link
	var clear = document.createElement('a');
	clear.className = 'delete_btn';
	clear.href = "#";
	clear.innerHTML = "Delete";

	//upload link
	var upload = document.createElement('a');
	upload.className = 'btn btn-primary audio_upld';
	upload.href = "#";
	upload.innerHTML = "Submit";

	upload.addEventListener("click", function (event) {
		$('.loader').show();
		var xhr = new XMLHttpRequest();
		var user_role = $('#user_role').val();
		xhr.onload = function (e) {
			if (this.readyState === 4) {
				//console.log("Server returned: ",e.target.responseText);
				if(user_role == 4){
					$('.tic_show').html(e.target.responseText);
					$('#ticket_conform').modal('toggle');
					$('#ticket_conform').modal('show');
				}
				if(user_role == 3){	
					$('.msg_validation').html('Answer submitted');
	        		$('.msg_validation').css('color','green');

	        		setTimeout(function(){
	        			window.location.href = url_path + "pending_ticket_cpa";
	     //    			$('#ticket_open').modal('toggle');
						// $('#ticket_open').modal('hide');
	        		},5000);
	        	}	
			}
			$('.loader').hide();
		};
		var cpa_id = $('#cpa_id').val();
		
		var tkt_id = $('.tkt_id').val();
		

		if(user_role == 4){
			 upload_file = url_path + "question_answer/upload";
		}
		if(user_role == 3){
			upload_file = url_path + "ticket_details_cpa/update_answer";
		}	

		var fd = new FormData();
		fd.append("audio_data", blob, filename);
		fd.append("cpa_id", cpa_id);
		fd.append("tkt_id", tkt_id);
		fd.append("user_role", user_role);
		//fd.append("pay_customer_id", pay_customer_id);
		xhr.open("POST", upload_file, true);
		xhr.send(fd);
	})
	li.appendChild(document.createTextNode(" ")) //add a space in between
	if(cpa_audio == 'yes'){
		li.appendChild(clear) //add the upload link to li
	}	
	li.appendChild(upload) //add the upload link to li

	//add the li element to the ol
	recordingsList.appendChild(li);
}
