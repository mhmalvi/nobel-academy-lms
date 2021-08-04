import { createApp } from "vue";
import PasswordReset from "./components/PasswordReset.vue";
import BasicInfo from "./components/BasicInfo.vue";
import ProfilePicture from "./components/ProfilePicture.vue";
import ZoomMeeting from "./components/ZoomMeeting.vue";

const app = createApp({});

app.component("password-reset", PasswordReset);
app.component("basic-info", BasicInfo);
app.component("profile-picture", ProfilePicture);
app.component("zoom-meeting", ZoomMeeting);

// mount the app to the DOM
app.mount("#app");

require("./bootstrap");

require("alpinejs");
