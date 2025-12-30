bin/mongoexport --uri="mongodb://mongo:mongo@localhost:27017/emr_schools" --collection=sekolah --out=sekolah.json
mongodump --uri="mongodb://mongo:mongo@localhost:27017/emr_schools" --out=backup_emr_schools

db.kelas.find()

db.visit.aggregate([
  {
    $lookup: {
      from: "siswa",
      localField: "id_siswa",
      foreignField: "_id",
      as: "data_siswa"
    }
  }
])
