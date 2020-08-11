module.exports = {
  prefix: "",
  important: false,
  separator: ":",
  theme: {
    colors: {},
    // ...
    zIndex: {},
  },
  variants: {
    appearance: ["responsive"],
    backgroundColor: ["responsive", "hover", "focus", "active"],
    opacity: ["responsive", "hover", "focus", "disabled"],
    zIndex: ["responsive", "hover", "focus"],
    borderWidth: ["responsive", "first", "hover", "focus"],
    width: ["responsive", "first", "hover", "focus"],
    space: ["responsive", "hover", "focus"],
  },
  plugins: [
    // ...
  ],
};
