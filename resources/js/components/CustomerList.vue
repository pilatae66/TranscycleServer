<template>
  <v-card
    class="mx-auto ma-0 pa-0"
    width="100vw"
    height="80vh"
    tile
  >
  <v-toolbar
      color="indigo"
      dark
    >
      <v-toolbar-title>Customer List</v-toolbar-title>
  </v-toolbar>
  <v-list class="ma-0 pa-0">
      <div v-for="customer in customers" :key="customer.id" @click="getLocation(customer)">
        <v-list-item >
        <v-list-item-content>
            <v-list-item-title class="text-center" v-text="`${customer.name}`"></v-list-item-title>
        </v-list-item-content>
        </v-list-item>
        <v-divider></v-divider>
      </div>
  </v-list>
  </v-card>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import router from '../routes/router'
export default {
    computed:{
        ...mapState({
            customers: 'customers'
        })
    },
    created(){
        this.customerInit()
    },
    methods:{
        ...mapActions([
            'customerInit'
        ]),
        getLocation(customer){
            console.log(customer);
            router.push({ name: 'map', params:{ customer_location: { lat: customer.address.lat, lng: customer.address.lng } } })
        }
    }
}
</script>
