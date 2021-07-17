<template lang="">
    <div>
        <form>
            <div class="row no-gutters">
                <div class="col-lg-4 card-body">
                    <p><strong class="headings-color">Basic Information</strong></p>
                    <p class="text-muted">Edit your account details and settings.</p>
                </div>
                <div class="col-lg-8 card-form__body card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="fname">First name</label>
                                <input type="text" class="form-control" placeholder="First name" value="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="lname">Last name</label>
                                <input type="text" class="form-control"  placeholder="Last name" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" placeholder="Phone number" value="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="mobile">Mobile Number</label>
                                <input type="text" class="form-control" placeholder="Mobile number" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="addressOne">Present Address</label>
                        <textarea rows="4" class="form-control" placeholder="Present Address ..." style="resize: none;"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="addressTwo">Peramnent Address</label>
                        <textarea rows="4" class="form-control" placeholder="Permanent Address" style="resize: none;"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {};
</script>
<style lang="">
</style>