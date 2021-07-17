import { createApp } from "vue";
import PasswordReset from "./components/PasswordReset.vue";

const app = createApp({});

app.component("password-reset", PasswordReset);
// mount the app to the DOM
app.mount("#app");

require("./bootstrap");

require("alpinejs");
