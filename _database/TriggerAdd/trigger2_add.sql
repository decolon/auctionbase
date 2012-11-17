--Auction Time must have 1 tupple k
PRAGMA foreign_keys = ON;
drop trigger if exists updateAuctionTimeCount;
create trigger updateAuctionTimeCount
after insert on AuctionBaseTime
when (1< (select count(*) from AuctionBaseTime))
begin
	select raise(rollback, "Can only have one tupple in AuctionBaseTime");
end;



