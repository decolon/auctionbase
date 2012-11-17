--Update Auction start      
PRAGMA foreign_keys = ON;
drop trigger if exists updateAuctionStart;
create trigger updateAuctionStart
after update on Auction
when (new.Start_Time <> old.Start_Time)
begin
	select raise(rollback, "Cant change start time");
end;



