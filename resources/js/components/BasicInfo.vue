<template lang="">
    <div>
        <form @submit.prevent="onSubmit()" id="form">
            <div class="row no-gutters">
                <div class="col-lg-4 card-body">
                    <p><strong class="headings-color">Basic Information</strong></p>
                    <p class="text-muted">Edit your account details and settings.</p>
                </div>
                <div class="col-lg-8 card-form__body card-body">
                    <div class="alert alert-soft-success d-flex  align-items-center" role="alert" v-if="success">
                        <div class="text-body">
                            {{success}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user">User Name</label>
                        <input type="text" class="form-control" placeholder="User name" v-model="username">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="fname">First name</label>
                                <input type="text" class="form-control" placeholder="First name" v-model="firstname">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="lname">Last name</label>
                                <input type="text" class="form-control"  placeholder="Last name" v-model="lastname">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="mobile">Email Address</label>
                                <input type="text" class="form-control" placeholder="Email address" v-model="useremail" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" placeholder="Phone number" v-model="userphone">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="addressOne">Address</label>
                        <textarea rows="4" class="form-control" placeholder="Address ..." style="resize: none;" v-model="useraddress"></textarea>
                    </div>

                    <button type="submit" class="btn btn-lg btn-primary" :class="isLoading && 'is-loading'" :disabled="!isValid">Save</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import axios from "axios";
export default {
  props: ["name", "fname", "lname", "email", "phone", "address"],
  data() {
    return {
      username: this.name,
      firstname: this.fname,
      lastname: this.lname,
      useremail: this.email,
      userphone: this.phone,
      useraddress: this.address,
      isLoading: false,
      success: null,
      errors: [],
    };
  },
  methods: {
    onSubmit() {
      this.isLoading = true;
      axios
        .put("edit-basic-info", {
          name: this.username,
          firstname: this.firstname,
          lastname: this.lastname,
          phone: this.userphone,
          address: this.useraddress,
        })
        .then((res) => {
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
        this.username &&
        this.firstname &&
        this.lastname &&
        this.userphone &&
        this.useraddress
      );
    },
  },
};
</script>
<style lang="">
</style>