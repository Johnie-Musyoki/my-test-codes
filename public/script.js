const statsContainer = document.getElementById("stats");
const featuresContainer = document.getElementById("features");
const testimonialsContainer = document.getElementById("testimonials");
const form = document.getElementById("consultation-form");
const formMessage = document.getElementById("form-message");

const renderStats = (stats) => {
  statsContainer.innerHTML = stats
    .map(
      (stat) => `
        <div class="stat">
          ${stat.value}
          <span>${stat.label}</span>
        </div>
      `
    )
    .join("");
};

const renderFeatures = (features) => {
  featuresContainer.innerHTML = features
    .map(
      (feature) => `
        <article class="feature-card">
          <h3>${feature.title}</h3>
          <p>${feature.description}</p>
        </article>
      `
    )
    .join("");
};

const renderTestimonials = (testimonials) => {
  testimonialsContainer.innerHTML = testimonials
    .map(
      (testimonial) => `
        <article class="testimonial">
          <p>“${testimonial.quote}”</p>
          <span>${testimonial.name} · ${testimonial.role}</span>
        </article>
      `
    )
    .join("");
};

const loadHighlights = async () => {
  try {
    const response = await fetch("/api/highlights.php");
    const data = await response.json();
    renderStats(data.stats);
    renderFeatures(data.features);
    renderTestimonials(data.testimonials);
  } catch (error) {
    console.error("Failed to load highlights", error);
  }
};

form.addEventListener("submit", async (event) => {
  event.preventDefault();
  formMessage.textContent = "";

  const formData = new FormData(form);
  const payload = Object.fromEntries(formData.entries());

  try {
    const response = await fetch("/api/consultation.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload)
    });

    const data = await response.json();
    if (!response.ok) {
      formMessage.textContent = data.message || "Something went wrong.";
      return;
    }

    formMessage.textContent = data.message;
    form.reset();
  } catch (error) {
    formMessage.textContent = "Unable to submit right now.";
  }
});

document.getElementById("open-consultation").addEventListener("click", () => {
  document.getElementById("contact").scrollIntoView({ behavior: "smooth" });
});

document.getElementById("view-overview").addEventListener("click", () => {
  document.getElementById("security").scrollIntoView({ behavior: "smooth" });
});

loadHighlights();
