document.addEventListener("DOMContentLoaded", () => {
  const nameInput = document.querySelector('input[name="event_name"]');
  if (!nameInput) return;

  // Message area
  let msg = document.getElementById("nameCheckMsg");
  if (!msg) {
    msg = document.createElement("div");
    msg.id = "nameCheckMsg";
    msg.style.marginTop = "6px";
    nameInput.insertAdjacentElement("afterend", msg);
  }

  // Exclude current record (edit)
  const excludeIdEl = document.getElementById("exclude_id");

  let timer = null;

  nameInput.addEventListener("input", () => {
    clearTimeout(timer);
    const value = nameInput.value.trim();

    if (value.length < 3) {
      msg.textContent = "Event name must be at least 3 characters.";
      msg.style.color = "red";
      return;
    }

    timer = setTimeout(() => {
      const excludeId = excludeIdEl ? excludeIdEl.value : "";

      // ✅ FIXED: ABSOLUTE PATH
      fetch(
        `/COURSE_WORK/Event%20Management%20System/ajax/validate.php?event_name=${encodeURIComponent(value)}&exclude_id=${encodeURIComponent(excludeId)}`
      )
        .then((res) => res.json())
        .then((data) => {
          msg.textContent = data.message;
          msg.style.color = data.ok ? "green" : "red";
        })
        .catch(() => {
          msg.textContent = "Validation failed. Try again.";
          msg.style.color = "red";
        });
    }, 300);
  });
});
