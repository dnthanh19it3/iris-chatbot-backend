<template>
<div id="body" class="body">
    <div v-for="msg in this.$parent.message" class="line-chat" :class="{ ' line-chat--my' : (msg.from == 'client'), 'line-chat--their' : true }">
        <div :class="{'your': (msg.from == 'client'), 'their': (msg.from == 'server')}">{{ msg.message }}</div>
    </div>
</div>
</template>

<script>
export default {
    name: "Body"
}
</script>

<style scoped>

</style>
