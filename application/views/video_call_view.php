<script src="<?=base_url()?>assets/front/video/AgoraRTCSDK-2.9.0.js"></script>
<div class="expert_content d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12">
  <div class="expert_details contact_page">
        	<div id="div_device" class="panel panel-default" style="display: none;">
        		<div class="select">
        			<label for="audioSource">Audio source: </label>
        			<select id="audioSource"></select>
        		</div>
        		<div class="select">
        			<label for="videoSource">Video source: </label>
        			<select id="videoSource"></select>
        		</div>
        	</div>
         
          <div class="ed_profiledet text-center">
               <div id="div_join" class="panel panel-default">
               <div class="arrow_name">Please click here to join the call</div>
                <div class="arrow_img">
                  <img src="<?=base_url().'assets/images/giphy.gif'?>">
                </div>
                <div class="panel-body">
                  <input id="appId" type="hidden" value="<?=application_id?>" size="36"></input>
                  <input id="channel" type="hidden" value="<?=$cpa_data->id?>" size="4"></input>
                  <input id="video" type="hidden" checked></input>
                  <button id="join" class="btn btn-primary" onclick="join()">Join</button>
                  <!-- <button id="leave" class="btn btn-primary" onclick="leave()">Leave</button> -->
                <!--  <button id="publish" class="btn btn-primary" onclick="publish()">Publish</button>
                  <button id="unpublish" class="btn btn-primary" onclick="unpublish()">Unpublish</button> -->
                </div>
                </div> 
                <div id="video" class="pos_video" style="margin:0 auto;">
                  <div id="agora_local" style=""></div>
                </div>
          </div>
        	
     </div> 
  </div>
</div>
</div>
</div>

<style type="text/css">
  
  #agora_local{
    /*float:right;*/
    width:210px;
    height:147px;
    display:inline-block;
    position: absolute;
    z-index: 99999;

    margin:30px auto;
  }
  #agora_local video{
    position: unset !important;
  }
  .second_video video{
    position: unset !important;
  }
  .second_video{
    /*float:left; */
    width:810px;
    height:607px;
    display:inline-block;
    
    margin-top: 30px;
    box-shadow: 0 0 18px 5px;
  }


  .pos_video{
    margin: 0 auto;
    /*position: fixed;*/
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 999;
    background: #0009;
    left: 0;  
    /*display: none;    */
  }


  .arrow_img{
    margin: 0 auto; 
    display: inline-block; 
    width: 20px;
  }

  #div_join{
    position: relative;
  }
  .arrow_name{
    margin-bottom: 5px;
    font-size: 18px;
    font-weight: 500px;
    color: #203569;
  }


</style>

<script type="text/javascript">


//clearInterval(call_fun);

$(document).ready(function(){
    var player = document.getElementById('myAudio');
    player.pause();
    player.src = player.src;
    $('.music').html('');
});


AgoraRTC.Logger.error('this is error');
AgoraRTC.Logger.warning('this is warning');
AgoraRTC.Logger.info('this is info');
AgoraRTC.Logger.debug('this is debug');

var client, localStream, camera, microphone;

var audioSelect = document.querySelector('select#audioSource');
var videoSelect = document.querySelector('select#videoSource');

// $(document).ready(function(){
// 	setTimeout(function(){
// 		join();
// 	},10000)
	
// });


