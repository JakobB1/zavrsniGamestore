drop database if exists gametrgovina;
create database gametrgovina character set utf8mb4;
use gametrgovina;

alter database gametrgovina character set utf8mb4;

create table operater(
    sifra           int not null primary key auto_increment,
    email         	varchar(50) not null,
    lozinka         char(60) not null, 
    ime             varchar(50) not null,
    prezime         varchar(50) not null,
    uloga           varchar(10) not null
);

create table razvijac (
    sifra       int not null primary key auto_increment,
    naziv       varchar(50),
    drzava      varchar(50),
    webstranica varchar(50)
);

create table izdavac (
    sifra       int not null primary key auto_increment,
    naziv       varchar(50),
    drzava      varchar(50),
    webstranica varchar(50)
);

create table igra (
    sifra           int not null primary key auto_increment,
    naziv           varchar(50),
    razvijac_id     int,
    izdavac_id      int,
    zanr            varchar(50),
    cijena          decimal(15,2),
    recenzija       int,
    dobnagranica    int,
    datumizlaska    varchar(50),
    opis            varchar(300)
);

create table korisnik (
    sifra      int not null primary key auto_increment,
    ime        varchar(50),
    prezime    varchar(50),
    korisnicko varchar (50),
    oib        char(11),
    email      varchar(50)
);

create table narudzba (
    sifra       int not null primary key auto_increment,
    korisnik_id int,
    cijena      int(5),
    placanje    varchar(20),
    datum datetime
);

create table narudzba_igra (
    sifra       int not null primary key auto_increment,
    igra_id int,
    narudzba_id int
);

alter table narudzba_igra  add foreign key (igra_id) references igra(sifra);
alter table narudzba_igra  add foreign key (narudzba_id) references narudzba(sifra);

alter table igra  add foreign key (razvijac_id) references razvijac(sifra);
alter table igra  add foreign key (izdavac_id) references izdavac(sifra);




alter table narudzba  add foreign key (korisnik_id) references korisnik(sifra);


# operater
insert into operater (email,lozinka ,ime ,prezime , uloga) values
# password a
('admin@edunova.hr','$2a$12$gcFbIND0389tUVhTMGkZYem.9rsMa733t9J9e9bZcVvZiG3PEvSla','Administrator','Edunova','admin'),
# password o
('oper@edunova.hr','$2a$12$S6vnHiwtRDdoUW4zgxApvezBlodWj/tmTADdmKxrX28Y2FXHcoHOm','Operater','Edunova','oper');
select * from operater;

insert into razvijac (sifra,naziv,drzava, webstranica) values 
(1, 'FromSoftware Inc.','Japan', 'https://www.fromsoftware.jp/ww/'),
(2, '2K Games','California', 'https://2k.com/en-US/');
select * from razvijac;



insert into izdavac (sifra,naziv,drzava, webstranica) values 
(1, 'Bandai Namco Entertainment Inc.', 'Japan', 'https://www.bandainamcoent.co.jp/english/'),
(2, 'Take-Two Interactive Software, Inc.', 'USA', 'https://www.take2games.com/');
select * from izdavac;



insert into igra (sifra,naziv,razvijac_id ,izdavac_id ,zanr ,cijena ,recenzija ,dobnagranica ,datumizlaska ,opis) values 
(1, 'Dark Souls', 1, 1, 'Action RPG, Fantasy, Multiplayer, Co-op', 19.99, 9, 18, '22-09-2011', 'Dark Souls takes place in the fictional kingdom of Lordran, where players assume the role of a cursed undead character who begins a pilgrimage to discover the fate of their kind.'),
(2, 'Bioshock', 2, 2, 'FPS, Action, Horror, Singleplayer', 5.99, 10, 18, '21-08-2007', 'BioShock is set in 1960. The player guides the protagonist, Jack, after his airplane crashes in the ocean near the bathysphere terminus that leads to the underwater city of Rapture.');
select * from igra;



insert into korisnik (sifra,ime,prezime ,korisnicko ,oib ,email) values 
(1, 'NameExample01', 'SurnameExample01', 'UsernameExample01', 12345678910,'email01@example.com'),
(2, 'NameExample02', 'SurnameExample02', 'UsernameExample02', 12345678910,'email02@example.com');
select * from korisnik;



insert into narudzba  (sifra,korisnik_id ,cijena,placanje ,datum) values
(1, 1, 19.99, 'Mastercard', '2021-12-01 11:59:00'),
(2, 2, 5.99, 'Paypal', '2020-12-01 11:59:00');

insert into narudzba_igra (sifra,igra_id,narudzba_id)
values (1, 1, 1),
       (2, 2, 2);

select * from narudzba_igra;