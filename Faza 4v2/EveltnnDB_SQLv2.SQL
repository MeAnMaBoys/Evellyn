

CREATE DATABASE IF NOT EXISTS `EvelynnDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `EvelynnDB`;

-- Create tables section -------------------------------------------------

-- Table Korisnik

CREATE TABLE `Korisnik`
(
  `Korisnicko_Ime` Varchar(20) NOT NULL,
  `Sifra` Varchar(20) NOT NULL,
  `Email` Varchar(255) NOT NULL,
  `ID_K` Int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID_K`),
  UNIQUE `ID_K` (`ID_K`)
)
;

ALTER TABLE `Korisnik` ADD UNIQUE `KorisnickoIme` (`Korisnicko_Ime`)
;

ALTER TABLE `Korisnik` ADD UNIQUE `Email` (`Email`)
;

-- Table Izvodjac

CREATE TABLE `Izvodjac`
(
  `Ime` Varchar(20) NOT NULL,
  `Prezime` Varchar(20) NOT NULL,
  `Telefon` Varchar(20) NOT NULL,
  `Prosek_Ocena` Double DEFAULT 0,
  `Broj_Ocena` Int DEFAULT 0,
  `Tipovi` Varchar(100),
  `ID_K` Int NOT NULL
)
;

ALTER TABLE `Izvodjac` ADD PRIMARY KEY (`ID_K`)
;

-- Table Organizator

CREATE TABLE `Organizator`
(
  `Ime` Varchar(20) NOT NULL,
  `Prezime` Varchar(20) NOT NULL,
  `Telefon` Varchar(20) NOT NULL,
  `Prosek_Ocena` Double DEFAULT 0,
  `Broj_Ocena` Int DEFAULT 0,
  `ID_K` Int NOT NULL,
  `Status` Varchar(20)
)
;

ALTER TABLE `Organizator` ADD PRIMARY KEY (`ID_K`)
;

-- Table Dogadjaj

CREATE TABLE `Dogadjaj`
(
  `ID_Dog` Int NOT NULL AUTO_INCREMENT,
  `Datum_Vreme` Timestamp NOT NULL,
  `Tip` Varchar(20) NOT NULL,
  `Lokacija` Varchar(50) NOT NULL,
  `Organizator` Int NOT NULL,
  `Status` Varchar(20),
  `Naziv` Varchar(40) NOT NULL,
  `Opis` Varchar(100),
  PRIMARY KEY (`ID_Dog`)
)
;

CREATE INDEX `IX_Relationship5` ON `Dogadjaj` (`Organizator`)
;

-- Table Nastupa

CREATE TABLE `Nastupa`
(
  `ID_Dog` Int NOT NULL,
  `Izvodjac` Int NOT NULL
)
;

ALTER TABLE `Nastupa` ADD PRIMARY KEY (`ID_Dog`, `Izvodjac`)
;

-- Table Konkurs

CREATE TABLE `Konkurs`
(
  `Rok_Za_Prijavu` Timestamp NOT NULL,
  `ID_Dog` Int NOT NULL
)
;

ALTER TABLE `Konkurs` ADD PRIMARY KEY (`ID_Dog`)
;

-- Table Ocene_Izvodjaca

CREATE TABLE `Ocene_Izvodjaca`
(
  `Ocena` Int NOT NULL,
  `Izvodjac` Int NOT NULL,
  `Posmatrac` Int NOT NULL
)
;

ALTER TABLE `Ocene_Izvodjaca` ADD PRIMARY KEY (`Izvodjac`, `Posmatrac`)
;

-- Table Posmatrac

CREATE TABLE `Posmatrac`
(
  `ID_K` Int NOT NULL
)
;

ALTER TABLE `Posmatrac` ADD PRIMARY KEY (`ID_K`)
;

-- Table Ocene_Dogadjaja

CREATE TABLE `Ocene_Dogadjaja`
(
  `Ocena` Int NOT NULL,
  `ID_Dog` Int NOT NULL,
  `Posmatrac` Int NOT NULL,
  `Organizator` Int(11) NOT NULL
)
;

ALTER TABLE `Ocene_Dogadjaja` ADD PRIMARY KEY (`ID_Dog`, `Posmatrac`)
;

-- Table Pretplate_Na_Izvodjace

CREATE TABLE `Pretplate_Na_Izvodjace`
(
  `Izvodjac` Int NOT NULL,
  `Posmatrac` Int NOT NULL
)
;

ALTER TABLE `Pretplate_Na_Izvodjace` ADD PRIMARY KEY (`Izvodjac`, `Posmatrac`)
;

-- Table Pretplate_Na_Organizatora

CREATE TABLE `Pretplate_Na_Organizatora`
(
  `Organizator` Int NOT NULL,
  `Posmatrac` Int NOT NULL
)
;

