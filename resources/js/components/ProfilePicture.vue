<template lang="">
    <div class="card card-form">
        <div class="row no-gutters">
            <div class="col-lg-4 card-body">
                <p><strong class="headings-color">Profile Settings</strong></p>
                <p class="text-muted">Update your public profile with relevant and meaningful information.</p>
            </div>
            <div class="col-lg-8 card-form__body card-body">
                <div class="form-group">
                    <label for="avatar">Image</label>
                    <input type="file" class="form-control" @change="uploadHandler" />
                </div>

                <button type="button" class="btn btn-primary" :disabled="!isValid" @click="submitHandler()">Save</button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      avatar: "",
    };
  },
  methods: {
    uploadHandler(event) {
      this.avatar = event.target.files[0];
    },

    submitHandler() {
      var formData = new FormData();
      formData.append("avatar", this.avatar);
      axios
        .post("edit-profile-picture", formData)
        .then((res) => {
          location.reload();
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },
  computed: {
    isValid() {
      return this.avatar;
    },
  },
};
</script>
<style lang="">
</style>