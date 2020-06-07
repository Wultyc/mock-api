<template>
  <div id="apis_list">
    <div class="text-center">
      <div class="spinner-border" role="status" v-if="loading == true">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <div class="alert alert-danger" role="alert" v-if="hasError == true">{{errorMessage}}</div>

    <form class="needs-validation" novalidate _lpchecked="1">
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="address">Endpoint</label>
            <input type="text" class="form-control" disabled v-model="details.endpoint" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="address">Status</label>
            <input type="text" class="form-control" disabled v-model="details.enabled ? 'Active' : 'Inactive'" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="address">Created At</label>
            <input type="text" class="form-control" disabled v-model="details.created_at" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="address">Updated At</label>
            <input type="text" class="form-control" disabled v-model="details.updated_at" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="mb-3">
            <label for="address">Query String</label>
            <input type="text" class="form-control" disabled v-model="details.query" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="mb-3">
            <label for="address">Message</label>
            <textarea class="form-control" disabled v-model="details.payload"></textarea>
          </div>
        </div>
      </div>
    </form>
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
      details: {
        endpoint: "",
        enabled: "",
        query: "",
        payload: "",
        created_at: "",
        updated_at: "",
        deleted_at: ""
      }
    };
  },

  mounted() {
    this.loadIndicator(true);
    this.loadDetails();
    this.loadIndicator(false);
  },

  methods: {
    loadIndicator: function(v) {
      this.loading = v;
    },

    loadDetails: function() {
      this.setURI();
      axios
        .get(this.uri)
        .then(response => {
          this.details = response.data.data;
        })
        .catch(error => {
          this.riseError(error);
        });
    },

    setURI: function() {
      let pathname = document.location.pathname;
      pathname = pathname.replace("/mocks/watch/", "");
      this.uri = "/api/mgmt/" + pathname;
    },

    riseError: function(error) {
      this.hasError = true;
      this.errorMessage = error;
    }
  }
};
</script>