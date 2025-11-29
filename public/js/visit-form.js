/**
 * Initialize Select2 for searchable dropdowns
 */
$(document).ready(function() {
    // Initialize Select2 untuk dropdown Pasien
    $('#pasien').select2({
        placeholder: "Ketik untuk mencari pasien...",
        allowClear: true,
        width: '100%',
        language: {
            noResults: function() {
                return "Pasien tidak ditemukan";
            },
            searching: function() {
                return "Mencari...";
            }
        }
    });

    // Initialize Select2 untuk dropdown Dokter
    $('#dokter_id').select2({
        placeholder: "Ketik untuk mencari dokter...",
        allowClear: true,
        width: '100%',
        language: {
            noResults: function() {
                return "Dokter tidak ditemukan";
            },
            searching: function() {
                return "Mencari...";
            }
        }
    });
});
