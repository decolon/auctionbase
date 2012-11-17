--Drops the trigger that checks to make sure when you insert into Bids, the time is before AUction_Time
PRAGMA foreign_keys = ON;
insert into Bids values ("rulabula", "2001-12-05 00:00:01", "1043374545", 31.00);
delete from Bids where UserID = "rulabula" and Time = "2001-12-05 00:00:01";
drop trigger insertBidTime;

