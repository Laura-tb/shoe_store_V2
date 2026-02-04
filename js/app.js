(function () {
  const params = new URLSearchParams(location.search);

  // --- función toast ---
  const showToast = (type, text) => {
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = text;
    document.body.appendChild(toast);

    // animación de entrada
    requestAnimationFrame(() => toast.classList.add('show'));

    // desaparece después de 3 segundos
    setTimeout(() => {
      toast.classList.remove('show');
      setTimeout(() => toast.remove(), 400);
    }, 3000);
  };

  // Mensajes globales
  if (params.get('registered'))
    showToast('success', 'Creado correctamente.');
  if (params.get('ok') === '1' && location.pathname.endsWith('login.php')) {
    showToast('success', 'Has iniciado sesión correctamente.');
  }

  // Mensajes de error
  const e = params.get('e');
  if (e) {
    if (e === 'dup') {
      showToast('warning', 'Ese email ya existe.');
    } else if (e === 'val') {
      showToast('error', 'Datos no válidos.');
    } else if (e === 'cred') {
      showToast('error', 'Credenciales incorrectas.');
    } else if (e === 'pass') {
      showToast(
        'error',
        'La contraseña debe tener mínimo 8 caracteres, mayúscula, minúscula, número y carácter especial.'
      );
    } else if (e === 'product_used') {
      showToast('error', 'Este producto no se puede borrar, se está utilizando en un pedido.');
    } else {
      showToast('error', 'Ha ocurrido un error.');
    }
  }
})();

//ABRIR/CERRAR MENU BURGER
document.addEventListener('DOMContentLoaded', function () {
  const toggle = document.querySelector('.nav-toggle');
  const nav = document.querySelector('.main-nav');
  if (!toggle || !nav) return;

  toggle.addEventListener('click', () => {
    const isOpen = nav.classList.toggle('open');
    toggle.classList.toggle('open', isOpen);
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });
});

// VALIDACIÓN DE FORMULARIOS
const form =
  document.getElementById("register-form") ||
  document.getElementById("login-form") ||
  document.getElementById("user-form") ||
  document.getElementById("product-form");

if (form) {
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    if (validate(form)) form.submit();
  });
}

function validate(form) {

  let ok = true;

  // Limpia errores anteriores
  form.querySelectorAll(".error").forEach(e => e.textContent = "");

  // Obtiene campos SOLO si existen en el formulario
  const emailInput = form.querySelector("#email");
  const passInput = form.querySelector("#password");
  const nameInput = form.querySelector("#name") || form.querySelector("#name_product");
  const priceInput = form.querySelector("#price_product");
  const stockInput = form.querySelector("#stock_product");


  const regexEmail = /^\S+@\S+\.\S+$/;
  const regexPass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

  // ---------- EMAIL ----------
  if (emailInput && !regexEmail.test(emailInput.value.trim())) {
    form.querySelector("#emailError").textContent = "Email no válido";
    ok = false;
  }

  // ---------- NOMBRE ----------
  if (nameInput && nameInput.value.trim() === "") {
    form.querySelector("#nameError").textContent = "Campo obligatorio";
    ok = false;
  }

  // ---------- PASSWORD ----------

  if (passInput && !regexPass.test(passInput.value.trim())) {
    form.querySelector("#passwordError").textContent =
      "La contraseña debe tener mínimo 8 caracteres, mayúscula, minúscula, número y carácter especial.";
    ok = false;
  }

  // --- CAMPOS PRODUCTO ---
  if (priceInput && priceInput.value.trim() === "") {
    form.querySelector("#priceError").textContent = "Campo obligatorio";
    ok = false;
  }

  if (stockInput && stockInput.value.trim() === "") {
    form.querySelector("#stockError").textContent = "Campo obligatorio";
    ok = false;
  }

  return ok;

}