document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('dtExclusive')) {
        new DataTable('#dtExclusive');
        const elements = document.querySelectorAll('.dataTables_length');
        elements.forEach(element => {
            element.classList.add('bs-select');
        });
    }
});

// jQuery Field Masks
$(document).ready(function ($) {
    if (document.getElementsByClassName('cpf')) {
        $(".cpf").mask('000.000.000-00', {reverse: true});
    }
    if (document.getElementsByClassName('rg')) {
        $(".rg").mask('00.000.000-0')
    }
    if (document.getElementsByClassName('telefone')) {
        $(".telefone").mask('(99) 99999-9999');
    }
});


// Disable submit button if required fields are empty
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('formCadastro')) {
        const form = document.getElementById('formCadastro');
        const submitButton = document.getElementById('saveButton');

        form.addEventListener('input', function () {
            const inputs = form.querySelectorAll('input[required]');
            let allValid = true;

            inputs.forEach(input => {
                if (!input.value) {
                    allValid = false;
                }
            });

            submitButton.disabled = !allValid;
        });
    }
});
