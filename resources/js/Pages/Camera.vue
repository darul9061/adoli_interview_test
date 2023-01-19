<template>
    <div class="bg-sky-100 h-full w-full flex items-center justify-center">
        <div class="w-[900px] h-full pt-11">


            <div @click="startRecord = true" class="flex flex-row items-center py-2 space-x-1">
                <img src="./Assets/record.png" width="19" alt="up down" class="text-white-100">
                <p class="text-sm text-slate-500 font-medium">
                    Live Preview
                </p>
            </div>
            <div class="rounded-lg w-full h-[500px] bg-sky-900 mb-11">
                <video v-show="initialized" ref="video" class="camera-stream"/>
            </div>

            <div @click="beginCameraProcess" class="flex items-center justify-center cursor-pointer" v-if="!initialized">
                <div  class="flex flex-row items-center justify-center py-2 px-4 rounded-full bg-sky-600 w-44">
                    <p class="text-lg font-medium text-white">
                        Start Recording
                    </p>
                </div>
            </div>

            <div @click="stopStream" class="flex items-center justify-center" v-else>
                <div  class="flex flex-row items-center justify-center py-3 px-4 rounded-full bg-red-600 w-44">
                    <p class="text-lg font-medium text-white">
                        Stop Recording
                    </p>
                </div>
            </div>
          <!-- <v-layout justify-center>
            <v-btn
              dark
              fab
              large
              color="pink"
              @click="capture"
            >
              <v-icon>camera</v-icon>
            </v-btn>
          </v-layout>
          <v-btn
            v-if="sources.length > 1"
            fixed
            left
            bottom
            small
            dark
            fab
            color="blue"
            @click="switchCamera"
          >
            <v-icon>camera_front</v-icon>
          </v-btn> -->
        </div>

      <!-- <v-btn
        fixed
        right
        bottom
        small
        dark
        fab
        color="blue"
        @click="gotoTask"
      >
        <v-icon>close</v-icon>
      </v-btn> -->
    </div>
  </template>

  <script>
//   import firebase from '@/services/firebase.js'
  export default {
    // props: {
    //   taskId: {
    //     type: String,
    //     required: true
    //   }
    // },
    data() {
      return {
        initialized: false,
        loading: false,
        mediaStream: null,
        sources: [],
        selectedSource: null
      }
    },
    computed: {
      isReady() {
        return this.initialized && !this.loading
      },
      taskId(){
        return Math.floor(Math.random() * 11098987978998789789979789)
      }
    },
    mounted() {
        this.beginCameraProcess()
    },
    destroyed() {
      this.stopStream()
    },
    methods: {
        beginCameraProcess(){

            const supported = 'mediaDevices' in navigator
            if (!supported) {
                this.$addError("Unfortunately we can't get access to your camera")
                return
            }
            this.getDevices()
                .then(this.gotDevices)
                .then(this.getStream)
                .then(this.gotStream)
                .catch(this.handleError)
        },

      switchCamera() {
        let nextSourceIndex = 1 + this.sources.indexOf(this.selectedSource)
        if (nextSourceIndex >= this.sources.length) {
          nextSourceIndex = 0
        }
        this.selectedSource = this.sources[nextSourceIndex]
        this.getStream().then(this.gotStream)
      },
      gotoTask() {
        this.$router.push({ name: 'detail', params: { id: this.taskId } })
      },
      capture() {
        const mediaStreamTrack = this.mediaStream.getVideoTracks()[0]
        const imageCapture = new window.ImageCapture(mediaStreamTrack)
        return imageCapture.takePhoto().then(blob => {
          this.loading = true
        //   firebase
        //     .uploadImage(`images/picture-${new Date().getTime()}`, blob)
        //     .then(url =>
        //       this.$store.dispatch('addImage', { id: this.taskId, url })
        //     )
        //     .then(() => {
        //       this.loading = false
        //       this.$router.push({ name: 'detail', params: { id: this.taskId } })
        //     })
        })
      },
      handleError(error) {
        console.log(error)
        // this.$addError(error)
      },
      async getDevices() {
        await navigator.mediaDevices.getUserMedia({audio: true, video: true});
        return navigator.mediaDevices.enumerateDevices()
      },
      gotDevices(devices) {
        this.sources = []
        devices.forEach(device => {
            console.log(device.kind)
          if (device.kind === 'videoinput') {
            this.sources.push(device)
          }
        })
        if (!this.sources.length) {
          throw 'There are no video sources found!'
        }
        if (!this.selectedSource) {
          this.selectedSource = this.sources[0]

          console.log(this.selectedSource)
        }
      },
      getStream() {
        this.stopStream()
        return navigator.mediaDevices.getUserMedia({
          video: {
            deviceId: { exact: this.selectedSource.deviceId }
          }
        })
      },
      gotStream(mediaStream) {
        this.mediaStream = mediaStream
        this.$refs.video.srcObject = mediaStream
        this.$refs.video.play().then(() => (this.initialized = true))
      },
      stopStream() {
        if (this.mediaStream) {
          this.mediaStream.getTracks().forEach(
            (track) => {
                if (track.readyState == 'live') {
                    track.stop();
                }
            }
            )
          this.initialized = false
        }
      }
    }
  }
  </script>

  <style scoped>
  .camera-stream {
    width: 100%;
    max-height: 100%;
  }
  </style>
