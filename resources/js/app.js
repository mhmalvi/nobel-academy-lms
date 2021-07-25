import { createApp } from "vue";
import PasswordReset from "./components/PasswordReset.vue";
import BasicInfo from "./components/BasicInfo.vue";

const app = createApp({});

app.component("password-reset", PasswordReset);
app.component("basic-info", BasicInfo);
// mount the app to the DOM
app.mount("#app");

require("./bootstrap");

require("alpinejs");
