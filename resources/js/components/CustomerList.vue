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
      <div v-for="customer in due_customers" :key="customer.id" @click="getLocation(customer)">
        <v-list-item >
        <v-list-item-content>
            <v-list-item-title class="text-center" v-text="`${customer.customer.name}`"></v-list-item-title>
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
            due_customers: 'due_customers'
        })
    },
    created(){
        this.dueCustomersInit()
    },
    methods:{
        ...mapActions([
            'dueCustomersInit'
        ]),
        getLocation(customer){
            router.push({ name: 'map', params:{
                customer_location: {
                    lat: customer.customer.address.lat,
                    lng: customer.customer.address.lng
                },
                customer: customer
            }})
        }
    }
}
</script>
