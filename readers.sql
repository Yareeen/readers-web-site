-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 26 May 2022, 20:15:06
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `readers`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `begeni`
--

DROP TABLE IF EXISTS `begeni`;
CREATE TABLE IF NOT EXISTS `begeni` (
  `uyeKod` int(11) NOT NULL,
  `elestiriKod` int(11) NOT NULL,
  PRIMARY KEY (`uyeKod`,`elestiriKod`),
  KEY `elestiriKod` (`elestiriKod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `begeni`
--

INSERT INTO `begeni` (`uyeKod`, `elestiriKod`) VALUES
(46, 52),
(50, 52);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sehir`
--

DROP TABLE IF EXISTS `sehir`;
CREATE TABLE IF NOT EXISTS `sehir` (
  `plaka` int(11) NOT NULL,
  `sehir` varchar(255) NOT NULL,
  PRIMARY KEY (`plaka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sehir`
--

INSERT INTO `sehir` (`plaka`, `sehir`) VALUES
(1, 'Adana'),
(2, 'Adıyaman'),
(3, 'Afyon'),
(4, 'Ağrı'),
(5, 'Amasya'),
(6, 'Ankara'),
(7, 'Antalya'),
(8, 'Artvin'),
(9, 'Aydın'),
(10, 'Balıkesir'),
(11, 'Bilecik'),
(12, 'Bingöl'),
(13, 'Bitlis'),
(14, 'Bolu'),
(15, 'Burdur'),
(16, 'Bursa'),
(17, 'Çanakkale'),
(18, 'Çankırı'),
(19, 'Çorum'),
(20, 'Denizli'),
(21, 'Diyarbakır'),
(22, 'Edirne'),
(23, 'Elazığ'),
(24, 'Erzincan'),
(25, 'Erzurum'),
(26, 'Eskişehir'),
(27, 'Gaziantep'),
(28, 'Giresun'),
(29, 'Gümüşhane'),
(30, 'Hakkari'),
(31, 'Hatay'),
(32, 'Isparta'),
(33, 'Mersin'),
(34, 'İstanbul'),
(35, 'İzmir'),
(36, 'Kars'),
(37, 'Kastamonu'),
(38, 'Kayseri'),
(39, 'Kırklareli'),
(40, 'Kırşehir'),
(41, 'Kocaeli'),
(42, 'Konya'),
(43, 'Kütahya'),
(44, 'Malatya'),
(45, 'Manisa'),
(46, 'K.Maraş'),
(47, 'Mardin'),
(48, 'Muğla'),
(49, 'Muş'),
(50, 'Nevşehir'),
(51, 'Niğde'),
(52, 'Ordu'),
(53, 'Rize'),
(54, 'Sakarya'),
(55, 'Samsun'),
(56, 'Siirt'),
(57, 'Sinop'),
(58, 'Sivas'),
(59, 'Tekirdağ'),
(60, 'Tokat'),
(61, 'Trabzon'),
(62, 'Tunceli'),
(63, 'Şanlıurfa'),
(64, 'Uşak'),
(65, 'Van'),
(66, 'Yozgat'),
(67, 'Zonguldak'),
(68, 'Aksaray'),
(69, 'Bayburt'),
(70, 'Karaman'),
(71, 'Kırıkkale'),
(72, 'Batman'),
(73, 'Şırnak'),
(74, 'Bartın'),
(75, 'Ardahan'),
(76, 'Iğdır'),
(77, 'Yalova'),
(78, 'Karabük'),
(79, 'Kilis'),
(80, 'Osmaniye'),
(81, 'Düzce');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uye`
--

DROP TABLE IF EXISTS `uye`;
CREATE TABLE IF NOT EXISTS `uye` (
  `Kod` int(11) NOT NULL AUTO_INCREMENT,
  `Ad` varchar(255) NOT NULL,
  `Soyad` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Kullanici_ismi` varchar(255) NOT NULL,
  `Sifre` varchar(255) NOT NULL,
  `profil` varchar(255) DEFAULT NULL,
  `Dogum_tarihi` date DEFAULT NULL,
  `Dogum_yeri` int(11) DEFAULT NULL,
  PRIMARY KEY (`Kod`),
  UNIQUE KEY `Kullanici_ismi` (`Kullanici_ismi`),
  UNIQUE KEY `Mail` (`Mail`),
  KEY `Dogum_yeri` (`Dogum_yeri`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uye`
--

INSERT INTO `uye` (`Kod`, `Ad`, `Soyad`, `Mail`, `Kullanici_ismi`, `Sifre`, `profil`, `Dogum_tarihi`, `Dogum_yeri`) VALUES
(46, 'a’<br>”b', 'a’<br>”b', 'a@gmail.com', 'a’<br>”b', '$2y$10$.g5t4pzxQWVoJaJZs4d.QeAn8tnK6vtgao.1JSOG1Jp21Mke2xwg2', 'profil/pp.jpg', '2022-03-04', 18),
(50, 'yaren', 'can', 'yarencan@gmail.com', 'yareencan', '$2y$10$xglTVltBnFmwTIlNJFVEg.FGfNxlbtsymn9XjPFNJu91pu7g10hDq', NULL, '2022-02-24', 16);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vt_elestiri`
--

DROP TABLE IF EXISTS `vt_elestiri`;
CREATE TABLE IF NOT EXISTS `vt_elestiri` (
  `kod` int(11) NOT NULL AUTO_INCREMENT,
  `baslik` varchar(255) NOT NULL,
  `elestiri` text NOT NULL,
  `dosya` varchar(255) DEFAULT NULL,
  `yuklenme_tarihi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `elestirinin_sahibi` int(11) NOT NULL,
  PRIMARY KEY (`kod`),
  KEY `elestirinin_sahibi` (`elestirinin_sahibi`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `vt_elestiri`
--

INSERT INTO `vt_elestiri` (`kod`, `baslik`, `elestiri`, `dosya`, `yuklenme_tarihi`, `elestirinin_sahibi`) VALUES
(52, 'Albert Camus - Yabancı', 'Camus okumayı ve Camus\'ye dair okumayı sever ve önemserim. Görüşlerini benimsediğim için değil, ondan da öte üzerinde düşünmeyi gerekli gördüğüm varoluşsal konulara dair görüşler sunduğu için. Açıkçası ilgisi olsun veya olmasın -insanlığa dair evrensel kavramları sorgulatması sebebiyle- tüm insanlarca okunmasının elzem olduğunu düşündüğüm yazarlardan biridir Camus.\r\n\r\nKitap hakkındaki düşüncelerime geçmeden önce konu ile alakalı olduğuna inandığım bir noktaya parmak basmak istiyorum: Kanımıza işlemiş olan her konudaki iflah olmaz ikilem yaratma merakımıza. Evrim mi, Tanrı mı; aşk mı, mantık mı; mutluluk mu, para mı; Meursault mu, toplumsal değerler mi? \'Taraf olmayan bertaraf olur.\' felsefesini sakat bir tarafgirlik noktasına vardırıyoruz. Halefini eğrisiyle dahi kabul ettiren, buna mukabil muhalifini doğrusuyla bile reddettiren bir tarafgirlik. Ikilem yaratmaya kendimizi o kadar adamışız ki kutuplaştırdıklarımızın bir arada da yaşayabilecekleri ihtimalini aklımıza getirmiyoruz bile. Halbuki şunu göz ardı ediyoruz ki bu kutuplar içlerinde birbirlerini barındırıyor dahası biri diğerinin var olma sebebi. Nereden geldim bu konuya? Kimi okur başkahramanımız Meursault’yu göklere çıkarıp toplumsal değerleri yerle bir ederken kimi okur da tam aksini yapıyor. Fikrimce dengeli bir sorgulama daha ufuk açıcı olacaktır.\r\n\r\nYazar kitapta; toplumsal değerlerin bireyi baskılaması, tutumların çevre tahakkümüyle şekillenmesi, suç ve ceza kavramlarının belirleyicileri gibi bazı önemli konuları sade bir dil ve sıradışı bir başkahramanla işlemiştir. Vuruculuk dille değil, karakter ve önermelerle sağlanmış. Bu sebeple kitap rahat okunmakla birlikte derin sorgulamaları da beraberinde getirmektedir. Kitabı okurken bir kere daha fark ediyoruz ki İnsanı \'Lanet olası federaller!\' diye isyana sürükleyen, adeta kendine hayat sigortamız rolünü biçen, başlı başına kurumsallaşmış bir lobiden bahsetmek mümkün. Adı da el-alem!', 'kullanicilarin_yukledikleri/1645041569Ekran görüntüsü 2022-01-14 022043.png', '2022-02-16 19:59:29', 50);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorum`
--

DROP TABLE IF EXISTS `yorum`;
CREATE TABLE IF NOT EXISTS `yorum` (
  `uyeKod` int(11) NOT NULL,
  `elestiriKod` int(11) NOT NULL,
  `metin` text NOT NULL,
  `zaman` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uyeKod`,`elestiriKod`,`zaman`),
  KEY `elestiriKod` (`elestiriKod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yorum`
--

INSERT INTO `yorum` (`uyeKod`, `elestiriKod`, `metin`, `zaman`) VALUES
(46, 52, 'harika! başarılarınım devamını dilerim\r\n', '2022-02-16 20:00:40'),
(50, 52, 'harika bir eleştiri ekledim', '2022-02-16 20:00:06');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `begeni`
--
ALTER TABLE `begeni`
  ADD CONSTRAINT `begeni_ibfk_1` FOREIGN KEY (`elestiriKod`) REFERENCES `vt_elestiri` (`kod`),
  ADD CONSTRAINT `begeni_ibfk_2` FOREIGN KEY (`uyeKod`) REFERENCES `uye` (`Kod`);

--
-- Tablo kısıtlamaları `uye`
--
ALTER TABLE `uye`
  ADD CONSTRAINT `uye_ibfk_1` FOREIGN KEY (`Dogum_yeri`) REFERENCES `sehir` (`plaka`);

--
-- Tablo kısıtlamaları `vt_elestiri`
--
ALTER TABLE `vt_elestiri`
  ADD CONSTRAINT `vt_elestiri_ibfk_1` FOREIGN KEY (`elestirinin_sahibi`) REFERENCES `uye` (`Kod`);

--
-- Tablo kısıtlamaları `yorum`
--
ALTER TABLE `yorum`
  ADD CONSTRAINT `yorum_ibfk_1` FOREIGN KEY (`uyeKod`) REFERENCES `uye` (`Kod`),
  ADD CONSTRAINT `yorum_ibfk_2` FOREIGN KEY (`elestiriKod`) REFERENCES `vt_elestiri` (`kod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
