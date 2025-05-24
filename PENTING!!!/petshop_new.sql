-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 01:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petshop_new`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `editBarangJual` (`idb` INT(20), `naBar` VARCHAR(255), `hargasatu` DECIMAL(10,2), `stokk` INT(11), `idkategori` INT(10), `desk` VARCHAR(255), `gbr` VARCHAR(255))   BEGIN
        UPDATE barang
        SET
            Nama_Barang = naBar,
            Harga_Satuan = hargasatu,
            Stok_Jual = stokk,
            ID_Kategori = idkategori,
            deskripsi = desk,
            gambar = gbr
            WHERE ID_Barang = idb;
            END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `editKasir` (`idp` INT(20), `nakun` VARCHAR(255), `napeng` VARCHAR(255), `nohp` VARCHAR(255), `emaill` VARCHAR(255))   BEGIN
        UPDATE users
        SET
            Nama_Akun = nakun,
            Nama_Pengguna = napeng,
            No_Telp = nohp,
            email = emaill
            WHERE ID_Pengguna = idp;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `perbaruistok` (`barangid` INT, `quantity` INT)   BEGIN
        DECLARE stokkurang int;
        DECLARE stokk int;
        SELECT Stok_Jual INTO stokk FROM barang WHERE ID_Barang = barangid;
        SET stokkurang = stokk - quantity;
        UPDATE barang
        SET Stok_Jual = stokkurang
        WHERE ID_Barang = barangid;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `stokjualbalikkasir` (`barangid` INT, `quantity` INT)   BEGIN
        UPDATE barang
        SET Stok_Jual = quantity
        WHERE ID_Barang = barangid;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahBarangJual` (`naBar` VARCHAR(255), `hargasatu` DECIMAL(10,2), `stokk` INT(11), `idkategori` INT(10), `desk` VARCHAR(255), `gbr` VARCHAR(255))   BEGIN
        INSERT INTO barang(Nama_Barang, Harga_Satuan, Status, Stok_Jual, ID_Kategori, deskripsi, gambar) VALUES (naBar, hargasatu, "jual", stokk, idkategori, desk, gbr);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahformpenitipan` (`trskid` INT, `penggunaid` INT, `napengguna` VARCHAR(255), `Perann` ENUM("Admin","Pelanggan","Kasir"), `nahewan` VARCHAR(255), `tgl` DATE, `harilama` INT, `layananjenis` ENUM("penitipan","grooming","penitipan_dan_grooming"), `satuanharga` DECIMAL(10,2), `foto` VARCHAR(255))   BEGIN
        DECLARE penitipan_harga decimal (10,2);
        DECLARE total_penitipan decimal(10,2);

        IF layananjenis = "penitipan" then
            set penitipan_harga = 50000;
        elseif layananjenis = "grooming" then
            set penitipan_harga = 10000;
        elseif layananjenis = "penitipan_dan_grooming" then
            set penitipan_harga = 150000;
        END IF;

        SET total_penitipan = total_harga_penitipan(penitipan_harga, harilama);

        INSERT INTO penitipan_hewan(ID_Transaksi, ID_Pengguna, Nama_Pengguna, Peran, Nama_Hewan, Tanggal, Lama_Hari, Jenis_Layanan, Harga, gambar)
        VALUES(trskid, penggunaid, napengguna, Perann, nahewan, tgl, harilama, layananjenis, total_penitipan, foto);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahformpenitipankasir` (`trskid` INT, `penggunaid` INT, `napengguna` VARCHAR(255), `Perann` ENUM("Admin","Pelanggan","Kasir"), `nahewan` VARCHAR(255), `tgl` DATE, `harilama` INT, `layananjenis` ENUM("penitipan","grooming","penitipan_dan_grooming"), `satuanharga` DECIMAL(10,2), `foto` VARCHAR(255), `statuss` ENUM("Keranjang","Menunggu_Pembayaran","Berhasil","Gagal","Offline","Selesai"))   BEGIN
        DECLARE penitipan_harga decimal (10,2);
        DECLARE total_penitipan decimal(10,2);

        IF layananjenis = "penitipan" then
            set penitipan_harga = 50000;
        elseif layananjenis = "grooming" then
            set penitipan_harga = 10000;
        elseif layananjenis = "penitipan_dan_grooming" then
            set penitipan_harga = 150000;
        END IF;

        SET total_penitipan = total_harga_penitipan(penitipan_harga, harilama);

        INSERT INTO penitipan_hewan(ID_Transaksi, ID_Pengguna, Nama_Pengguna, Peran, Nama_Hewan, Tanggal, Lama_Hari, Jenis_Layanan, Harga, gambar, status)
        VALUES(trskid, penggunaid, napengguna, Perann, nahewan, tgl, harilama, layananjenis, total_penitipan, foto, statuss);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahHewanAdopsi` (`naBar` VARCHAR(255), `hargasatu` DECIMAL(10,2), `stokk` INT(11), `idkategori` INT(10), `desk` VARCHAR(255), `gbr` VARCHAR(255))   BEGIN
        INSERT INTO barang(Nama_Barang, Harga_Satuan, Status, Stok_Jual, ID_Kategori, deskripsi, gambar) VALUES (naBar, hargasatu, "adopsi", stokk, idkategori, desk, gbr);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahKasir` (`nakun` VARCHAR(255), `napeng` VARCHAR(255), `kasan` VARCHAR(255), `nohp` VARCHAR(255), `emaill` VARCHAR(255))   BEGIN
        INSERT INTO users(Nama_Akun, Nama_Pengguna, password, No_Telp, email, Peran) VALUES (nakun, napeng, kasan, nohp, emaill, "Kasir");
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahkeranjangbarang` (`transaksid` INT, `barangid` INT, `penggunaid` INT, `kategoriid` INT, `nabar` VARCHAR(255), `napengguna` VARCHAR(255), `Perann` ENUM("Admin","Pelanggan","Kasir"), `nakategori` VARCHAR(255), `satuanharga` DECIMAL(10,2), `desk` VARCHAR(255), `stokdipesan` INT, `foto` VARCHAR(255), `statuss` ENUM("Keranjang","Menunggu_Pembayaran","Berhasil","Gagal","Offline","Selesai"))   BEGIN
        INSERT INTO keranjang(ID_Transaksi, ID_Barang, ID_Pengguna, ID_Kategori, Barang, Pengguna, Peran, Nama_Kategori, Harga_Satuan, deskripsi, jumlah_stok_dipesan, gambar, status)
        VALUES (transaksid, barangid, penggunaid, kategoriid, nabar, napengguna, Perann, nakategori, satuanharga, desk, stokdipesan, foto, statuss);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahkeranjangbarangdantransaksi` (`transaksiid` INT, `barangid` INT, `penggunaid` INT, `kategoriid` INT, `nabar` VARCHAR(255), `napengguna` VARCHAR(255), `Perann` ENUM("Admin","Pelanggan","Kasir"), `nakategori` VARCHAR(255), `satuanharga` DECIMAL(10,2), `desk` VARCHAR(255), `stokdipesan` INT, `foto` VARCHAR(255), `statuss` ENUM("Menunggu_Pembayaran","Berhasil","Gagal","Offline","Selesai"))   BEGIN
        INSERT INTO barangjual(ID_Transaksi, ID_Barang, ID_Pengguna, ID_Kategori, Barang, Pengguna, Peran, Nama_Kategori, Harga_Satuan, deskripsi, jumlah_stok_dipesan, gambar, status)
        VALUES (transaksiid, barangid, penggunaid, kategoriid, nabar, napengguna, Perann, nakategori, satuanharga, desk, stokdipesan, foto, statuss);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahStokMasuk` (`idbar` INT(20), `stokmasuk` INT(11))   BEGIN
        INSERT INTO stok_masuk(ID_Barang, Stok_Masuk, created_at) VALUES (idbar, stokmasuk, NOW());
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `terimasemuakeranjang` (`penggunaid` INT, `statuss` ENUM("Keranjang","Menunggu_Pembayaran","Berhasil","Gagal","Offline","Selesai"))   BEGIN
        UPDATE keranjang
        SET status = statuss
        WHERE ID_Pengguna = penggunaid AND status = "Keranjang";
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `terimasemuakeranjangbarangjual` (`penggunaid` INT, `statuss` ENUM("Keranjang","Menunggu_Pembayaran","Berhasil","Gagal","Offline","Selesai"))   BEGIN
        UPDATE barangjual
        SET status = statuss
        WHERE ID_Pengguna = penggunaid;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `terimasemuakeranjangoffline` (`penggunaid` INT, `statuss` ENUM("Keranjang","Menunggu_Pembayaran","Berhasil","Gagal","Offline","Selesai"))   BEGIN
        UPDATE keranjang
        SET status = statuss
        WHERE ID_Pengguna = penggunaid;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatestatus` (`barangjualid` INT, `statuss` ENUM("Keranjang","Menunggu_Pembayaran","Berhasil","Gagal","Offline","Selesai"))   BEGIN
        UPDATE barangjual
        SET status = statuss
        WHERE ID_barangjual = barangjualid;

        UPDATE keranjang
        SET status = statuss
        WHERE ID_Keranjang = barangjualid;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatestatusidtransaksiterimasemua` (`transaksiid` INT, `statuss` ENUM("Keranjang","Menunggu_Pembayaran","Berhasil","Gagal","Offline","Selesai"))   BEGIN
        UPDATE barangjual
        SET status = statuss
        WHERE ID_Transaksi = transaksiid;

        UPDATE keranjang
        SET status = statuss
        WHERE ID_Transaksi = transaksiid;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatestatuskeranjang` (`keranjangid` INT, `statuss` ENUM("Keranjang","Menunggu_Pembayaran","Berhasil","Gagal","Offline","Selesai"))   BEGIN
        UPDATE keranjang
        SET status = statuss
        WHERE ID_Keranjang = keranjangid;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatestatuspenitipan` (`penitipanid` INT, `statuss` ENUM("Keranjang","Menunggu_Pembayaran","Berhasil","Gagal","Offline","Selesai"))   BEGIN
        UPDATE penitipan_hewan
        SET status = statuss
        WHERE ID_Penitipan = penitipanid;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatestatusselesaibarang` (`barangjualid` INT, `statuss` ENUM("Keranjang","Menunggu_Pembayaran","Berhasil","Gagal","Offline","Selesai"))   BEGIN
        UPDATE barangjual
        SET status = statuss
        WHERE ID_barangjual = barangjualid;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatestatusselesaipenitipan` (`penitipanid` INT, `statuss` ENUM("Keranjang","Menunggu_Pembayaran","Berhasil","Gagal","Offline","Selesai"))   BEGIN
        UPDATE penitipan_hewan
        SET status = statuss
        WHERE ID_Penitipan = penitipanid;
        END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `pecah_stok` (`jumlahstokmasuk` INT(11), `pecah_stok_barang` INT) RETURNS INT(11)  BEGIN
        DECLARE stok_barang INT;
        SET stok_barang = jumlahstokmasuk * pecah_stok_barang;
        RETURN stok_barang;
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `total_harga_penitipan` (`penitipan_hargaa` DECIMAL(10,2), `harilamaa` INT) RETURNS DECIMAL(10,2)  BEGIN
        DECLARE totalhargapenitipan DECIMAL(10,2);
        SET totalhargapenitipan = penitipan_hargaa * harilamaa;
        RETURN totalhargapenitipan;
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `total_harga_satuan_barang` (`satuanhargaa` DECIMAL(10,2), `stokdipesann` INT) RETURNS DECIMAL(10,2)  BEGIN
        DECLARE totalhargasatuanbarang DECIMAL(10,2);
        SET totalhargasatuanbarang = satuanhargaa * stokdipesann;
        RETURN totalhargasatuanbarang;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `ID_Barang` int(10) UNSIGNED NOT NULL,
  `Nama_Barang` varchar(255) NOT NULL,
  `Harga_Satuan` decimal(10,2) NOT NULL,
  `Status` enum('jual','adopsi') NOT NULL,
  `Stok_Jual` int(11) NOT NULL,
  `ID_Kategori` int(10) UNSIGNED NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `Dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`ID_Barang`, `Nama_Barang`, `Harga_Satuan`, `Status`, `Stok_Jual`, `ID_Kategori`, `deskripsi`, `gambar`, `Dibuat`) VALUES
