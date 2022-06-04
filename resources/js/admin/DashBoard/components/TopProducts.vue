<template>
  <v-col cols="6">
    <v-card light>
      <v-card-title>Sản phẩm bán chạy</v-card-title>
      <v-card-text>
        <v-simple-table light>
        <template v-slot:default>
          <tbody>
            <tr v-for="product in products.data" :key="product.id">
              <td>
                <v-img :src="product.image_url" max-height="50" max-width="50"></v-img>
              </td>
              <td>
                <b class="blue--text">{{ (product.desc && product.desc.name) || 'N/A' }}</b> <br>
                <span class="grey--text">{{ (product.desc && product.desc.short_description) || '' }}</span>
              </td>
              <td>
                <v-btn x-small class="white--text" color="info" @click="handleShowDialog(product)">{{ product.price_currency }}</v-btn>
              </td>

            </tr>
          </tbody>
        </template>
      </v-simple-table>
      </v-card-text>

      <v-dialog
        v-model="showDialog"
        max-width="600"
      >
        <v-card>
          <v-card-title class="headline">
            {{ product.desc.name }}
          </v-card-title>

          <bar-chart :chart-data="datacollection" :options="options"></bar-chart>
        </v-card>
      </v-dialog>
    </v-card>


  </v-col>
</template>

<script>
import api from "../helpers/api";
import BarChart from './charts/BarChart.js'
export default {
  name: "Dashboard",
  components: {BarChart},
  data() {
    return {
      products: [],
      showDialog: false,
      product: {
        desc: {
          name: ''
        }
      },
      datacollection: {
        labels: [],
        datasets: [
          {
            label: '# Doanh số',
            data: []
          }
        ]
      },
      options: {
        responsive: true,
        tooltips: {
          callbacks: {
            label(tooltipItem, data) {
              let index = tooltipItem.index;
              return 'Doanh số: ' + data.revenue_txt[index];
            }
          }
        },
      },
    };
  },

  mounted() {
    this.getTopPurchasedProducts();
  },

  methods: {
    async getTopPurchasedProducts() {
      let result = await api.request('GET', 'dashboard/top-products');
      this.products = result.data;
    },

    async handleShowDialog(product) {
      this.product = product;
      let result = await api.request('GET', 'dashboard/product/'+product.id);
      if (result.data) {
        this.datacollection = result.data.data;
        this.showDialog = true;
        window.parent.postMessage('openDialogFullScreen', {data: 123});
      }
    }
  },
};
</script>


