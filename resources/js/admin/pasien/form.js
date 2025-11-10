document.addEventListener('DOMContentLoaded', function() {
    const typePasienSelect = document.getElementById('type_pasien');
    const nimField = document.querySelector('.nim-field');
    const nidnField = document.querySelector('.nidn-field');
    const bagianField = document.querySelector('.bagian-field');
    const prodiField = document.querySelector('.prodi-field');
    const prodiSelect = document.getElementById('id_prodi');

    function updateFormFields() {
        const selectedValue = typePasienSelect.value;

        nimField.classList.add('hidden');
        nidnField.classList.add('hidden');
        bagianField.classList.add('hidden');
        prodiField.classList.add('hidden');
        prodiSelect.disabled = true;

        if (selectedValue === 'mahasiswa') {
            nimField.classList.remove('hidden');
            prodiField.classList.remove('hidden');
            prodiSelect.disabled = false;
        } else if (selectedValue === 'dosen') {
            nidnField.classList.remove('hidden');
        } else if (selectedValue === 'staff') {
            bagianField.classList.remove('hidden');
        }
    }

    // Call updateFormFields on initial load
    updateFormFields();

    // Add event listener for changes
    typePasienSelect.addEventListener('change', updateFormFields);
});