ALTER TABLE `Pretplate_Na_Organizatora` ADD PRIMARY KEY (`Organizator`, `Posmatrac`)
;

-- Table Static

CREATE TABLE `Static`
(
  `Fajl_Sa_Portfoliom` Varchar(100) NOT NULL,
  `Fajl_Sa_Datotekama` Varchar(100) NOT NULL,
  `ID_S` Int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID_S`),
  UNIQUE `ID_S` (`ID_S`)
)
;

-- Table Prijave_Na_Konkurs

CREATE TABLE `Prijave_Na_Konkurs`
(
  `ID_K` Int NOT NULL,
  `ID_Dog` Int NOT NULL
)
;

ALTER TABLE `Prijave_Na_Konkurs` ADD PRIMARY KEY (`ID_K`, `ID_Dog`)
;

-- Table Zahtev_Za_Nastupanje

CREATE TABLE `Zahtev_Za_Nastupanje`
(
  `ID_Dog` Int NOT NULL,
  `ID_K` Int NOT NULL
)
;

ALTER TABLE `Zahtev_Za_Nastupanje` ADD PRIMARY KEY (`ID_Dog`, `ID_K`)
;

-- Table Verifikacija

CREATE TABLE `Verifikacija`
(
  `id` Int(6) NOT NULL AUTO_INCREMENT,
  `kod` Int(5) NOT NULL,
  `email` Varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
)
;

-- Create foreign keys (relationships) section -------------------------------------------------

ALTER TABLE `Izvodjac` ADD CONSTRAINT `Relationship1` FOREIGN KEY (`ID_K`) REFERENCES `Korisnik` (`ID_K`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Organizator` ADD CONSTRAINT `Relationship2` FOREIGN KEY (`ID_K`) REFERENCES `Korisnik` (`ID_K`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Nastupa` ADD CONSTRAINT `Relationship3` FOREIGN KEY (`ID_Dog`) REFERENCES `Dogadjaj` (`ID_Dog`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Nastupa` ADD CONSTRAINT `Relationship4` FOREIGN KEY (`Izvodjac`) REFERENCES `Izvodjac` (`ID_K`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Dogadjaj` ADD CONSTRAINT `Relationship5` FOREIGN KEY (`Organizator`) REFERENCES `Organizator` (`ID_K`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Konkurs` ADD CONSTRAINT `Relationship6` FOREIGN KEY (`ID_Dog`) REFERENCES `Dogadjaj` (`ID_Dog`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Posmatrac` ADD CONSTRAINT `Relationship7` FOREIGN KEY (`ID_K`) REFERENCES `Korisnik` (`ID_K`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Ocene_Izvodjaca` ADD CONSTRAINT `Relationship12` FOREIGN KEY (`Posmatrac`) REFERENCES `Posmatrac` (`ID_K`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Ocene_Izvodjaca` ADD CONSTRAINT `Relationship13` FOREIGN KEY (`Izvodjac`) REFERENCES `Izvodjac` (`ID_K`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Ocene_Dogadjaja` ADD CONSTRAINT `Relationship14` FOREIGN KEY (`Posmatrac`) REFERENCES `Posmatrac` (`ID_K`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Ocene_Dogadjaja` ADD CONSTRAINT `Relationship15` FOREIGN KEY (`ID_Dog`) REFERENCES `Dogadjaj` (`ID_Dog`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Pretplate_Na_Izvodjace` ADD CONSTRAINT `Relationship16` FOREIGN KEY (`Izvodjac`) REFERENCES `Izvodjac` (`ID_K`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Pretplate_Na_Izvodjace` ADD CONSTRAINT `Relationship18` FOREIGN KEY (`Posmatrac`) REFERENCES `Posmatrac` (`ID_K`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Pretplate_Na_Organizatora` ADD CONSTRAINT `Relationship19` FOREIGN KEY (`Organizator`) REFERENCES `Organizator` (`ID_K`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Pretplate_Na_Organizatora` ADD CONSTRAINT `Relationship20` FOREIGN KEY (`Posmatrac`) REFERENCES `Posmatrac` (`ID_K`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Prijave_Na_Konkurs` ADD CONSTRAINT `Relationship21` FOREIGN KEY (`ID_K`) REFERENCES `Izvodjac` (`ID_K`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Prijave_Na_Konkurs` ADD CONSTRAINT `Relationship22` FOREIGN KEY (`ID_Dog`) REFERENCES `Konkurs` (`ID_Dog`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Zahtev_Za_Nastupanje` ADD CONSTRAINT `Relationship23` FOREIGN KEY (`ID_Dog`) REFERENCES `Dogadjaj` (`ID_Dog`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `Zahtev_Za_Nastupanje` ADD CONSTRAINT `Relationship24` FOREIGN KEY (`ID_K`) REFERENCES `Izvodjac` (`ID_K`) ON DELETE RESTRICT ON UPDATE RESTRICT
;