(1, 'wiskas', 10000.00, 'jual', 30, 1, ' Makanan Kucing Standar ', 'wiskas.png', '2024-12-23 11:59:41'),
(2, 'Royale canin', 30000.00, 'jual', 30, 1, ' Makanan kucing Mewah ', 'royaleCanin.jpg', '2024-12-23 11:59:41'),
(3, 'wiskas junior', 5000.00, 'jual', 50, 1, ' Makanan untuk anak kucing standar ', 'wiskasSachet.jpg', '2024-12-23 11:59:41'),
(4, 'Hamster Natural Food', 10000.00, 'jual', 50, 1, ' Makanan hamster ', 'HamsterNat.jpg', '2024-12-23 11:59:41'),
(5, 'Bolt', 80000.00, 'jual', 30, 1, ' Makanan anjing ', 'boltKarung.jpg', '2024-12-23 11:59:41'),
(6, 'miltih', 10000.00, 'jual', 40, 1, ' Makanan Burung ', 'miltih.jpg', '2024-12-23 11:59:41'),
(7, 'kucing', 450000.00, 'adopsi', 1, 4, ' Hewan kucing ', 'kucingS.jpg', '2024-12-23 11:59:41'),
(8, 'kelinci', 250000.00, 'adopsi', 1, 4, ' Hewan Kelinci ', 'kelinci1.jpg', '2024-12-23 11:59:41'),
(9, 'hamster', 10000.00, 'adopsi', 1, 4, ' Hewan Hamster', 'hamster.jpg', '2024-12-23 11:59:41'),
(10, 'Cupcake', 950000.00, 'adopsi', 1, 4, ' Hewan anjing', 'cupcake.jpg', '2024-12-23 11:59:41'),
(11, 'Beo', 990000.00, 'adopsi', 1, 4, ' Hewan Burung', 'beo.jpg', '2024-12-23 11:59:41'),
(12, 'sisir hewan', 10000.00, 'jual', 10, 3, ' Sisir untuk hewan ', 'sisirHewan.jpg', '2024-12-23 11:59:41'),
(13, 'tongkat bulu', 15000.00, 'jual', 10, 3, ' mainan untuk kucing ', 'tongkatBulu.jpg', '2024-12-23 11:59:41'),
(14, 'kandang', 120000.00, 'jual', 5, 3, ' Sangkar Hewan ', 'kandangHewn.jpg', '2024-12-23 11:59:41'),
(15, 'Shampo kucing', 10000.00, 'jual', 40, 3, ' Shampo untuk kucing ', 'shampoKucing.jpg', '2024-12-23 11:59:41'),
(16, 'Kalung kucing', 7000.00, 'jual', 20, 3, ' Kalung kucing ', 'kalungKucing.jpg', '2024-12-23 11:59:41'),
(17, 'rantai', 13000.00, 'jual', 10, 3, ' rantai untuk hewan ', 'rantaiAnj.jpg', '2024-12-23 11:59:41');

