--Update Auction end time      
PRAGMA foreign_keys = ON;
drop trigger if exists updateAuctionEnd;
create trigger updateAuctionEnd
after update on Auction
when (new.End_Time <> old.End_Time)
begin
	select raise(rollback, "Cant change end time");
end;


