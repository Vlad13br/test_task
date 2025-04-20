document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('register-form');

    if (!form) {
        console.error("Форма з id='register-form' не знайдена");
        return;
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        console.log('click')

        const formData = new FormData(form);
        const message = document.getElementById('register-message');
        const submitBtn = document.getElementById('submit-btn');

        submitBtn.disabled = true;
        message.textContent = '';
        clearInputErrors();

        const errors = validateForm(formData);
        if (Object.keys(errors).length > 0) {
            showInputErrors(errors);
            submitBtn.disabled = false;
            return;
        }

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok) {
                message.textContent = 'Registration successful! Redirecting...';
                window.location.href = data.redirect ?? '/';
            } else {
                message.textContent = 'Error: ' + (data.message || 'Validation failed.');
                if (data.errors) {
                    showInputErrors(data.errors);
                }
            }
        } catch (error) {
            message.textContent = 'Unexpected error occurred.';
            console.error(error);
        }

        submitBtn.disabled = false;
    });

    function validateForm(formData) {
        const errors = {};

        if (!formData.get('name')?.trim()) {
            errors.name = ['Name is required.'];
        }
        if (!formData.get('surname')?.trim()) {
            errors.surname = ['Surname is required.'];
        }
        const email = formData.get('email');
        if (!email || !email.match(/^\S+@\S+\.\S+$/)) {
            errors.email = ['Valid email is required.'];
        }
        const phone = formData.get('phone');
        if (!phone || !phone.match(/^[\d+\-().\s]{7,}$/)) {
            errors.phone = ['Phone number is invalid.'];
        }
        if (!formData.get('address')?.trim()) {
            errors.address = ['Address is required.'];
        }
        const password = formData.get('password');
        if (!password || password.length < 8) {
            errors.password = ['Password must be at least 8 characters.'];
        }
        if (password !== formData.get('password_confirmation')) {
            errors.password_confirmation = ['Passwords do not match.'];
        }

        return errors;
    }

    function showInputErrors(errors) {
        for (const [key, messages] of Object.entries(errors)) {
            const errorEl = document.querySelector(`#${key} + .mt-2`);
            if (errorEl) {
                errorEl.textContent = messages.join(', ');
                errorEl.classList.add('text-red-600');
            }
        }
    }

    function clearInputErrors() {
        document.querySelectorAll('.mt-2').forEach(el => {
            el.textContent = '';
            el.classList.remove('text-red-600');
        });
    }
});