--
-- Triggers `barang`
--
DELIMITER $$
CREATE TRIGGER `after_barang_delete` AFTER DELETE ON `barang` FOR EACH ROW BEGIN
            INSERT INTO log_barang (ID_Barang, Action, Nama_Barang_Old, Harga_Satuan_Old, Status_Old, deskripsi_Old, gambar_Old, Diperbarui)
            VALUES (OLD.ID_Barang, "DELETE", OLD.Nama_Barang, OLD.Harga_Satuan, OLD.Status, OLD.deskripsi, OLD.gambar, CURRENT_TIMESTAMP);
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_barang_insert` AFTER INSERT ON `barang` FOR EACH ROW BEGIN
            INSERT INTO log_barang (ID_Barang, Action, Nama_Barang_New, Harga_Satuan_New, Status_New, deskripsi_New, gambar_New, Diperbarui)
            VALUES (NEW.ID_Barang, "INSERT", NEW.Nama_Barang, NEW.Harga_Satuan, NEW.Status, NEW.deskripsi, NEW.gambar, CURRENT_TIMESTAMP);
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_barang_update` AFTER UPDATE ON `barang` FOR EACH ROW BEGIN
            INSERT INTO log_barang (ID_Barang, Action, Nama_Barang_Old, Nama_Barang_New,
                                    Harga_Satuan_Old, Harga_Satuan_New, Status_Old, Status_New, deskripsi_Old, deskripsi_New,
                                    gambar_Old, gambar_New, Diperbarui)
            VALUES (OLD.ID_Barang, "UPDATE", OLD.Nama_Barang, NEW.Nama_Barang,
                    OLD.Harga_Satuan, NEW.Harga_Satuan, OLD.Status, NEW.Status, OLD.deskripsi, NEW.deskripsi,
                    OLD.gambar, NEW.gambar, CURRENT_TIMESTAMP);
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_stok_update` AFTER UPDATE ON `barang` FOR EACH ROW BEGIN
            IF OLD.Stok_Jual != NEW.Stok_Jual THEN
                INSERT INTO log_stok (ID_Barang, Stok_Jual_Old, Stok_Jual_New)
                VALUES (NEW.ID_Barang, OLD.Stok_Jual, NEW.Stok_Jual);
            END IF;
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barangjual`
--

