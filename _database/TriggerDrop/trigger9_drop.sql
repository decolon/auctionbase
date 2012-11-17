-- Drops trigger that checks to make sure an updated bid time is before the AUction end and after the auction start
PRAGMA foreign_keys = ON;
update Bids set Time = "2001-12-06 06:44:53" where UserID = "goldcoastvideo";
update Bids set Time = "2001-12-06 06:44:54" where UserID = "goldcoastvideo";
drop trigger updateBidTime;

