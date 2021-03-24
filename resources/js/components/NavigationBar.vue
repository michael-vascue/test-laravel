<template>
    <div class="container d-flex">
        <h3 class="header-title pt-4">Illus Dream</h3>

        <div class="ml-auto mt-4" role="group">
            <button type="button" class="btn btn-default"><router-link to="/dashboard">Home</router-link></button>
            <button type="button" class="btn btn-default">Illustration Gallery</button>
            <button type="button" class="btn btn-default">Create Illustration</button>
            <button type="button" class="btn btn-default">Sign Up</button> 
        </div>


    </div>
</template>

<script>
    export default {
        // methods: {
        //     redirectToHome() {
        //         this.$router.push({ path: '/dashboard' });
        //     },
        // }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .header-title, button{
        font-family: $primary-font;
        color: $primary-color;
    }

    button{
        font-size: 16px;
        font-weight: 500;
    }
    
    

</style>


