
<template>
    <div class="loaderWrapper" v-if="loader" >
        <div class="loader-box" >
            <div class="loader-15"></div>
        </div>
    </div>
</template>
<script>
export default {
    name: "loader",
    props:['loader'],

}
</script>
