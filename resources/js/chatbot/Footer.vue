<template>
    <div class="footer">
        <div class="input-zone">
            <input id="messageInput" class="chat-input" placeholder="Type something...">
        </div>
        <div class="action-zone">
            <button id="btnVoice" class="send-btn" @click="init()">
                <font-awesome-icon icon="fa-microphone"/>
            </button>
        </div>
    </div>
</template>

<script>
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

function init1() {
    // const message = this.$el.querySelector('#messageInput');
    // const btnVoice = this.$el.querySelector('#btnVoice');
    // var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
    // var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;
    //
    // var grammar = '#JSGF V1.0;'
    //
    // var recognition = new SpeechRecognition();
    // var speechRecognitionList = new SpeechGrammarList();
    // speechRecognitionList.addFromString(grammar, 1);
    // recognition.grammars = speechRecognitionList;
    // recognition.lang = 'vi-VN';
    // recognition.interimResults = false;
    //
    // recognition.onresult = function(event) {
    //     var lastResult = event.results.length - 1;
    //     var content = event.results[lastResult][0].transcript;
    //     message.setAttribute("value", content);
    //     console.log('Voice Input: ' + content + '.');
    // };
    //
    // recognition.onspeechend = function() {
    //     recognition.stop();
    //     btnVoice.classList.remove("fa-beat-fade");
    // };
    //
    // recognition.onerror = function(event) {
    //     message.textContent = 'Error occurred in recognition: ' + event.error;
    //     console.log('Error occurred in recognition: ' + event.error);
    // }
    //
    // btnVoice.addEventListener('click', function(){
    //     recognition.start();
    //     btnVoice.classList.add("fa-beat-fade");
    // });
}

export default {
    name: "Footer",
    components: {FontAwesomeIcon},
    methods: {
      init(){
          const message = this.$el.querySelector('#messageInput');
          const btnVoice = this.$el.querySelector('#btnVoice');
          var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
          var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

          var grammar = '#JSGF V1.0;'

          var recognition = new SpeechRecognition();
          var speechRecognitionList = new SpeechGrammarList();
          speechRecognitionList.addFromString(grammar, 1);
          recognition.grammars = speechRecognitionList;
          recognition.lang = 'vi-VN';
          recognition.interimResults = false;

          recognition.onresult = function(event) {
              var lastResult = event.results.length - 1;
              var content = event.results[lastResult][0].transcript;
              message.setAttribute("value", content);
              console.log('Voice Input: ' + content + '.');
          };

          recognition.onspeechend = function() {
              recognition.stop();
              btnVoice.classList.remove("fa-beat-fade");
          };

          recognition.onerror = function(event) {
              message.textContent = 'Error occurred in recognition: ' + event.error;
              console.log('Error occurred in recognition: ' + event.error);
          }

          btnVoice.addEventListener('click', function(){
              recognition.start();
              btnVoice.classList.add("fa-beat-fade");
          });
          message.addEventListener('keyup', (event) => {
              if (event.key === "Enter") {
                  try {
                      let msg = message.value;
                      if(msg == ""){
                          console.log("Empty message content!");
                          return;
                      }
                      message.value = "";
                      let sendContent = {
                          project: "#project_token",
                          message: msg,
                          from: "client"
                      };

                      console.log("Prepare content for send: " + JSON.stringify(sendContent));
                      this.$parent.message.unshift(sendContent)
                      this.$parent.socket.emit("chat", sendContent);
                  } catch (e) {
                      console.log("Error when parser message!");
                  }
              };

          });
      }
    },
    mounted() {
        console.log("Mounted");
        this.init();
    }
}
</script>

<style scoped>

</style>
