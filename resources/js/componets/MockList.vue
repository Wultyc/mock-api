<template>
  <div id="apis_list">
    <div class="text-center">
      <div class="spinner-border" role="status" v-if="loading == true">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <div class="alert alert-danger" role="alert" v-if="hasError == true">{{errorMessage}}</div>

    <div class="row mt-3" v-for="(item, index) in endpoints" v-bind:key="index" :item="item">
      <div class="col-md-1">
        <button class="btn btn-sm btn-outline-success" v-if="item.enabled == true">Active</button>
        <button class="btn btn-sm btn-outline-secondary" v-else>Inactive</button>
      </div>
      <div class="col-md-11">
        <a v-bind:href="'/mocks/watch/' + item.endpoint">{{item.endpoint}}</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      uri: "/api/mgmt",
      loading: false,
      hasError: false,
      errorMessage: "",
      endpoints: []
    };
  },

  mounted() {
    this.loadIndicator(true);
    this.loadEndpoints();
    this.loadIndicator(false);
  },

  methods: {
    loadIndicator: function(v) {
      this.loading = v;
    },

    loadEndpoints: function() {
      axios
        .get(this.uri)
        .then(response => {
          this.endpoints = response.data.data;
        })
        .catch(error => {
          this.riseError(error);
        });
    },

    riseError: function(error) {
      this.hasError = true;
      this.errorMessage = error;
    }
  }
};
</script>