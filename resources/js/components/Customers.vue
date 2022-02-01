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
          <td>{{ customer.name }}</td>
          <td>{{ customer.last_name }}</td>
          <td>{{ customer.information }}</td>
          <td>
            <div class="btn-group" role="group">
              <button class="btn btn-danger" @click="deleteCustomer(customer.id)">Delete</button>
            </div>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="text" class="form-control w-50" v-model="cName">
          </td>
          <td>
            <input type="text" class="form-control w-50" v-model="cLastName">
          </td>
          <td>
            <input type="text" class="form-control" v-model="cInfo">
          </td>
          <td>
            <div class="btn-group" role="group">
              <button class="btn btn-primary" @click="createCustomer">Create</button>
            </div>
          </td>
        </tr>
        </tbody>
      </table>
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
            }
          },
          async deleteCustomer(id) { 
            try {
              const res = await this.axios.delete(`/api/customer/${id}`)
              let i = this.customers.map(data => data.id).indexOf(id);
              this.customers.splice(i, 1)
            } catch (err) {
              console.error(err)
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
            }
            this.getCustomers()
          }
        }
    }
</script>