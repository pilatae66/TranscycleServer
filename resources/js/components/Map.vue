<template>
<v-row>
    <v-col class="pa-0 ma-0">
        <v-dialog
        v-model="dialog"
        width="500"
        >
        <template v-slot:activator="{ on }">
            <v-btn
            color="blue"
            dark
            v-on="on"
            style="margin-bottom: -100px; margin-left: 10px; z-index: 1"
            >
            Customer Details
            </v-btn>
        </template>

        <v-card>
            <v-card-title
            class="headline blue text-white"
            primary-title
            >
            {{ this.customer.customer.name }}
            </v-card-title>

            <v-card-text>
                <v-row>
                    <v-col>
                        Monthly Amortization: <br> P4,611.00
                    </v-col>
                    <v-col>
                        Amount Due: <br> P40,000.00
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        Total Payments: <br> P{{ new Intl.NumberFormat('en-US', { minimumFractionDigits: 2}).format(this.total_payments) }}
                    </v-col>
                </v-row>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                color="primary"
                text
                @click="dialog = false"
            >
                Close
            </v-btn>
            </v-card-actions>
        </v-card>
        </v-dialog>
        <gmap-map
            ref="gmap"
            :center="center"
            class="pa-0 ma-0"
            :zoom="12"
            style="width: 100vw; height: 85vh;"
            :options="{
                zoomControl: true,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,
                rotateControl: false,
                fullscreenControl: true,
                disableDefaultUi: true,
            }"
        >
        <gmap-marker
            :position="origin"
            @click="toggleInfoWindow(m)">
        </gmap-marker>
        <gmap-marker
            :position="destination"
            @click="toggleInfoWindow(m)">
        </gmap-marker>
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
        dialog: false,
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
        markers: [
        ],
        origin:{
            lat:8.226157,
            lng:124.240102
        },
        directionsService:{},
        directionsRenderer:{},
        destination:{lat: 8.226157, lng: 124.240102},
        bounds:{},
        customer: null,
        total_payments: 0
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
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition((position) => {

                this.origin.lat = parseFloat(position.coords.latitude)
                this.origin.lng = parseFloat(position.coords.longitude)

                this.destination.lat = parseFloat(this.$route.params.customer_location.lat)
                this.destination.lng = parseFloat(this.$route.params.customer_location.lng)

                console.log(this.origin, this.destination)

                this.bounds.extend(this.origin)
                this.bounds.extend(this.destination)

                this.map.fitBounds(this.bounds)
                // Try HTML5 geolocation.

                new google.maps.LatLng(parseFloat(this.destination.lat), parseFloat(this.destination.lng))
                this.directionsService.route({
                    origin: new google.maps.LatLng(parseFloat(this.origin.lat), parseFloat(this.origin.lng)),
                    destination: new google.maps.LatLng(parseFloat(this.destination.lat), parseFloat(this.destination.lng)),
                    travelMode: 'DRIVING'
                }, (response, status) => {
                    if(status == 'OK') {
                        this.directionsRenderer.setDirections(response)
                    }
                    console.log(response);

                })

            }, function() {
                this.handleLocationError(true, infoWindow, map.getCenter());
            })
            navigator.geolocation.watchPosition(position => {
                console.log(position)
            })
        } else {
        // Browser doesn't support Geolocation
        this.handleLocationError(false, infoWindow, map.getCenter());
        }
      });
    },
    created(){
        this.customer = this.$route.params.customer
        this.total_payments = this.customer.payments.reduce((total, current) => total + current.amount, 0)
        console.log(this.customer)
    },
    methods: {
        handleLocationError(){
            console.log(browserHasGeolocation ? 'Error: The Geolocation service failed.' : 'Error: Your browser doesn\'t support geolocation.')
        },
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
