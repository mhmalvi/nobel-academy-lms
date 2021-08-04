<template>
  <div class="card card-form">
    <div class="row no-gutters">
      <div class="col-lg-4 card-body">
        <p><strong class="headings-color">Create a meeting</strong></p>
        <p class="text-muted"></p>
      </div>
      <div class="col-lg-8 card-form__body card-body">
        <form @submit.prevent="onSubmitHandler()" id="createNewMeeting">
          <div class="form-group">
            <label for="topic">Meeting Topic</label>
            <input
              type="text"
              class="form-control"
              placeholder="Type you meeting topic here .."
              v-model="topic"
            />
          </div>
          <div class="form-group">
            <label for="datetime">Date</label>

            <input
              id="dateTime"
              type="text"
              class="form-control"
              placeholder="Schedule your meeting date, time .."
              data-toggle="flatpickr"
              value="today"
              @change="getValue"
            />
          </div>
          <button
            type="submit"
            class="btn btn-primary"
            :class="isCreating && 'is-loading'"
            :disabled="!isValid"
          >
            Create Meeting
          </button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      topic: "",
      schedule: "",
      isCreating: false,
    };
  },

  methods: {
    getValue(event) {
      var val = event.target.value;
      this.schedule = val;
    },

    onSubmitHandler() {
      this.isCreating = !this.isCreating;
      axios
        .post("create/meeting", {
          topic: this.topic,
          datetime: this.schedule,
        })
        .then((res) => {
          this.$emit("newMeeting", res.data);
          this.topic = "";
          this.schedule = "";
          this.isCreating = !this.isCreating;
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },

  computed: {
    isValid() {
      return this.topic && this.schedule && !this.isCreating;
    },
  },
};
</script>
<style>
</style>