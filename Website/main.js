function setupPasswordVisibilityToggles() {
  const icons = document.querySelectorAll('.visibility-toggle');

  icons.forEach(icon => {
    icon.addEventListener('click', function () {
      const input = this.previousElementSibling;

      if (input.type === "password") {
        input.type = "text";
        this.classList.remove('bxs-low-vision');
        this.classList.add('bx-show');
      } else {
        input.type = "password";
        this.classList.remove('bx-show');
        this.classList.add('bxs-low-vision');
      }
    });
  });
}

// Call the function once the DOM is fully loaded
document.addEventListener('DOMContentLoaded', setupPasswordVisibilityToggles);



