Ecreate table user(email_id varchar(30) primary key, pass varchar(15) not null, _name varchar(30) 
not null, gender varchar(1) not null, age int not null, mobile varchar(14) not null, city varchar(20) not null,
_state varchar(25) not null,CHECK(gender='M' or gender='F'));


create table station(station_id int not null primary key, station_name varchar(25));


create table train(t_id int primary key, t_name varchar(50) not null, t_type varchar(50) not null, 
src_id int not null, dest_id int not null, ac_seats int not null,sleeper_seats int not null);

--2,3,5,7,11,13,17 map to days  and then multiplied =510510 (all days)
create table days_available(t_id int, _day int not null);


create table schedule(t_id int primary key, station_id int not null, station_index int not null, arrival time not null,departure time not null , day_num int not null, fare_cum int not null);


-------------------------------------------------------
-----------------BOOKING SQL CREATION------------------
-------------------------------------------------------

create table unbooked (t_id int not null, seat_num int not null, seat_type varchar(10), date_num date not null);


create table transactions(trans_id int not null , pnr_num int not null, trans_type varchar(20) not null, email_id varchar(20) not null, _time time not null, _date date not null,  amount int not null);


create table booked(trans_id int not null, pnr_num int not null, t_id int not null, email_id varchar(20) not null, date_num date not null  );
create table pnr_seat(pnr_num int not null, seat_num int not null, seat_type varchar(10) );
create table passenger(pnr_num int not null, passenger_name varchar(50) not null, age int not null, gender char(1) not null, seat_num int not null, seat_type varchar(10), date_num date not null);