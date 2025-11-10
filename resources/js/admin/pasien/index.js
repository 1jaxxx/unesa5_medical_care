
window.showDeleteConfirm = function(event) {
    // 1. Mencegah form dikirim secara instan
    event.preventDefault();

    // 2. Mendapatkan elemen form yang memicu event
    var form = event.target;

    // 3. Menampilkan popup SweetAlert
    Swal.fire({
        title: 'Anda yakin?',
        text: "Data yang sudah dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3B82F6', // Warna biru (Tailwind 'blue-500')
        cancelButtonColor: '#EF4444', // Warna merah (Tailwind 'red-500')
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        // 4. Jika pengguna mengklik "Ya, hapus!"
        if (result.isConfirmed) {
            // Kirim form secara manual
            form.submit();
        }
    });
}
