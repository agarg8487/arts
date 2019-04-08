-----------LOGIN-----------

select * from user where user="---------------";


---------Searching trains---------

--Searching ---have to do backend work on days available part eg- we have to consider daynum amd _day func(_day + day(daynum - 1))
select s1.t_id , s1.day_num, da._day, s1.arrival , s1.departure, s2.arrival, s2.departure, s1.fare_cum, s2.fare_cum from schedule s1, schedule s2, days_available da 
where s1.t_id=s2.t_id 
and da.t_id=s1.t_id 
and s1.station_index < s2.station_index 
and s1.station_id in (select station_id from station where station_name="src_name") 
and s2.station_id in (select station_id from station where station_name="src_name");


-----------Booking-----------
--Seat select from unbooked tickets
select seat_num from unbooked 
where t_id="train" 
and seat_type="ac/sleeper"
and date_num="date";

--processing the seat_num to save in a list
-- now seats which are free in between the required station

select seat_num from booked 
where t_id="train"
and from_src>="dest of current user"
and to_dest <="src of current user"
and date_num="date";
--- add this list to the list of available seats

-- now choose one seat num
--if seat choosen from unbooked then
insert into booked 
values("new_book", "src", "dest", "mobile", "email_id", date, amount );
--now trigger before insert on booked and insert in transactions
--transactions will be used to bank details and if wallet fature is introduced


update unbooked set seat_num="new text after taking all the seats required" where t_id="train"
and seat_type="seat_type"
and date_num="date";

--do this for each passenger
insert into passenger 
values();


-- if seats are taken from booked ticket list
insert into booked 
values("new_book", "src", "dest", "mobile", "email_id", date, amount );
--now trigger before insert on booked and insert in transactions
--transactions will be used to bank details and if wallet fature is introduced


--do this for each passenger
insert into passenger 
values();

--if some are taken from unbooked and some are taken from booked then

insert into booked 
values("new_book", "src", "dest", "mobile", "email_id", date, amount );
--now trigger before insert on booked and insert in transactions
--transactions will be used to bank details and if wallet fature is introduced

--- update text according to the seat_num in unbooked
update unbooked set seat_num="new text after taking all the seats required" where t_id="train"
and seat_type="seat_type"
and date_num="date";

--do this for each passenger
insert into passenger 
values();