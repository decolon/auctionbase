--Drops the trigger that checks to make sure when you update into Bids, the time is before AUction_Time
PRAGMA foreign_keys = ON;
insert into Bids values ("rulabula", "2001-12-04 00:00:01", "1043374545", 31.00);
update Bids set Time = "2001-12-05 00:00:01" where UserID = "rulabula" and Time = "2001-12-04 00:00:01";
delete from Bids where UserID = "rulabula" and Time = "2001-12-05 00:00:01";
drop trigger updateBidAuctionTime;
