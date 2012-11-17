-- Checks to make sure an updated bid time is before the AUction end and after the auction start
PRAGMA foreign_keys = ON;
drop trigger if exists updateBidTime;
create trigger updateBidTime
after update on Bids
when (new.Time > (select End_Time from Auction where new.ItemID = ItemID) or new.Time < (select Start_Time from Auction where new.ItemID = ItemID))
begin
	select raise(rollback, "Bids Time needs to be before end time and after start time");
end;


