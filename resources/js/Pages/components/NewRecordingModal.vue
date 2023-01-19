<script setup>
    import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="absolute h-full w-screen bg-gray-900/50 flex flex-row items-center justify-center z-30">
        <div class="w-[500px] flex flex-col h-3/6 bg-white rounded-lg px-8 py-4">
            <div class="h-16 flex space-x-4 items-center text-slate-500">
                <p class="text-2xl text-black font-bold">
                    New Recording
                </p>
                <div class="grow">
                </div>
                <div  class="p-4 cursor-pointer" @click="() => closeRecord()">
                    <img src="../Assets/close.png" width="19" alt="up down" class="text-white-100">
                </div>
            </div>

            <hr class="w-full">
            <p class="text-stone-600 py-5">
                Save the recording in
            </p>

            <div  class="flex flex-row items-center bg-slate-100 justify-center py-2 px-4 rounded-md border-2 space-x-1">
                <p class="text-bases text-slate-500 font-medium">
                    Select a project
                </p>
                <div class="grow">
                </div>
                <img src="../Assets/arrow-down-sign-to-navigate.png" width="15" alt="up down">
            </div>
            <div class="grow"></div>

            <div class="h-14 flex space-x-4 items-center text-slate-500">
                <p class="text-lg text-slate-500 font-semibold">
                    Record Screen
                </p>
                <div class="grow">
                </div>
                <Toggle v-model="recordScreen" />
            </div>


            <div class="h-14 flex space-x-4 items-center text-slate-500">
                <p class="text-lg text-slate-500 font-semibold">
                    Record Camera
                </p>
                <div class="grow">
                </div>
                <Toggle v-model="recordCam" />
            </div>


            <div class="h-14 flex space-x-4 items-center text-slate-500">
                <p class="text-lg text-slate-500 font-semibold">
                    Record Mic
                </p>
                <div class="grow">
                </div>
                <Toggle v-model="recordMic" />
            </div>


            <div class="grow"></div>


            <div class="flex items-center justify-center">
                <Link href="/camera">
                    <div  class="flex flex-row items-center justify-center py-2 px-4 rounded-full bg-sky-600 w-44">
                        <p class="text-lg font-medium text-white">
                            Start Recording
                        </p>
                    </div>
                </Link>
            </div>
        </div>

    </div>
</template>

<script>
    import Toggle from '@vueform/toggle'


    export default {
        data(){
            return {
                turnOff: false,
                recordScreen: false,
                recordMic: false,
                recordCam: false,
                trackColor: '#ccc'
            }
        },
        props:{
            closeRecord: Function
        },
        methods: {
            changeTrackColor(bool){
                this.trackColor = '#14b8a6'
            }
        },
        components: {
            Toggle,
        },
    }
</script>
<style src="@vueform/toggle/themes/default.css"></style>
