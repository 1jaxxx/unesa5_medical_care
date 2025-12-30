db.resep.insertMany([
    {
        _id: 1,
        id_visit: 1,
        tanggal_diberikan: ISODate("2025-09-27T05:32:58Z"),
        catatan: "harus abis",
        obat: [
            {
                nama_obat: "Paracetamol",
                jenis_obat: "Tablet",
                stok: 15,
                tanggal_kadaluarsa: ISODate("2032-09-30T00:00:00Z"),
                detail_obat: [
                    {
                        dosis: "Dosis tunggal",
                        jumlah: 3
                    }
                ]
            }
        ]

    },
    {
        _id: 2,
        id_visit: 2,
        tanggal_diberikan: ISODate("2025-09-27T05:32:58Z"),
        catatan: "jgn lupa harus abis",
        obat: [
            {
                nama_obat: "Amoxicillin",
                jenis_obat: "Kapsul",
                stok: 20,
                tanggal_kadaluarsa: ISODate("2031-09-10T00:00:00Z"),
                detail_obat: [
                    {
                        dosis: "Dosis tunggal",
                        jumlah: 3
                    }
                ]
            }
        ]
    },
    {
        _id: 3,
        id_visit: 3,
        tanggal_diberikan: ISODate("2025-09-27T05:32:58Z"),
        catatan: "pokoknya harus abis",
        obat: [
            {
                nama_obat: "Antasida",
                jenis_obat: "Sirup",
                stok: 30,
                tanggal_kadaluarsa: ISODate("2030-09-17T00:00:00Z"),
                detail_obat: [
                    {
                        dosis: "Dosis tunggal",
                        jumlah: 3
                    }
                ]
                
            }
        ]
    },
    {
        _id: 4,
        id_visit: 4,
        tanggal_diberikan: ISODate("2025-09-27T05:32:58Z"),
        catatan: "harus abis pokoknya!!!",
        obat: [
            {
                nama_obat: "Ketoconazole",
                jenis_obat: "Salep",
                stok: 10,
                tanggal_kadaluarsa: ISODate("2025-09-29T00:00:00Z"),
                detail_obat: [
                    {
                        dosis: "Dosis tunggal",
                        jumlah: 3
                    }
                ]
            }
        ]
    },
    {
        _id: 5,
        id_visit: 5,
        tanggal_diberikan: ISODate("2025-09-27T05:32:58Z"),
        catatan: "klo ga abis anu",
        obat: [
            {
                nama_obat: "Salbutamol",
                jenis_obat: "Inhaler",
                stok: 12,
                tanggal_kadaluarsa: ISODate("2034-09-29T00:00:00Z"),
                detail_obat: [
                    {
                        dosis: "Dosis tunggal",
                        jumlah: 3
                    }
                ]
            }
        ]
    }
])
