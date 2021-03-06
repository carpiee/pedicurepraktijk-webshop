module.exports = {
  purge: {
    enabled: true,
    content: [
      "./templates/*.php",
      "./product/*.php",
      "./js/*.js",
      "./inc/*.php",
      "./inc/*.html",
      "./cart/*.php",
      "./cart/templates/*.php",
      "./admin/*.php",
      "./admin/templates/*.php",
      "./admin/cms/*.php",
      "./account/*.php",
      "./account/templates/*.php",
      "./account/registreer/*.php",
      "./account/login/*.php",
      "./*.php",
    ],
  },
  theme: {},
  variants: {
    appearance: ["responsive"],
    backgroundColor: ["responsive", "hover", "focus", "active", "group-hover"],
    opacity: ["responsive", "hover", "focus", "disabled"],
    zIndex: ["responsive", "hover", "focus"],
    borderWidth: ["responsive", "first", "hover", "focus", "group-hover"],
    width: ["responsive", "first", "hover", "focus"],
    space: ["responsive", "hover", "focus"],
    textColor: ["responsive", "hover", "focus", "active", "group-hover"],
  },
  plugins: [],
};
