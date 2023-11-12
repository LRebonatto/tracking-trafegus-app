document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('dtExclusive')) {
        new DataTable('#dtExclusive');
        const elements = document.querySelectorAll('.dataTables_length');
        elements.forEach(element => {
            element.classList.add('bs-select');
        });
    }
});
