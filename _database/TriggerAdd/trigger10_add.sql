-- Checks to make sure an insert bid time is before the AUction end and after the auction start
PRAGMA foreign_keys = ON;
drop trigger if exists updateBidTime2;
create trigger updateBidTime2
after insert on Bids
when (new.Time > (select End_Time from Auction where new.ItemID = ItemID) or new.Time < (select Start_Time from Auction where new.ItemID = ItemID))
begin
	select raise(rollback, "Bids Time needs to be before end time and after start time");
end;

