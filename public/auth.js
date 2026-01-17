const authHandlers = {
  login: {
    form: document.getElementById("login-form"),
    message: document.getElementById("login-message"),
    endpoint: "/api/login.php"
  },
  register: {
    form: document.getElementById("register-form"),
    message: document.getElementById("register-message"),
    endpoint: "/api/register.php"
  }
};

Object.values(authHandlers).forEach((handler) => {
  if (!handler.form) {
    return;
  }

  handler.form.addEventListener("submit", async (event) => {
    event.preventDefault();
    handler.message.textContent = "";

    const formData = new FormData(handler.form);
    const payload = Object.fromEntries(formData.entries());

    try {
      const response = await fetch(handler.endpoint, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload)
      });

      const data = await response.json();
      if (!response.ok) {
        handler.message.textContent = data.message || "Something went wrong.";
        return;
      }

      handler.message.textContent = data.message;
      handler.form.reset();
    } catch (error) {
      handler.message.textContent = "Unable to submit right now.";
    }
  });
});
