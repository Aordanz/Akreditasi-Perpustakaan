CREATE TABLE `dokumen_bukti` (
  `id` int NOT NULL,
  `sub_komponen_id` int NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `tanggal_upload` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `dokumen_bukti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_komponen_id` (`sub_komponen_id`);

ALTER TABLE `dokumen_bukti`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `dokumen_bukti`
  ADD CONSTRAINT `dokumen_bukti_ibfk_1` FOREIGN KEY (`sub_komponen_id`) REFERENCES `sub_komponen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