function join() {


  document.getElementById("join").disabled = true;
  document.getElementById("video").disabled = true;

  $('.arrow_name').css('display', 'none');
  $('.arrow_img').css('display', 'none');
  $('.pos_video'). attr("style", "position: fixed !important");
  var channel_key = null;

  console.log("Init AgoraRTC client with App ID: " + appId.value);
  client = AgoraRTC.createClient({mode: 'live'});
  client.init(appId.value, function () {
    console.log("AgoraRTC client initialized ss"+channel.value);
    client.join(channel_key, channel.value, null, function(uid) {
      console.log("User " + uid + " join channel successfully");

      if (document.getElementById("video").checked) {
        camera = videoSource.value;
        microphone = audioSource.value;
        localStream = AgoraRTC.createStream({streamID: uid, audio: true, cameraId: camera, microphoneId: microphone, video: document.getElementById("video").checked, screen: false});
        //localStream = AgoraRTC.createStream({streamID: uid, audio: false, cameraId: camera, microphoneId: microphone, video: false, screen: true, extensionId: 'minllpmhdgpndnkomcoccfekfegnlikg'});
        if (document.getElementById("video").checked) {
          localStream.setVideoProfile('720p_3');

        }

        // The user has granted access to the camera and mic.
        localStream.on("accessAllowed", function() {
          console.log("accessAllowed");
        });

        // The user has denied access to the camera and mic.
        localStream.on("accessDenied", function() {
          console.log("accessDenied");
        });

        localStream.init(function() {
          console.log("getUserMedia successfully");
          localStream.play('agora_local');

          client.publish(localStream, function (err) {
            console.log("Publish local stream error: " + err);
          });

          client.on('stream-published', function (evt) {
            console.log("Publish local stream successfully");
          });
        }, function (err) {
          console.log("getUserMedia failed", err);
        });
      }
    }, function(err) {
      console.log("Join channel failed", err);
    });
  }, function (err) {
    console.log("AgoraRTC client init failed", err);
  });

  channelKey = "";
  client.on('error', function(err) {
    console.log("Got error msg:", err.reason);
    if (err.reason === 'DYNAMIC_KEY_TIMEOUT') {
      client.renewChannelKey(channelKey, function(){
        console.log("Renew channel key successfully");
      }, function(err){
        console.log("Renew channel key failed: ", err);
      });
    }
  });


  client.on('stream-added', function (evt) {
    var stream = evt.stream;
    console.log("New stream added cpa join cpa jignesh: " + stream.getId());
    var cpa_id = channel.value;
    charges(cpa_id);
    console.log("Subscribe ", stream);
    client.subscribe(stream, function (err) {
      console.log("Subscribe stream failed", err);
    });
  });

  client.on('stream-subscribed', function (evt) {
    var stream = evt.stream;
    console.log("Subscribe remote stream successfully: " + stream.getId());
    if ($('div#video #agora_remote'+stream.getId()).length === 0) {
      $('div#video').append('<div class="second_video" id="agora_remote'+stream.getId()+'" ></div>');
    }
    stream.play('agora_remote' + stream.getId());
  });

  client.on('stream-removed', function (evt) {
    var stream = evt.stream;
    stream.stop();
    $('#agora_remote' + stream.getId()).remove();
    console.log("Remote stream is removed " + stream.getId());
  });

  client.on('peer-leave', function (evt) {
    var stream = evt.stream;
    if (stream) {
      stream.stop();
      $('#agora_remote' + stream.getId()).remove();
      console.log(evt.uid + " leaved from this channel");
      $('.pos_video'). attr("style", "position: unset !important");
      $('#agora_local').css('display','none');
      $('#video_info').modal({backdrop: 'static', keyboard: false});
      $('#video_info').modal('toggle');
      $('#video_info').modal('show');
      //window.location.href = "<?=base_url()?>open_ticket_cpa";
    }
  });
}

function leave() {
  document.getElementById("leave").disabled = true;
  client.leave(function () {
    console.log("Leavel channel successfully");
  }, function (err) {
    console.log("Leave channel failed");
  });
}

function publish() {
  document.getElementById("publish").disabled = true;
  document.getElementById("unpublish").disabled = false;
  client.publish(localStream, function (err) {
    console.log("Publish local stream error: " + err);
  });
}

function unpublish() {
  document.getElementById("publish").disabled = false;
  document.getElementById("unpublish").disabled = true;
  client.unpublish(localStream, function (err) {
    console.log("Unpublish local stream failed" + err);
  });
}

function getDevices() {
  AgoraRTC.getDevices(function (devices) {
    for (var i = 0; i !== devices.length; ++i) {
      var device = devices[i];
      var option = document.createElement('option');
      option.value = device.deviceId;
      if (device.kind === 'audioinput') {
        option.text = device.label || 'microphone ' + (audioSelect.length + 1);
        audioSelect.appendChild(option);
      } else if (device.kind === 'videoinput') {
        option.text = device.label || 'camera ' + (videoSelect.length + 1);
        videoSelect.appendChild(option);
      } else {
        console.log('Some other kind of source/device: ', device);
      }
    }
  });
}

//audioSelect.onchange = getDevices;
//videoSelect.onchange = getDevices;
getDevices();


function charges(cpa_id){
  var url = '<?=base_url()?>'+'ticket_details_cpa/video_pay_price';
  $.ajax({
    url: url,
    type: "POST",
    data: {'cpa_id':cpa_id},
    success: function(response) {
      
    }
  });   
}


</script>