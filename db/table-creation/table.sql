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


create table booked(trans_id int not null, pnr_num int not null, t_id int not null, email_id varchar(20) not null, date_num date not null , from_station int , to_station int  );
create table pnr_seat(pnr_num int not null, seat_num int not null, seat_type varchar(10) );
create table passenger(pnr_num int not null, passenger_name varchar(50) not null, age int not null, gender char(1) not null, seat_num int not null, seat_type varchar(10), date_num date not null);

--drop table pnr_seat;
--added email in transaction
--added fare_cum in schedule
------
insert into booked values(1, 1,19020, 'ap14@iitbbs.ac.in', '2019-04-22',1,3 );
insert into booked values(2, 2,19020, 'ap14@iitbbs.ac.in', '2019-04-22',1,3 );
insert into booked values(3, 3,19020, 'ap14@iitbbs.ac.in', '2019-04-22',1,3 );
insert into booked values(4, 4,19020, 'ap14@iitbbs.ac.in', '2019-04-22',1,3 );
insert into booked values(5, 5,19020, 'ap14@iitbbs.ac.in', '2019-04-22',1,3 );
insert into booked values(11, 11,19020, 'ap14@iitbbs.ac.in', '2019-04-23',1,3 );
insert into booked values(10, 10,19020, 'ap14@iitbbs.ac.in', '2019-04-24',1,3 );
insert into booked values(9, 9,19020, 'ap14@iitbbs.ac.in', '2019-04-24',1,3 );
insert into booked values(8, 8,19020, 'ap14@iitbbs.ac.in', '2019-04-24',1,3 );
insert into booked values(7, 7,19020, 'ap14@iitbbs.ac.in', '2019-04-25',1,3 );
insert into booked values(6, 6,19020, 'ap14@iitbbs.ac.in', '2019-04-26',1,3 );


insert into pnr_seat values(1, 11,'sleeper');
insert into pnr_seat values(1, 12,'sleeper');
insert into pnr_seat values(1, 15,'sleeper');

insert into pnr_seat values(7, 11,'sleeper');
insert into pnr_seat values(7, 12,'sleeper');
insert into pnr_seat values(6, 15,'sleeper');


insert into booked values(2, 2,19020, 'ap14@iitbbs.ac.in', '2019-04-22',5,2 );
insert into pnr_seat values(2, 13,'sleeper');
insert into pnr_seat values(2, 14,'sleeper');

insert into pnr_seat values(3, 16,'sleeper');
insert into pnr_seat values(3, 17,'sleeper');
Insert into unbooked values(19020, 1, "Express", '2019-04-22');
Insert into unbooked values(19020, 2, "Express", '2019-04-22');
Insert into unbooked values(19020, 3, "Express", '2019-04-22');
Insert into unbooked values(19020, 4, "Express", '2019-04-22');
Insert into unbooked values(19020, 5, "Express", '2019-04-22');
Insert into unbooked values(19020, 6, "Express", '2019-04-22');
Insert into unbooked values(19020, 7, "Express", '2019-04-22');
Insert into unbooked values(19020, 8, "Express", '2019-04-22');
Insert into unbooked values(19020, 9, "Express", '2019-04-22');
Insert into unbooked values(19020, 10, "Express", '2019-04-22');


insert into booked values(3, 3,19020, 'ap14@iitbbs.ac.in', '2019-04-22',3,5 );

insert into booked values(4, 4,19020, 'ap14@iitbbs.ac.in', '2019-04-22',1,2 );

insert into pnr_seat values(4, 18,'sleeper');
insert into pnr_seat values(4, 19,'sleeper');

insert into booked values(5, 5,19020, 'ap14@iitbbs.ac.in', '2019-04-22',3,2 );

insert into pnr_seat values(5, 20,'sleeper');
insert into pnr_seat values(5, 21,'sleeper');


--create view indi as select b.t_id, sc1.station_index as from_index, sc2.station_index as to_index, b.pnr_num, b.date_num from booked b, schedule sc1, schedule sc2
--where sc1.station_id=b.from_station
--and sc2.station_id= b.to_station
--and b.t_id=sc1.t_id
--and b.t_id=sc2.t_id;



---Seat numbers which are not available
select pnr.seat_num from booked b, schedule sc1, schedule sc2, pnr_seat pnr
where sc1.station_id=b.from_station
and sc2.station_id= b.to_station
and pnr.pnr_num=b.pnr_num
and b.t_id=sc1.t_id
and b.t_id=sc2.t_id
and (sc2.station_index>(select station_index from schedule where station_id in (select station_id from station where station_name= "Dehradun") and t_id=19020)
and sc1.station_index <(select station_index from schedule where station_id in (select station_id from station where station_name= "Haridwar") and t_id=19020)
)and b.date_num="2019-04-22";

---Count of seats not avaliabale
select count(pnr.seat_num) as not_available_seats from booked b, schedule sc1, schedule sc2, pnr_seat pnr
where sc1.station_id=b.from_station
and sc2.station_id= b.to_station
and pnr.pnr_num=b.pnr_num
and b.t_id=sc1.t_id
and b.t_id=sc2.t_id
and (sc2.station_index>(select station_index from schedule where station_id in (select station_id from station where station_name= "Dehradun") and t_id=19020)
and sc1.station_index <(select station_index from schedule where station_id in (select station_id from station where station_name= "Haridwar") and t_id=19020)
)and b.date_num="2019-04-23";

select sleeper_seats from train where t_id='_____';


					select s1.day_num as day_src, da._day, t.sleeper_seats from schedule s1, schedule s2,train t, days_available da 
					where s1.t_id=19020 
					and s1.t_id=s2.t_id 
					and da.t_id=s1.t_id 
					and t.t_id=s1.t_id
					and s1.station_index < s2.station_index 
					and s1.station_id in (select station_id from station where station_name='Dehradun') 
					and s2.station_id in (select station_id from station where station_name='Kota Junction');
			
  select sc.station_index,sc.t_id, t.t_name, s.station_name,sc.arrival,sc.departure, sc.day_num from schedule sc, train t, station s where
				sc.t_id=t.t_id
				and sc.station_id=s.station_id
				and sc.t_id=19580
				order by sc.station_index;
				
				select count(pnr.seat_num) as not_available_seats from booked b, schedule sc1, schedule sc2, pnr_seat pnr
							where sc1.station_id=b.from_station
							and b.t_id=19020
							and sc2.station_id= b.to_station
							and pnr.pnr_num=b.pnr_num
							and b.t_id=sc1.t_id
							and b.t_id=sc2.t_id
							and (sc2.station_index>(select station_index from schedule where station_id in (select station_id from station where station_name= 'Dehradun') and t_id=19020)
							and sc1.station_index <(select station_index from schedule where station_id in (select station_id from station where station_name= 'Kota Junction') and t_id=19020))
							and b.date_num='2019-04-22'
							and pnr.seat_type='ac';
							
							
							select t.t_id, t.t_name, s1.station_name, s2.station_name from train t, station s1,station s2 where
								t.src_id=s1.station_id
								and t.dest_id=s2.station_id;
							