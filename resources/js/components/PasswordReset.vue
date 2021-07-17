<template lang="">
    <form @submit.prevent="">
        <div class="row no-gutters">
            <div class="col-lg-4 card-body">
                <p><strong class="headings-color">Update Your Password</strong></p>
                <p class="text-muted">Change your password.</p>
            </div>
            <div class="col-lg-8 card-form__body card-body">
                <div class="form-group">
                    <label for="opass">Old Password</label>
                    <input style="width: 470px;" id="opass" name="opass" type="password" class="form-control"
                        placeholder="Old password" />
                </div>
                <div class="form-group">
                    <label for="npass">New Password</label>
                    <input style="width: 470px;" id="npass" name="npass" type="password" class="form-control"
                        placeholder="New password" />
                    <small class="invalid-feedback">The new password must not be empty.</small>
                </div>
                <div class="form-group">
                    <label for="cpass">Confirm Password</label>
                    <input style="width: 470px;" id="cpass" name="cpass" type="password" class="form-control"
                        placeholder="Confirm password" />
                </div>
                <button type="button" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
</template>
<script>
export default {
    
}
</script>
<style lang="">
    
</style>