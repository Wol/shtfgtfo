<template>
    <div class="h-full flex flex-col">
        <div class="flex-1 border bg-pink-500" id="map">
            I'm an example component. {{ token }}
        </div>
        <div class="flex-1 border bg-purple-400" id="pano">
            I'm an example component. {{ token }}
        </div>
        <div>
            <pre>name: {{ nickname }}, following: {{ following }}</pre>
            <pre>{{ panoid }} {{ position }} {{ pov }}</pre>
            <span class="border p-1" @click="following='Puddin1'">Follow puddin1</span>
        </div>
    </div>
</template>

<script>


  import loadGoogleMapsApi from 'load-google-maps-api';
  import axios from 'axios';
  import {throttle, debounce} from 'lodash';


  export default {
    name: 'game-component',
    mounted() {
      this.initialize();
      console.log('Component mounted.')
    },
    data() {
      return {
        status: {},

        position: null,
        pov: {
          heading: null,
          pitch: null,
        },
        panoid: null,
        following: null,

      }
    },
    props: {
      token: String,
      nickname: String,
    },
    watch: {},
    methods: {
      sendToServer: throttle(function () {
        console.log("debounced position");
      }, 1000),

      sendToClients: debounce(
        throttle(function () {

          if (!this.following) {
            this.channel.whisper('movement', {
              name: this.nickname,
              position: this.position,
              pov: this.pov,
              panoid: this.panoid,
            })

          }

        }, 1000) // Throttle
        , 150) // Debounce
      ,

      async initialize() {


        var self = this;


        this.channel = Echo.private('game.' + this.token)
          .listenForWhisper('movement', (e) => {
            this.handleUserUpdate(e);
          });


        console.log("Initializing Gmap");
        let google = await loadGoogleMapsApi({key: process.env.MIX_GOOGLEMAPS_KEY});

        console.log("Initializing round");
        let response = await axios.get('/game/api/' + this.token);
        this.status = response.data;

        console.log("Loading maps...");

        var ll = {lat: this.status.round.location.lat, lng: this.status.round.location.lng};


        let sv = new google.StreetViewService();
        let panorama = new google.StreetViewPanorama(document.getElementById('pano'), {
          position: ll,
          linksControl: true,
          panControl: true,
          addressControl: false,
          fullscreenControl: true,
          enableCloseButton: false
        });

        this.panorama = panorama;


        this.map = new google.Map(document.getElementById('map'), {
          center: ll,
          zoom: 16,
          streetViewControl: false,
          disableDefaultUI: true,
        });


        panorama.addListener('pano_changed', function () {
          self.panoid = panorama.getPano();
          console.log("New pano loaded", self.panoid);
          self.sendToClients();
        });

        panorama.addListener('position_changed', function () {
          self.position = panorama.getPosition();


          console.log("New position loaded", self.position.lat, self.position.lng);
          self.sendToClients();
        });

        panorama.addListener('pov_changed', function () {
          self.pov = panorama.getPov();

          self.sendToClients();
        });


      },

      handleUserUpdate(eventinfo) {

        console.log("New update from: " + eventinfo.name);

        if (eventinfo.name === this.following) {
          this.panorama.setPano(eventinfo.panoid);
          // this.panorama.setPosition(eventinfo.position);
          this.panorama.setPov(eventinfo.pov);

          var self = this;
          console.log("New pano client", self.panoid);
          console.log("New position client", self.position.lat, self.position.lng);

        }

      }


    }
  }
</script>
