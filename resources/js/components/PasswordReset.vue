<template lang="">
    <form @submit.prevent="onSubmit()" id="reset">
        <div class="row no-gutters">
            <div class="col-lg-4 card-body">
                <p><strong class="headings-color">Update Your Password</strong></p>
                <p class="text-muted">Change your password.</p>
            </div>
            <div class="col-lg-8 card-form__body card-body">
                <div class="alert alert-soft-success d-flex  align-items-center" role="alert" v-if="success">
                  <div class="text-body">
                    {{success}}
                  </div>
                </div>
                <div class="form-group">
                    <label for="opass">Old Password</label>
                    <input style="width: 470px;" type="password" class="form-control" v-model="oldPassword" placeholder="Old password" autocomplete="false"/>
                </div>
                <div class="form-group">
                    <label for="npass">New Password</label>
                    <input style="width: 470px;" type="password" class="form-control" v-model="newPassword" placeholder="New password" />
                </div>
                <div class="form-group">
                    <label for="cpass">Confirm Password</label>
                    <input style="width: 470px;" type="password" class="form-control" :class="!passwordMatched() && 'is-invalid'" v-model="password_confirmation" placeholder="Confirm password" />
                </div>
                <button type="submit" class="btn btn-lg btn-primary" :class="isLoading && 'is-loading'" :disabled="!isValid">Save</button>
            </div>
        </div>
    </form>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      oldPassword: "",
      newPassword: "",
      password_confirmation: "",
      isLoading: false,
      success: null,
      errors: [],
    };
  },
  methods: {
    passwordMatched() {
      if (this.newPassword == this.password_confirmation) {
        return true;
      } else {
        return false;
      }
    },
    onSubmit() {
      this.isLoading = true;
      axios
        .post("update-password", {
          oldPassword: this.oldPassword,
          password: this.newPassword,
          password_confirmation: this.password_confirmation,
        })
        .then((res) => {
          this.oldPassword = "";
          this.newPassword = "";
          this.password_confirmation = "";
          this.isLoading = false;
          this.success = res.data.msg;
        })
        .catch((err) => {
          this.isLoading = false;
          alert("Invalid request. Please Try arain");
        });
    },
  },
  computed: {
    isValid() {
      return (
        this.oldPassword &&
        this.newPassword &&
        this.passwordMatched() &&
        !this.isLoading
      );
    },
  },
};
</script>
<style lang="">
</style>