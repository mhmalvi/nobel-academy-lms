<template>
  <create-meeting @newMeeting="getMeetingList"></create-meeting>

  <div class="my-3">
    <strong class="text-dark-gray">Upcoming Events</strong>
  </div>
  <div :class="isLoading && ['is-loading', 'is-loading-lg']">
    <div class="card p-4" v-for="item in list" :key="item.meeting_id">
      <div class="row">
        <div
          class="
            col-md-2
            d-flex
            flex-column
            justify-content-center
            align-items-center
          "
        >
          <div class="text-primary">
            <!-- LOGO -->
            <i class="material-icons" style="font-size: 5rem">voice_chat</i>
          </div>
        </div>
        <div class="col-md-10">
          <div class="stories-card__title flex">
            <h5 class="card-title m-0">{{ item.date }}</h5>
          </div>

          <div class="my-3">
            <p class="text-muted"><strong>Topic: </strong>{{ item.topic }}</p>
            <p class="text-muted">
              <strong>Password: </strong>{{ item.password }}
            </p>
            <p class="text-muted">
              <strong>Scheduled At: </strong>{{ item.time }}
            </p>
            <p class="text-muted">
              <strong>Join Link: </strong>{{ item.join_url }}
            </p>
          </div>

          <div class="mt-3">
            <button
              class="btn btn-outline-dark mr-2"
              @click="meetingStartHandler(item.start_url)"
            >
              Start Meeting
            </button>
            <button
              type="button"
              class="btn btn-danger mr-2"
              @click="deleteMeetingHandler(item.meeting_id)"
              :disabled="isDeleting"
            >
              <span v-if="isDeleting">Deleting..</span>
              <span v-else>Delete</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import CreateMeeting from "./childs/CreateMeeting.vue";
export default {
  components: {
    CreateMeeting,
  },
  data() {
    return {
      isLoading: false,
      list: [],
      isLoading: false,
      isDeleting: false,
      method: "delete",
    };
  },
  methods: {
    /**
     * Fetch the meeting list
     */
    getMeetingList() {
      this.isLoading = !this.isLoading;
      axios
        .get("meeting-list-by-host")
        .then((res) => {
          this.isLoading = !this.isLoading;
          this.list = res.data;
        })
        .catch((err) => {
          console.error(err);
        });
    },

    /**
     * This will Start the meeting in new window
     */
    meetingStartHandler(getlink) {
      window.open(getlink, "_blank");
    },

    /**
     * Delete a meeting
     */
    deleteMeetingHandler(id) {
      this.isDeleting = !this.isDeleting;
      axios
        .post(`remove/meeting/${id}`)
        .then((res) => {
          this.isDeleting = !this.isDeleting;
          this.getMeetingList();
        })
        .catch((err) => {});
    },
  },
  created() {
    /**
     * get the meeting list on page load
     */
    this.getMeetingList();
  },
};
</script>
<style>
</style>