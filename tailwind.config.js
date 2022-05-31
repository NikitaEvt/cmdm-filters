module.exports = {
  mode: process.env.NODE_ENV ? "jit" : undefined,
  content: ["./application/views/**/*.{html,php}"],
  theme: {
    extend: {
      colors: {
        "sky-theme": "#3597D0",
        "gray-theme": "#F9F9F9",
      },
      borderRadius: {
        card: "1.3rem",
        bg: "2.1rem",
      },
      boxShadow: {
        card: "0px 1px 4px rgba(0, 0, 0, 0.1);",
      },
    },
    fontFamily: {
      "f-light": "'Aeroport-L'",
      "f-regular": "'Aeroport'",
      "f-bold": "'Aeroport-B'",
    },
    container: {
      center: true,
      padding: {
        DEFAULT: "1rem",
        sm: "3rem",
      },
    },
  },
  plugins: [],
};
