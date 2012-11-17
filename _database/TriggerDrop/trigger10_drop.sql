-- Drops trigger that checks to make sure an insert bid time is before the AUction end and after the auction start
PRAGMA foreign_keys = ON;
insert into Bids values("goldcoastvideo", "2001-12-06 06:44:55", "1043402767", 4.01);
delete from Bids where UserID = "goldcoastvideo" and Time = "2001-12-06 06:44:55";
drop trigger updateBidTime2;
