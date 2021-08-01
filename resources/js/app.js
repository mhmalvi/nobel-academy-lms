import { createApp } from "vue";
import PasswordReset from "./components/PasswordReset.vue";
import BasicInfo from "./components/BasicInfo.vue";
import ProfilePicture from "./components/ProfilePicture.vue";

const app = createApp({});

app.component("password-reset", PasswordReset);
app.component("basic-info", BasicInfo);
app.component("profile-picture", ProfilePicture);

// mount the app to the DOM
app.mount("#app");

require("./bootstrap");

require("alpinejs");