CREATE TABLE `barangjual` (
  `ID_barangjual` int(10) UNSIGNED NOT NULL,
  `ID_Transaksi` int(10) UNSIGNED NOT NULL,
  `ID_Barang` int(10) UNSIGNED NOT NULL,
  `ID_Pengguna` int(10) UNSIGNED NOT NULL,
  `ID_Kategori` int(10) UNSIGNED NOT NULL,
  `Barang` varchar(255) NOT NULL,
  `Pengguna` varchar(255) NOT NULL,
  `Peran` enum('Admin','Pelanggan','Kasir') NOT NULL DEFAULT 'Pelanggan',
  `Nama_Kategori` varchar(255) NOT NULL,
  `Harga_Satuan` decimal(10,2) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `Dibeli` timestamp NOT NULL DEFAULT current_timestamp(),
  `jumlah_stok_dipesan` int(10) UNSIGNED NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` enum('Keranjang_Barang','Menunggu_Pembayaran','Berhasil','Gagal','Offline','Selesai') NOT NULL DEFAULT 'Menunggu_Pembayaran'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Triggers `barangjual`
--
DELIMITER $$
CREATE TRIGGER `after_barangjual_delete` AFTER DELETE ON `barangjual` FOR EACH ROW BEGIN
                INSERT INTO log_barangjual (ID_barangjual, ID_Transaksi, Barang, Pengguna, action, Harga_Satuan_Old, jumlah_stok_dipesan_Old, created_at, updated_at)
                VALUES (OLD.ID_barangjual, OLD.ID_Transaksi, OLD.Barang, OLD.Pengguna, "DELETE", OLD.Harga_Satuan, OLD.jumlah_stok_dipesan, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
            END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_barangjual_insert` AFTER INSERT ON `barangjual` FOR EACH ROW BEGIN
            INSERT INTO log_barangjual (ID_barangjual, ID_Transaksi, Barang, Pengguna, action, Harga_Satuan_New, jumlah_stok_dipesan_New, created_at, updated_at)
            VALUES (NEW.ID_barangjual, NEW.ID_Transaksi, NEW.Barang, NEW.Pengguna, "INSERT", NEW.Harga_Satuan, NEW.jumlah_stok_dipesan, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_barangjual_update` AFTER UPDATE ON `barangjual` FOR EACH ROW BEGIN
            INSERT INTO log_barangjual (ID_barangjual, ID_Transaksi, Barang, Pengguna, action, Harga_Satuan_Old, Harga_Satuan_New, jumlah_stok_dipesan_Old, jumlah_stok_dipesan_New, created_at, updated_at)
            VALUES (OLD.ID_barangjual, OLD.ID_Transaksi, OLD.Barang, OLD.Pengguna, "UPDATE", OLD.Harga_Satuan, NEW.Harga_Satuan, OLD.jumlah_stok_dipesan, NEW.jumlah_stok_dipesan, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `ID_Kategori` int(10) UNSIGNED NOT NULL,
  `Nama_Kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`ID_Kategori`, `Nama_Kategori`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', NULL, NULL),
(2, 'Minuman', NULL, NULL),
(3, 'Alat', NULL, NULL),
(4, 'Hewan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `ID_Keranjang` int(10) UNSIGNED NOT NULL,
  `ID_Transaksi` int(10) UNSIGNED DEFAULT NULL,
  `ID_Barang` int(10) UNSIGNED NOT NULL,
  `ID_Pengguna` int(10) UNSIGNED NOT NULL,
  `ID_Kategori` int(10) UNSIGNED NOT NULL,
  `Barang` varchar(255) NOT NULL,
  `Pengguna` varchar(255) NOT NULL,
  `Peran` enum('Admin','Pelanggan','Kasir') NOT NULL DEFAULT 'Pelanggan',
  `Nama_Kategori` varchar(255) NOT NULL,
  `Harga_Satuan` decimal(10,2) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `Dibeli` timestamp NOT NULL DEFAULT current_timestamp(),
  `jumlah_stok_dipesan` int(10) UNSIGNED NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` enum('Keranjang','Menunggu_Pembayaran','Berhasil','Gagal','Offline','Selesai') NOT NULL DEFAULT 'Keranjang'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_barang`
--

CREATE TABLE `log_barang` (
  `ID_Barang` int(10) UNSIGNED DEFAULT NULL,
  `Action` varchar(255) DEFAULT NULL,
  `Nama_Barang_Old` varchar(255) DEFAULT NULL,
  `Nama_Barang_New` varchar(255) DEFAULT NULL,
  `Harga_Satuan_Old` decimal(10,2) DEFAULT NULL,
  `Harga_Satuan_New` decimal(10,2) DEFAULT NULL,
  `Status_Old` enum('jual','adopsi') DEFAULT NULL,
  `Status_New` enum('jual','adopsi') DEFAULT NULL,
  `deskripsi_Old` varchar(255) DEFAULT NULL,
  `deskripsi_New` varchar(255) DEFAULT NULL,
  `gambar_Old` varchar(255) DEFAULT NULL,
  `gambar_New` varchar(255) DEFAULT NULL,
  `Diperbarui` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_barang`
--

INSERT INTO `log_barang` (`ID_Barang`, `Action`, `Nama_Barang_Old`, `Nama_Barang_New`, `Harga_Satuan_Old`, `Harga_Satuan_New`, `Status_Old`, `Status_New`, `deskripsi_Old`, `deskripsi_New`, `gambar_Old`, `gambar_New`, `Diperbarui`) VALUES
(1, 'INSERT', NULL, 'wiskas', NULL, 10000.00, NULL, 'jual', NULL, ' Makanan Kucing Standar ', NULL, 'wiskas.png', '2024-12-23 11:59:41'),
(2, 'INSERT', NULL, 'Royale canin', NULL, 30000.00, NULL, 'jual', NULL, ' Makanan kucing Mewah ', NULL, 'royaleCanin.jpg', '2024-12-23 11:59:41'),
(3, 'INSERT', NULL, 'wiskas junior', NULL, 5000.00, NULL, 'jual', NULL, ' Makanan untuk anak kucing standar ', NULL, 'wiskasSachet.jpg', '2024-12-23 11:59:41'),
(4, 'INSERT', NULL, 'Hamster Natural Food', NULL, 10000.00, NULL, 'jual', NULL, ' Makanan hamster ', NULL, 'HamsterNat.jpg', '2024-12-23 11:59:41'),
(5, 'INSERT', NULL, 'Bolt', NULL, 80000.00, NULL, 'jual', NULL, ' Makanan anjing ', NULL, 'boltKarung.jpg', '2024-12-23 11:59:41'),
(6, 'INSERT', NULL, 'miltih', NULL, 10000.00, NULL, 'jual', NULL, ' Makanan Burung ', NULL, 'miltih.jpg', '2024-12-23 11:59:41'),
(7, 'INSERT', NULL, 'kucing', NULL, 450000.00, NULL, 'adopsi', NULL, ' Hewan kucing ', NULL, 'kucingS.jpg', '2024-12-23 11:59:41'),
(8, 'INSERT', NULL, 'kelinci', NULL, 250000.00, NULL, 'adopsi', NULL, ' Hewan Kelinci ', NULL, 'kelinci1.jpg', '2024-12-23 11:59:41'),
(9, 'INSERT', NULL, 'hamster', NULL, 10000.00, NULL, 'adopsi', NULL, ' Hewan Hamster', NULL, 'hamster.jpg', '2024-12-23 11:59:41'),
(10, 'INSERT', NULL, 'Cupcake', NULL, 950000.00, NULL, 'adopsi', NULL, ' Hewan anjing', NULL, 'cupcake.jpg', '2024-12-23 11:59:41'),
(11, 'INSERT', NULL, 'Beo', NULL, 990000.00, NULL, 'adopsi', NULL, ' Hewan Burung', NULL, 'beo.jpg', '2024-12-23 11:59:41'),
(12, 'INSERT', NULL, 'sisir hewan', NULL, 10000.00, NULL, 'jual', NULL, ' Sisir untuk hewan ', NULL, 'sisirHewan.jpg', '2024-12-23 11:59:41'),
(13, 'INSERT', NULL, 'tongkat bulu', NULL, 15000.00, NULL, 'jual', NULL, ' mainan untuk kucing ', NULL, 'tongkatBulu.jpg', '2024-12-23 11:59:41'),
(14, 'INSERT', NULL, 'kandang', NULL, 120000.00, NULL, 'jual', NULL, ' Sangkar Hewan ', NULL, 'kandangHewn.jpg', '2024-12-23 11:59:41'),
(15, 'INSERT', NULL, 'Shampo kucing', NULL, 10000.00, NULL, 'jual', NULL, ' Shampo untuk kucing ', NULL, 'shampoKucing.jpg', '2024-12-23 11:59:41'),
(16, 'INSERT', NULL, 'Kalung kucing', NULL, 7000.00, NULL, 'jual', NULL, ' Kalung kucing ', NULL, 'kalungKucing.jpg', '2024-12-23 11:59:41'),
(17, 'INSERT', NULL, 'rantai', NULL, 13000.00, NULL, 'jual', NULL, ' rantai untuk hewan ', NULL, 'rantaiAnj.jpg', '2024-12-23 11:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `log_barangjual`
--

CREATE TABLE `log_barangjual` (
  `ID_barangjual` int(10) UNSIGNED DEFAULT NULL,
  `ID_Transaksi` int(10) UNSIGNED DEFAULT NULL,
  `Barang` varchar(255) DEFAULT NULL,
  `Pengguna` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `Harga_Satuan_Old` decimal(10,2) DEFAULT NULL,
  `Harga_Satuan_New` decimal(10,2) DEFAULT NULL,
  `jumlah_stok_dipesan_Old` int(11) DEFAULT NULL,
  `jumlah_stok_dipesan_New` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_pengguna`
--

CREATE TABLE `log_pengguna` (
  `ID_Pengguna` int(10) UNSIGNED NOT NULL,
  `Action` varchar(255) NOT NULL,
  `Nama_Akun_Old` varchar(255) DEFAULT NULL,
  `Nama_Akun_New` varchar(255) DEFAULT NULL,
  `Nama_Pengguna_Old` varchar(255) DEFAULT NULL,
  `Nama_Pengguna_New` varchar(255) DEFAULT NULL,
  `No_Telp_Old` varchar(255) DEFAULT NULL,
  `No_Telp_New` varchar(255) DEFAULT NULL,
  `Email_Old` varchar(255) DEFAULT NULL,
  `Email_New` varchar(255) DEFAULT NULL,
  `Peran_Old` varchar(255) DEFAULT NULL,
  `Peran_New` varchar(255) DEFAULT NULL,
  `Diperbarui` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_pengguna`
--

INSERT INTO `log_pengguna` (`ID_Pengguna`, `Action`, `Nama_Akun_Old`, `Nama_Akun_New`, `Nama_Pengguna_Old`, `Nama_Pengguna_New`, `No_Telp_Old`, `No_Telp_New`, `Email_Old`, `Email_New`, `Peran_Old`, `Peran_New`, `Diperbarui`) VALUES
(1, 'INSERT', NULL, 'admin', NULL, 'Admin User', NULL, '123456789', NULL, 'admin@example.com', NULL, 'Admin', '2024-12-23 11:59:41'),
(2, 'INSERT', NULL, 'customer', NULL, 'Customer User', NULL, '987654321', NULL, 'customer@example.com', NULL, 'Pelanggan', '2024-12-23 11:59:41'),
(3, 'INSERT', NULL, 'kasir', NULL, 'kasir User', NULL, '1111111111', NULL, 'kasir@example.com', NULL, 'Kasir', '2024-12-23 11:59:41'),
(4, 'INSERT', NULL, 'owner', NULL, 'owner', NULL, '082387776991', NULL, 'owner@gmail.com', NULL, 'Admin', '2024-12-23 11:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `log_penitipan_hewan`
--

CREATE TABLE `log_penitipan_hewan` (
  `ID_Penitipan` int(10) UNSIGNED DEFAULT NULL,
  `ID_Pengguna` int(10) UNSIGNED DEFAULT NULL,
  `Action` varchar(255) DEFAULT NULL,
  `Nama_Hewan_Old` varchar(255) DEFAULT NULL,
  `Nama_Hewan_New` varchar(255) DEFAULT NULL,
  `Lama_Hari_Old` int(11) DEFAULT NULL,
  `Lama_Hari_New` int(11) DEFAULT NULL,
  `Jenis_Layanan_Old` enum('penitipan','grooming','penitipan_dan_grooming') DEFAULT NULL,
  `Jenis_Layanan_New` enum('penitipan','grooming','penitipan_dan_grooming') DEFAULT NULL,
  `Harga_Old` decimal(10,2) DEFAULT NULL,
  `Harga_New` decimal(10,2) DEFAULT NULL,
  `Diperbarui` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_stok`
--

CREATE TABLE `log_stok` (
  `ID_Barang` int(10) UNSIGNED DEFAULT NULL,
  `Stok_Jual_Old` int(10) UNSIGNED DEFAULT NULL,
  `Stok_Jual_New` int(10) UNSIGNED DEFAULT NULL,
  `Diperbarui` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_stok_masuk`
--

CREATE TABLE `log_stok_masuk` (
  `ID_StokMasuk` int(10) UNSIGNED DEFAULT NULL,
  `ID_Barang` int(10) UNSIGNED DEFAULT NULL,
  `Stok_Masuk_Old` int(10) UNSIGNED DEFAULT NULL,
  `Stok_Masuk_New` int(10) UNSIGNED DEFAULT NULL,
  `Diperbarui` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_transaksi`
--

CREATE TABLE `log_transaksi` (
  `ID_Transaksi` int(10) UNSIGNED DEFAULT NULL,
  `Action` varchar(255) DEFAULT NULL,
  `Diperbarui` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_04_080358_create_transaksi_table', 1),
(6, '2023_12_04_080502_create_kategori_table', 1),
(7, '2023_12_04_080525_create_barang_table', 1),
(8, '2023_12_04_080629_create_stok_masuk_table', 1),
(9, '2023_12_04_080718_create_penitipan_hewan_table', 1),
(10, '2023_12_04_080746_create_keranjang_table', 1),
(11, '2023_12_04_080811_create_barangjual_table', 1),
(12, '2023_12_04_080857_create_log_transaksi_table', 1),
(13, '2023_12_04_081021_create_log_stok_table', 1),
(14, '2023_12_04_081046_create_log_stok_masuk_table', 1),
(15, '2023_12_04_081116_create_log_pengguna_table', 1),
(16, '2023_12_04_081214_create_log_barang_table', 1),
(17, '2023_12_04_081239_create_log_penitipan_table', 1),
(18, '2023_12_04_081342_create_log_barangjual_table', 1),
(19, '2023_12_04_082329_trigger_users', 1),
(20, '2023_12_04_082351_trigger_barang', 1),
(21, '2023_12_04_082408_trigger_stok', 1),
(22, '2023_12_04_082612_trigger_penitipan_hewan', 1),
(23, '2023_12_04_082720_trigger_transaksi', 1),
(24, '2023_12_04_082756_trigger_barang_jual', 1),
(25, '2023_12_04_082817_list_procedure', 1),
(26, '2023_12_04_082832_list_view', 1),
(27, '2023_12_05_065621_function', 1),
(28, '2023_12_18_134830_privilages', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penitipan_hewan`
--

CREATE TABLE `penitipan_hewan` (
  `ID_Penitipan` int(10) UNSIGNED NOT NULL,
  `ID_Transaksi` int(10) UNSIGNED NOT NULL,
  `ID_Pengguna` int(10) UNSIGNED NOT NULL,
  `Nama_Pengguna` varchar(255) NOT NULL,
  `Peran` enum('Admin','Pelanggan','Kasir') NOT NULL,
  `Nama_Hewan` varchar(255) NOT NULL,
  `Tanggal` date NOT NULL,
  `Lama_Hari` int(11) NOT NULL DEFAULT 1,
  `Jenis_Layanan` enum('penitipan','grooming','penitipan_dan_grooming') NOT NULL,
  `Harga` decimal(10,2) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` enum('Keranjang_Penitipan','Menunggu_Pembayaran','Berhasil','Gagal','Offline','Selesai') NOT NULL DEFAULT 'Menunggu_Pembayaran',
  `Dipesan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Triggers `penitipan_hewan`
--
DELIMITER $$
CREATE TRIGGER `after_Penitipan_Hewan_delete` AFTER DELETE ON `penitipan_hewan` FOR EACH ROW BEGIN
            INSERT INTO log_penitipan_hewan (ID_Penitipan, ID_Pengguna, Action, Nama_Hewan_Old, Lama_Hari_Old, Jenis_Layanan_Old, Harga_Old, Diperbarui)
            VALUES (OLD.ID_Penitipan, OLD.ID_Pengguna, "DELETE", OLD.Nama_Hewan, OLD.Lama_Hari, OLD.Jenis_Layanan, OLD.Harga, CURRENT_TIMESTAMP);
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_Penitipan_hewan_insert` AFTER INSERT ON `penitipan_hewan` FOR EACH ROW BEGIN
            INSERT INTO log_penitipan_hewan(ID_Penitipan,ID_Pengguna, Action, Nama_Hewan_New, Lama_Hari_New, Jenis_Layanan_New, Harga_New, Diperbarui)
            VALUES (NEW.ID_Penitipan, NEW.ID_Pengguna, "INSERT", NEW.Nama_Hewan, NEW.Lama_Hari, NEW.Jenis_Layanan, NEW.Harga, CURRENT_TIMESTAMP);
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_Penitipan_hewan_update` AFTER UPDATE ON `penitipan_hewan` FOR EACH ROW BEGIN
            INSERT INTO log_penitipan_hewan(ID_Penitipan, ID_Pengguna, Action, Nama_Hewan_Old, Nama_Hewan_New, Lama_Hari_Old, Lama_Hari_New, Jenis_Layanan_Old, 
                Jenis_Layanan_New, Harga_Old, Harga_New, Diperbarui)
            VALUES (OLD.ID_Penitipan, OLD.ID_Pengguna, "UPDATE", OLD.Nama_Hewan, NEW.Nama_Hewan, OLD.Lama_Hari, NEW.Lama_Hari, 
                OLD.Jenis_Layanan, NEW.Jenis_Layanan, OLD.Harga, NEW.Harga, CURRENT_TIMESTAMP);
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `ID_StokMasuk` int(10) UNSIGNED NOT NULL,
  `ID_Barang` int(10) UNSIGNED NOT NULL,
  `Stok_Masuk` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Triggers `stok_masuk`
--
DELIMITER $$
CREATE TRIGGER `after_stok_masuk_delete` AFTER DELETE ON `stok_masuk` FOR EACH ROW BEGIN
            INSERT INTO log_stok_masuk (ID_StokMasuk, ID_Barang, Stok_Masuk_Old, Stok_Masuk_New)
            VALUES (OLD.ID_StokMasuk, OLD.ID_Barang, OLD.Stok_Masuk, 0);
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_stok_masuk_insert` AFTER INSERT ON `stok_masuk` FOR EACH ROW BEGIN
            UPDATE barang
            SET Stok_Jual = Stok_Jual + NEW.Stok_Masuk
            WHERE ID_Barang = NEW.ID_Barang;

            INSERT INTO log_stok_masuk (ID_StokMasuk, ID_Barang, Stok_Masuk_New)
            VALUES (NEW.ID_StokMasuk, NEW.ID_Barang, NEW.Stok_Masuk);
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_stok_masuk_update` AFTER UPDATE ON `stok_masuk` FOR EACH ROW BEGIN
            IF OLD.Stok_Masuk != NEW.Stok_Masuk THEN
                INSERT INTO log_stok_masuk (ID_StokMasuk, ID_Barang, Stok_Masuk_Old, Stok_Masuk_New)
                VALUES (OLD.ID_StokMasuk, OLD.ID_Barang, OLD.Stok_Masuk, NEW.Stok_Masuk);
            END IF;
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_Transaksi` int(10) UNSIGNED NOT NULL,
  `Jenis` enum('Barang','Penitipan') NOT NULL,
  `Tanggal_Transaksi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `after_transaksi_delete` AFTER DELETE ON `transaksi` FOR EACH ROW BEGIN
            INSERT INTO log_transaksi (ID_Transaksi, Action, Diperbarui)
            VALUES (OLD.ID_Transaksi, "DELETE", CURRENT_TIMESTAMP);
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_transaksi_insert` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
            INSERT INTO log_transaksi (ID_Transaksi, Action, Diperbarui)
            VALUES (NEW.ID_Transaksi, "INSERT", CURRENT_TIMESTAMP);
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_transaksi_update` AFTER UPDATE ON `transaksi` FOR EACH ROW BEGIN
            INSERT INTO log_transaksi (ID_Transaksi, Action, Diperbarui)
            VALUES (OLD.ID_Transaksi, "UPDATE", CURRENT_TIMESTAMP);
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID_Pengguna` int(10) UNSIGNED NOT NULL,
  `Nama_Akun` varchar(255) NOT NULL,
  `Nama_Pengguna` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `No_Telp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `Peran` enum('Admin','Pelanggan','Kasir') NOT NULL DEFAULT 'Pelanggan',
  `Dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_Pengguna`, `Nama_Akun`, `Nama_Pengguna`, `password`, `No_Telp`, `email`, `email_verified_at`, `reset_token`, `Peran`, `Dibuat`) VALUES
(1, 'admin', 'Admin User', '$2y$10$QmS5nzPJ.gbIlqsSxImDaOyptnSYOkh2KqAGnV8S7bFRWOOToVuIe', '123456789', 'admin@example.com', '2024-12-23 11:59:41', NULL, 'Admin', '2024-12-23 04:59:41'),
(2, 'customer', 'Customer User', '$2y$10$pYt7ZGTSjudATMyrv1qDdeXSb8UT/gp3WZCTiDw..WpllgfrhMk0K', '987654321', 'customer@example.com', '2024-12-23 11:59:41', NULL, 'Pelanggan', '2024-12-23 04:59:41'),
(3, 'kasir', 'kasir User', '$2y$10$YdJdIFgA2ZhPdLGooNlBJuXAgPZvCPiGL4QsySH3gj9oVs7rx4Eh2', '1111111111', 'kasir@example.com', '2024-12-23 11:59:41', NULL, 'Kasir', '2024-12-23 04:59:41'),
(4, 'owner', 'owner', '$2y$10$sMen2N8hg2xSdnk6YjzEHeljZrhyD8JXDUFZYr2X3vK/FRactr.d6', '082387776991', 'owner@gmail.com', '2024-12-23 11:59:41', NULL, 'Admin', '2024-12-23 04:59:41');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after_pengguna_delete` AFTER DELETE ON `users` FOR EACH ROW BEGIN
            INSERT INTO log_pengguna (ID_Pengguna, Action, Nama_Akun_Old, Nama_Pengguna_Old, No_Telp_Old, Email_Old, Peran_Old, Diperbarui)
            VALUES (OLD.ID_Pengguna, "DELETE", OLD.Nama_Akun, OLD.Nama_Pengguna, OLD.No_Telp, OLD.Email, OLD.Peran, CURRENT_TIMESTAMP);
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_pengguna_insert` AFTER INSERT ON `users` FOR EACH ROW BEGIN
            INSERT INTO log_pengguna (ID_Pengguna, Action, Nama_Akun_New, Nama_Pengguna_New, No_Telp_New, Email_New, Peran_New, Diperbarui)
            VALUES (NEW.ID_Pengguna, "INSERT", NEW.Nama_Akun, NEW.Nama_Pengguna, NEW.No_Telp, NEW.Email, NEW.Peran, CURRENT_TIMESTAMP);
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_pengguna_update` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
            INSERT INTO log_pengguna (ID_Pengguna, Action, Nama_Akun_Old, Nama_Pengguna_Old, No_Telp_Old, Email_Old, Peran_Old,
                                    Nama_Akun_New, Nama_Pengguna_New, No_Telp_New, Email_New, Peran_New, Diperbarui)
            VALUES (OLD.ID_Pengguna, "UPDATE", OLD.Nama_Akun, OLD.Nama_Pengguna, OLD.No_Telp, OLD.Email, OLD.Peran,
                    NEW.Nama_Akun, NEW.Nama_Pengguna, NEW.No_Telp, NEW.Email, NEW.Peran, CURRENT_TIMESTAMP);
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_barang_masuk`
-- (See below for the actual view)
--
CREATE TABLE `view_barang_masuk` (
`ID_StokMasuk` int(10) unsigned
,`ID_Barang` int(10) unsigned
,`Nama_Barang` varchar(255)
,`Stok_Masuk` int(10) unsigned
,`gambar` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_detail_barang`
-- (See below for the actual view)
--
CREATE TABLE `view_detail_barang` (
`ID_Barang` int(10) unsigned
,`Nama_Barang` varchar(255)
,`Harga_Satuan` decimal(10,2)
,`Status` enum('jual','adopsi')
,`Stok_Jual` int(11)
,`gambar` varchar(255)
,`Nama_Kategori` varchar(255)
,`deskripsi` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_detail_hewanadopsi`
-- (See below for the actual view)
--
CREATE TABLE `view_detail_hewanadopsi` (
`ID_Barang` int(10) unsigned
,`Nama_Hewan` varchar(255)
,`Harga_Satuan` decimal(10,2)
,`Status` enum('jual','adopsi')
,`Stok_Jual` int(11)
,`Nama_Kategori` varchar(255)
,`deskripsi` varchar(255)
,`gambar` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_detail_penitipan`
-- (See below for the actual view)
--
CREATE TABLE `view_detail_penitipan` (
`ID_Penitipan` int(10) unsigned
,`Nama_Pengguna` varchar(255)
,`Nama_Hewan` varchar(255)
,`Lama_Hari` int(11)
,`Jenis_Layanan` enum('penitipan','grooming','penitipan_dan_grooming')
,`Harga` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_log_barang`
-- (See below for the actual view)
--
CREATE TABLE `view_log_barang` (
`ID_Barang` int(10) unsigned
,`Aksi` varchar(255)
,`Nama_Barang_SblmAksi` varchar(255)
,`Nama_SsdhAksi` varchar(255)
,`HargaSblmnya` decimal(10,2)
,`HargaSsdhnya` decimal(10,2)
,`Status_SblmAksi` enum('jual','adopsi')
,`Status_SsdhAksi` enum('jual','adopsi')
,`TglAksi` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_log_pengguna`
-- (See below for the actual view)
--
CREATE TABLE `view_log_pengguna` (
`ID_Pengguna` int(10) unsigned
,`Aksi` varchar(255)
,`Nama_Akun_SblmAksi` varchar(255)
,`Nama_Akun_SsdhAksi` varchar(255)
,`Nama_Pengguna_SblmAksi` varchar(255)
,`Nama_Pengguna_SsdhAksi` varchar(255)
,`No_Telp_SblmAksi` varchar(255)
,`No_Telp_SsdhAksi` varchar(255)
,`Email_SblmAksi` varchar(255)
,`Email_SsdhAksi` varchar(255)
,`Peran_SblmAksi` varchar(255)
,`Peran_SsdhAksi` varchar(255)
,`Tgl_Aksi` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_log_penitipan_hewan`
-- (See below for the actual view)
--
CREATE TABLE `view_log_penitipan_hewan` (
`ID_Penitipan` int(10) unsigned
,`Nama_Pengguna` varchar(255)
,`Action` varchar(255)
,`Nama_Hewan_SblmAksi` varchar(255)
,`Nama_Hewan_SsdhAksi` varchar(255)
,`Lama_Hari_SblmAksi` int(11)
,`Lama_Hari_SsdhAksi` int(11)
,`Jenis_Layanan_SblmAksi` enum('penitipan','grooming','penitipan_dan_grooming')
,`Jenis_Layanan_SsdhAksi` enum('penitipan','grooming','penitipan_dan_grooming')
,`Harga_SblmAksi` decimal(10,2)
,`Harga_SsdhAksi` decimal(10,2)
,`Tgl_Aksi` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_log_stok`
-- (See below for the actual view)
--
CREATE TABLE `view_log_stok` (
`Nama_Barang` varchar(255)
,`Stok_jual_SblmAksi` int(10) unsigned
,`Stok_jual_SsdhAksi` int(10) unsigned
,`Tgl_Aksi` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_log_stok_masuk`
-- (See below for the actual view)
--
CREATE TABLE `view_log_stok_masuk` (
`ID_StokMasuk` int(10) unsigned
,`Nama_Barang` varchar(255)
,`Stok_Masuk_SblmAksi` int(10) unsigned
,`Stok_Masuk_SsdhAksi` int(10) unsigned
,`Tgl_Aksi` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pencatatan_barang_masuk`
-- (See below for the actual view)
--
CREATE TABLE `view_pencatatan_barang_masuk` (
`ID_StokMasuk` int(10) unsigned
,`Nama_Barang` varchar(255)
,`Harga_Satuan` decimal(10,2)
,`Stok_Masuk` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Structure for view `view_barang_masuk`
--
DROP TABLE IF EXISTS `view_barang_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_barang_masuk`  AS SELECT `a`.`ID_StokMasuk` AS `ID_StokMasuk`, `a`.`ID_Barang` AS `ID_Barang`, `b`.`Nama_Barang` AS `Nama_Barang`, `a`.`Stok_Masuk` AS `Stok_Masuk`, `b`.`gambar` AS `gambar` FROM (`stok_masuk` `a` join `barang` `b` on(`a`.`ID_Barang` = `b`.`ID_Barang`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_detail_barang`
--
DROP TABLE IF EXISTS `view_detail_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detail_barang`  AS SELECT `a`.`ID_Barang` AS `ID_Barang`, `a`.`Nama_Barang` AS `Nama_Barang`, `a`.`Harga_Satuan` AS `Harga_Satuan`, `a`.`Status` AS `Status`, `a`.`Stok_Jual` AS `Stok_Jual`, `a`.`gambar` AS `gambar`, `b`.`Nama_Kategori` AS `Nama_Kategori`, `a`.`deskripsi` AS `deskripsi` FROM (`barang` `a` join `kategori` `b` on(`a`.`ID_Kategori` = `b`.`ID_Kategori`)) WHERE `a`.`Status` = 'jual' ;

-- --------------------------------------------------------

--
-- Structure for view `view_detail_hewanadopsi`
--
DROP TABLE IF EXISTS `view_detail_hewanadopsi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detail_hewanadopsi`  AS SELECT `a`.`ID_Barang` AS `ID_Barang`, `a`.`Nama_Barang` AS `Nama_Hewan`, `a`.`Harga_Satuan` AS `Harga_Satuan`, `a`.`Status` AS `Status`, `a`.`Stok_Jual` AS `Stok_Jual`, `b`.`Nama_Kategori` AS `Nama_Kategori`, `a`.`deskripsi` AS `deskripsi`, `a`.`gambar` AS `gambar` FROM (`barang` `a` join `kategori` `b` on(`a`.`ID_Kategori` = `b`.`ID_Kategori`)) WHERE `a`.`Status` = 'adopsi' ;

-- --------------------------------------------------------

--
-- Structure for view `view_detail_penitipan`
--
DROP TABLE IF EXISTS `view_detail_penitipan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detail_penitipan`  AS SELECT `a`.`ID_Penitipan` AS `ID_Penitipan`, `b`.`Nama_Pengguna` AS `Nama_Pengguna`, `a`.`Nama_Hewan` AS `Nama_Hewan`, `a`.`Lama_Hari` AS `Lama_Hari`, `a`.`Jenis_Layanan` AS `Jenis_Layanan`, `a`.`Harga` AS `Harga` FROM (`penitipan_hewan` `a` join `users` `b` on(`a`.`ID_Pengguna` = `b`.`ID_Pengguna`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_log_barang`
--
DROP TABLE IF EXISTS `view_log_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_log_barang`  AS SELECT `log_barang`.`ID_Barang` AS `ID_Barang`, `log_barang`.`Action` AS `Aksi`, `log_barang`.`Nama_Barang_Old` AS `Nama_Barang_SblmAksi`, `log_barang`.`Nama_Barang_New` AS `Nama_SsdhAksi`, `log_barang`.`Harga_Satuan_Old` AS `HargaSblmnya`, `log_barang`.`Harga_Satuan_New` AS `HargaSsdhnya`, `log_barang`.`Status_Old` AS `Status_SblmAksi`, `log_barang`.`Status_New` AS `Status_SsdhAksi`, `log_barang`.`Diperbarui` AS `TglAksi` FROM `log_barang` ;

-- --------------------------------------------------------

--
-- Structure for view `view_log_pengguna`
--
DROP TABLE IF EXISTS `view_log_pengguna`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_log_pengguna`  AS SELECT `log_pengguna`.`ID_Pengguna` AS `ID_Pengguna`, `log_pengguna`.`Action` AS `Aksi`, `log_pengguna`.`Nama_Akun_Old` AS `Nama_Akun_SblmAksi`, `log_pengguna`.`Nama_Akun_New` AS `Nama_Akun_SsdhAksi`, `log_pengguna`.`Nama_Pengguna_Old` AS `Nama_Pengguna_SblmAksi`, `log_pengguna`.`Nama_Pengguna_New` AS `Nama_Pengguna_SsdhAksi`, `log_pengguna`.`No_Telp_Old` AS `No_Telp_SblmAksi`, `log_pengguna`.`No_Telp_New` AS `No_Telp_SsdhAksi`, `log_pengguna`.`Email_Old` AS `Email_SblmAksi`, `log_pengguna`.`Email_New` AS `Email_SsdhAksi`, `log_pengguna`.`Peran_Old` AS `Peran_SblmAksi`, `log_pengguna`.`Peran_New` AS `Peran_SsdhAksi`, `log_pengguna`.`Diperbarui` AS `Tgl_Aksi` FROM `log_pengguna` ;

-- --------------------------------------------------------

--
-- Structure for view `view_log_penitipan_hewan`
--
DROP TABLE IF EXISTS `view_log_penitipan_hewan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_log_penitipan_hewan`  AS SELECT `a`.`ID_Penitipan` AS `ID_Penitipan`, `b`.`Nama_Pengguna` AS `Nama_Pengguna`, `a`.`Action` AS `Action`, `a`.`Nama_Hewan_Old` AS `Nama_Hewan_SblmAksi`, `a`.`Nama_Hewan_New` AS `Nama_Hewan_SsdhAksi`, `a`.`Lama_Hari_Old` AS `Lama_Hari_SblmAksi`, `a`.`Lama_Hari_New` AS `Lama_Hari_SsdhAksi`, `a`.`Jenis_Layanan_Old` AS `Jenis_Layanan_SblmAksi`, `a`.`Jenis_Layanan_New` AS `Jenis_Layanan_SsdhAksi`, `a`.`Harga_Old` AS `Harga_SblmAksi`, `a`.`Harga_New` AS `Harga_SsdhAksi`, `a`.`Diperbarui` AS `Tgl_Aksi` FROM (`log_penitipan_hewan` `a` join `users` `b` on(`a`.`ID_Pengguna` = `b`.`ID_Pengguna`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_log_stok`
--
DROP TABLE IF EXISTS `view_log_stok`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_log_stok`  AS SELECT `b`.`Nama_Barang` AS `Nama_Barang`, `a`.`Stok_Jual_Old` AS `Stok_jual_SblmAksi`, `a`.`Stok_Jual_New` AS `Stok_jual_SsdhAksi`, `a`.`Diperbarui` AS `Tgl_Aksi` FROM (`log_stok` `a` join `barang` `b` on(`a`.`ID_Barang` = `b`.`ID_Barang`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_log_stok_masuk`
--
DROP TABLE IF EXISTS `view_log_stok_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_log_stok_masuk`  AS SELECT `a`.`ID_StokMasuk` AS `ID_StokMasuk`, `c`.`Nama_Barang` AS `Nama_Barang`, `a`.`Stok_Masuk_Old` AS `Stok_Masuk_SblmAksi`, `a`.`Stok_Masuk_New` AS `Stok_Masuk_SsdhAksi`, `a`.`Diperbarui` AS `Tgl_Aksi` FROM (`log_stok_masuk` `a` join `barang` `c` on(`a`.`ID_Barang` = `c`.`ID_Barang`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_pencatatan_barang_masuk`
--
DROP TABLE IF EXISTS `view_pencatatan_barang_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pencatatan_barang_masuk`  AS SELECT `a`.`ID_StokMasuk` AS `ID_StokMasuk`, `b`.`Nama_Barang` AS `Nama_Barang`, `b`.`Harga_Satuan` AS `Harga_Satuan`, `a`.`Stok_Masuk` AS `Stok_Masuk` FROM (`stok_masuk` `a` join `barang` `b` on(`a`.`ID_Barang` = `b`.`ID_Barang`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_Barang`),
  ADD KEY `barang_id_kategori_foreign` (`ID_Kategori`);

--
-- Indexes for table `barangjual`
--
ALTER TABLE `barangjual`
  ADD PRIMARY KEY (`ID_barangjual`),
  ADD KEY `barangjual_id_transaksi_foreign` (`ID_Transaksi`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ID_Kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`ID_Keranjang`),
  ADD KEY `keranjang_id_transaksi_foreign` (`ID_Transaksi`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penitipan_hewan`
--
ALTER TABLE `penitipan_hewan`
  ADD PRIMARY KEY (`ID_Penitipan`),
  ADD KEY `penitipan_hewan_id_transaksi_foreign` (`ID_Transaksi`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`ID_StokMasuk`),
  ADD KEY `stok_masuk_id_barang_foreign` (`ID_Barang`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_Transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_Pengguna`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `ID_Barang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `barangjual`
--
ALTER TABLE `barangjual`
  MODIFY `ID_barangjual` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `ID_Kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `ID_Keranjang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `penitipan_hewan`
--
ALTER TABLE `penitipan_hewan`
  MODIFY `ID_Penitipan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `ID_StokMasuk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID_Transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID_Pengguna` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_id_kategori_foreign` FOREIGN KEY (`ID_Kategori`) REFERENCES `kategori` (`ID_Kategori`) ON DELETE CASCADE;

--
-- Constraints for table `barangjual`
--
ALTER TABLE `barangjual`
  ADD CONSTRAINT `barangjual_id_transaksi_foreign` FOREIGN KEY (`ID_Transaksi`) REFERENCES `transaksi` (`ID_Transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_id_transaksi_foreign` FOREIGN KEY (`ID_Transaksi`) REFERENCES `transaksi` (`ID_Transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penitipan_hewan`
--
ALTER TABLE `penitipan_hewan`
  ADD CONSTRAINT `penitipan_hewan_id_transaksi_foreign` FOREIGN KEY (`ID_Transaksi`) REFERENCES `transaksi` (`ID_Transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD CONSTRAINT `stok_masuk_id_barang_foreign` FOREIGN KEY (`ID_Barang`) REFERENCES `barang` (`ID_Barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
