<script setup>
    defineProps({ Videos: Array })
</script>
<template>
    <div class="h-full w-full flex">


        <div class="w-[300px] h-full bg-slate-100 px-4 py-10 space-y-2">
            <div class="rounded-lg h-14 flex flex-row space-x-4 items-center justify-center text-slate-500 bg-slate-300 opacity-90 hover:bg-slate-300">
                <div class="basis-2/6 flex flex-row justify-end">
                    <img src="./Assets/film.png" alt="film">
                </div>
                <p class="basis-4/6">
                    My Recordings
                </p>
            </div>
            <div @click="closeTheRecord" class="rounded-lg h-14 flex flex-row space-x-4 items-center justify-center text-slate-500 hover:bg-slate-300 hover:opacity-90">
                <div class="basis-2/6 flex flex-row justify-end">
                    <img src="./Assets/share.png" alt="film">
                </div>
                <p class="basis-4/6">
                    Requested
                </p>
            </div>
        </div>
        <div class="w-full px-20">
            <div class="h-14 flex space-x-4 items-center text-slate-500 font-medium">
                <p class="text-sm">
                    Snapbyte
                </p>
                <div class="">
                    <img src="./Assets/right-arrow.png" width="10" alt="right">
                </div>
                <p class="text-sm">
                    My Recordings
                </p>
            </div>


            <div class="h-14 flex space-x-4 items-center text-slate-500">
                <p class="text-2xl text-stone-800">
                    My Recordings
                </p>
                <p class="text-2xl font-semibold">
                    25
                </p>

                <div class="basis-10/12 flex flex-row items-center justify-end space-x-2">
                    <div  class="flex flex-row items-center justify-center py-2 px-4 rounded-full border-2 space-x-1">
                        <img src="./Assets/up-down.png" width="15" alt="up down">
                        <p class="text-sm">
                            By Date
                        </p>
                    </div>

                    <div  class="flex flex-row items-center justify-center py-2 px-4 rounded-full border-2 space-x-1">
                        <img src="./Assets/filter.png" width="15" alt="up down">
                        <p class="text-sm">
                            Add Filter
                        </p>
                    </div>

                    <div  class="flex flex-row items-center justify-center py-2 px-4 rounded-full bg-sky-600 border-2 border-sky-600 space-x-1">
                        <img src="./Assets/video-camera.png" width="19" alt="up down" class="text-white-100">
                        <p class="text-sm text-white">
                            New Request
                        </p>
                    </div>

                    <div @click="startRecord = true" class="flex flex-row items-center justify-center py-2 px-4 cursor-pointer rounded-full bg-red-500 border-2 border-red-500 space-x-1">
                        <img src="./Assets/record.png" width="19" alt="up down" class="text-white-100">
                        <p class="text-sm text-white">
                            Start Recording
                        </p>
                    </div>

                </div>
            </div>

            <!-- <div> -->
                <VideoTable class="w-full my-12" :videos="Videos" />
            <!-- </div> -->
        </div>



        <NewRecordingModal v-if="startRecord" :closeRecord="() => startRecord = false" />
    </div>
</template>
<script>
import NewRecordingModal from './components/NewRecordingModal.vue';
import VideoTable from './components/VideoTable.vue';


    export default {
        data(){
            return{
                startRecord: false
            }
        },
        mounted(){

            console.log(this.Videos)
        },
        components: {
            NewRecordingModal,
            VideoTable
        },
        methods: {
            closeTheRecord(){
                console.log(this.startRecord);
                this.startRecord = false;
            }
        }
    }
</script>
