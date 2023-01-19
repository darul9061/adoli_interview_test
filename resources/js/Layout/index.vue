<template>
    <div class="h-screen w-full">
        <NavBar/>

        <div class="h-full w-full flex items-center justify-center">
            <slot/>
        </div>
    </div>
</template>
<script>
import NavBar from '../Pages/components/NavBar.vue';


    export default {
        data(){
            return{

            }
        },
        components: {
            NavBar
        }
    }
</script>
