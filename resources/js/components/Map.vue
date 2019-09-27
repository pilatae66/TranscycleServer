<template>
  <v-row>
      <v-col cols="12" style='width:"100%"; height:100%; margin:0; padding:0'>
        <gmap-map
        ref="gmap"
        :center="center"
        :zoom="12"
        style="width:100vh;  height: 100vh;"
        :options="{
            zoomControl: true,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            rotateControl: false,
            fullscreenControl: true,
            disableDefaultUi: true,
        }"
        @click="getplace"
        >

        <gmap-marker
            :key="index"
            v-for="(m, index) in marker"
            :position="marker.position"
            @click="toggleInfoWindow(marker)">
        </gmap-marker>

        <gmap-info-window
            :options="infoOptions"
            :position="infoWindowPos"
            :opened="infoWinOpen"
            @closeclick="infoWinOpen=false"
        >
            <div v-html="infoContent"></div>
        </gmap-info-window>

        </gmap-map>
      </v-col>
  </v-row>
</template>
<script>
  export default {
    name: "Map",
    data() {
      return {
        //a default center for the map
        center: {lat:8.226157, lng:124.240102},
        map: null,
        infoContent: '',
        infoWindowPos: {
          lat: 0,
          lng: 0
        },
        infoWinOpen: false,
        currentMidx: null,
        //optional: offset infowindow so it visually sits nicely on top of our marker
        infoOptions: {
          pixelOffset: {
            width: 0,
            height: -35
          }
        },
        marker:{
            name:"",
            description:"",
            date_build:'',
            position:{
                lat:0,
                lng:0
            }
        },
        markers: [
          {
            name: "House of Aleida Greve",
            description: "description 1",
            date_build: "",
            position: {lat: 52.512942, lng: 6.089625}
          },
          {
            name: "House of Potgieter",
            description: "description 2",
            date_build: "",
            position: {lat: 52.511950, lng: 6.091056}
          },
          {
            name: "House of Johannes Cele",
            description: "description 3",
            date_build: "",
            position: {lat: 52.511047, lng: 6.091728}
          },
        ],
        directionsService:{},
        directionsRenderer:{},
        bounds:{}
      };
    },
    mounted() {
      //set bounds of the map
      this.$refs.gmap.$mapPromise.then((map) => {
        this.map = map
        this.bounds = new google.maps.LatLngBounds()
        this.directionsService = new google.maps.DirectionsService()
        this.directionsRenderer = new google.maps.DirectionsRenderer()
        this.directionsRenderer.setMap(map)
        for (let m of this.markers) {
          bounds.extend(m.position)
        }
        this.map.fitBounds(bounds);
      });
    },
    methods: {
      toggleInfoWindow: function (marker, idx) {
        this.$gmapApiPromiseLazy().then(() => {

        })
        this.infoWindowPos = marker.position;
        this.infoContent = this.getInfoWindowContent(marker);


        //check if its the same marker that was selected if yes toggle
        if (this.currentMidx == idx) {
          this.infoWinOpen = !this.infoWinOpen;
        }
        //if different marker set infowindow to open and reset current marker index
        else {
          this.infoWinOpen = true;
          this.currentMidx = idx;
        }
      },
      getplace(place) {
          console.log(this.marker);
          this.marker = {
                name: 'Test',
                description: "description 2",
                date_build: "",
                position: {lat: place.latLng.lat(), lng: place.latLng.lng()}
          }

            let origin = new google.maps.LatLng(10.325659, 123.919831)
            let destination = new google.maps.LatLng(10.326031, 123.917642)
            this.directionsService.route({
                origin: origin,
                destination: destination,
                travelMode: 'DRIVING'
            }, (response, status) => {
                if(status == 'OK') {
                    response.routes.forEach(route => {
                        console.log(route);

                    });
                    this.map.fitBounds(this.bounds)
                    this.directionsRenderer.setDirections(response)
                }
                console.log(response);

            })

      },

      getInfoWindowContent: function (marker) {
        return (`<div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                        <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                        <div class="media-content">
                            <p class="title is-4">${marker.name}</p>
                        </div>
                        </div>
                        <div class="content">
                        ${marker.description}
                        <br>
                        <time datetime="2016-1-1">${marker.date_build}</time>
                        </div>
                    </div>
                </div>
                `);
      },
    }
  };
</script>
