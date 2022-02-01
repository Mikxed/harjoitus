<template>
    <div>
      <h2 class="text-center">Customers</h2>

      <table class="table">
        <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Last name</th>
          <th>Information</th>
          <!-- <th>Actions</th> -->
        </tr>
        </thead>
        <tbody>
        <tr v-for="customer in customers" :key="customer.id">
          <td>{{ customer.id }}</td>
          <td>
            <div v-if="editModeId === customer.id">
              <input type="text" class="form-control w-50" :class="{'invalid-field': !customer.name && error}" :placeholder="error && !customer.name ? 'Pakollinen kenttä' : ''" v-model="customer.name">
            </div>
            <div v-else>
              {{ customer.name }}
            </div>
          </td>
          <td>
            <div v-if="editModeId === customer.id">
              <input type="text" class="form-control w-50" :class="{'invalid-field': !customer.last_name && error}" :placeholder="error && !customer.last_name ? 'Pakollinen kenttä' : ''" v-model="customer.last_name">
            </div>
            <div v-else>
              {{ customer.last_name }}
            </div>
          </td>
          <td>
            <div v-if="editModeId === customer.id">
              <input type="text" class="form-control w-50" :class="{'invalid-field': !customer.information && error}" :placeholder="error && !customer.information ? 'Pakollinen kenttä' : ''" v-model="customer.information">
            </div>
            <div v-else>
              {{ customer.information }}
            </div>
          </td>
          <td>
            <div class="btn-group" role="group">
              <button v-if="editModeId === customer.id" class="btn btn-primary" @click="editCustomer(customer)">Tallenna</button>
              <button v-else class="btn btn-secondary" @click="setEditMode(customer.id)">Muokkaa</button>
              <button class="btn btn-danger" @click="deleteCustomer(customer.id)">Delete</button>
            </div>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="text" class="form-control w-50" :class="{'invalid-field': !cName && error}" :placeholder="error && !cName ? 'Pakollinen kenttä' : ''" v-model="cName">
          </td>
          <td>
            <input type="text" class="form-control w-50" :class="{'invalid-field': !cLastName && error}" :placeholder="error && !cLastName ? 'Pakollinen kenttä' : ''" v-model="cLastName">
          </td>
          <td>
            <input type="text" class="form-control" :class="{'invalid-field': !cInfo && error}" :placeholder="error && !cInfo ? 'Pakollinen kenttä' : ''" v-model="cInfo">
          </td>
          <td>
            <div class="btn-group" role="group">
              <button class="btn btn-primary" @click="createCustomer">Create</button>
            </div>
          </td>
        </tr>
        </tbody>
      </table>
      <div v-if="error" class="alert alert-danger" role="alert">
        {{`Ilmeni ongelma. ${error} ${errorMessage}`}}
      </div>
    </div>
</template>
 
<script>
  export default {
    data() {
      return {
        customers: [],
        cName: '',
        cLastName: '',
        cInfo: '',
        error: null,
        errorMessage: null,
        editModeId: null
      }
    },
    created() {
        this.getCustomers()        
    },
    methods: {
      async getCustomers() {
        try {
          const res = await this.axios.get('/api/customers/')
          this.customers = res.data;
        } catch (err) {
          console.error(err)
          this.error = err.response.status
          this.errorMessage = err.response.data.message
        }
      },
      async deleteCustomer(id) { 
        try {
          const res = await this.axios.delete(`/api/customer/${id}`)
          let i = this.customers.map(data => data.id).indexOf(id);
          this.customers.splice(i, 1)
        } catch (err) {
          console.error(err)
          this.error = err.response.status
          this.errorMessage = err.response.data.message
        }
      },
      setEditMode(id) {
        this.editModeId = null;
        this.editModeId = id;
      },
      async editCustomer(customer) {
        try {
          await this.axios.post(`/api/customer/edit`, customer)
          this.editModeId = null;
        } catch (err) {
          console.error(err)
          this.error = err.response.status
          this.errorMessage = err.response.data.message
        }
      },
      async createCustomer() {
        try {
          const data = {
            name: this.cName,
            last_name: this.cLastName,
            information: this.cInfo,
          }
          await this.axios.post(`/api/customer`, data)
          this.cName = ''
          this.cLastName = ''
          this.cInfo = ''
        } catch (err) {
          console.error(err)
          this.error = err.response.status
          this.errorMessage = err.response.data.message
        }
        this.getCustomers()
      }
    }
  }
</script>

<style scoped>
.invalid-field {
    border-width: 1px;
    border-color: red;
}
</style>