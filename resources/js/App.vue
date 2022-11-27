<script setup>
import Header from "./chatbot/Header.vue";
import Body from "./chatbot/Body.vue";
import Footer from "./chatbot/Footer.vue";</script>
<template>
    <div id="chat-container" class="chat-container">
        <!--        <Splash/>-->
        <Header/>
        <Body/>
        <Footer/>
    </div>
</template>
<script>
import {io} from "socket.io-client";

export default {
    name: "App",
    methods: {
        coreInit() {
            const socket = io("ws://192.168.1.3:4000", {
                reconnectionDelayMax: 10000,
                auth: {
                    token: "123"
                },
                query: {
                    "my-key": "my-value"
                }
            });

            socket.on("connect", () => {
                this.socket = socket;
            });

            socket.on("hi", (msg) => {
                console.log("Server (Broadcasting): " + msg);
            })
            socket.on("chat", (response) => {
                console.log("Server: " + JSON.stringify(response));
                let received = {
                    project: "#project_token",
                    message: response.message,
                    from: "server"
                };
                this.message.unshift(received);
            })
            socket.on('error', err => {
                console.log("Error occurs!");
                console.log(err);
            });
            socket.emit("chat", "OK");
        }
    },
    mounted() {
        this.coreInit();
    },
    data() {
        return {
            socket: null,
            message: []
        };
    },
}
</script>
<style lang="scss">
@import "resources/scss/chabot";
</style>
