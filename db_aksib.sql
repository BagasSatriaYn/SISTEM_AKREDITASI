CREATE TABLE `m_level` (
  `id_level` INT AUTO_INCREMENT,
  `level_kode` VARCHAR(255),
  `level_nama` VARCHAR(255),
  PRIMARY KEY (`id_level`)
);
  
CREATE TABLE `m_user` (
  `id_user` INT AUTO_INCREMENT,
  `id_level` INT,
  `username` VARCHAR(255),
  `name` VARCHAR(255),
  `password` VARCHAR(255),
  PRIMARY KEY (`id_user`),
  FOREIGN KEY (`id_level`) REFERENCES `m_level` (`id_level`)
);

CREATE TABLE `t_komentar` (
  `id_komentar` INT AUTO_INCREMENT,
  `komentar` TEXT,
  PRIMARY KEY (`id_komentar`)
);

CREATE TABLE `t_penetapan` (
  `id_penetapan` INT AUTO_INCREMENT,
  `penetapan` TEXT,
  `pendukung` VARCHAR(255),
  PRIMARY KEY (`id_penetapan`)
);

CREATE TABLE `t_pelaksanaan` (
  `id_pelaksanaan` INT AUTO_INCREMENT,
  `penetapan` TEXT,
  `pendukung` VARCHAR(255),
  PRIMARY KEY (`id_pelaksanaan`)
);

CREATE TABLE `t_evaluasi` (
  `id_evaluasi` INT AUTO_INCREMENT,
  `penetapan` TEXT,
  `pendukung` VARCHAR(255),
  PRIMARY KEY (`id_evaluasi`)
);

CREATE TABLE `t_peningkatan` (
  `id_peningkatan` INT AUTO_INCREMENT,
  `penetapan` TEXT,
  `pendukung` VARCHAR(255),
  PRIMARY KEY (`id_peningkatan`)
);

CREATE TABLE `t_pengendalian` (
  `id_pengendalian` INT AUTO_INCREMENT,
  `penetapan` TEXT,
  `pendukung` VARCHAR(255),
  PRIMARY KEY (`id_pengendalian`)
);

CREATE TABLE `t_kriteria` (
  `id_kriteria` INT AUTO_INCREMENT,
  `nama_kriteria` VARCHAR(255),
  PRIMARY KEY (`id_kriteria`)
);

CREATE TABLE `m_detail_kriteria` (
  `id_detail_kriteria` INT AUTO_INCREMENT,
  `id_penetapan` INT,
  `id_pelaksanaan` INT,
  `id_evaluasi` INT,
  `id_pengendalian` INT,
  `id_peningkatan` INT,
  `id_kriteria` INT,
  `id_komentar` INT,
  `status_validator` ENUM('acc', 'gak', 'rev'),
  `status_selesai` ENUM('save', 'submit'),
  PRIMARY KEY (`id_detail_kriteria`),
  FOREIGN KEY (`id_penetapan`) REFERENCES `t_penetapan` (`id_penetapan`),
  FOREIGN KEY (`id_pelaksanaan`) REFERENCES `t_pelaksanaan` (`id_pelaksanaan`),
  FOREIGN KEY (`id_evaluasi`) REFERENCES `t_evaluasi` (`id_evaluasi`),
  FOREIGN KEY (`id_pengendalian`) REFERENCES `t_pengendalian` (`id_pengendalian`),
  FOREIGN KEY (`id_peningkatan`) REFERENCES `t_peningkatan` (`id_peningkatan`),
  FOREIGN KEY (`id_kriteria`) REFERENCES `t_kriteria` (`id_kriteria`),
  FOREIGN KEY (`id_komentar`) REFERENCES `t_komentar` (`id_komentar`)
);
