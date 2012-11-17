--Checks to make sure when you update Bids Time, the time is beffore Auction_Time
PRAGMA foreign_keys = ON;
drop trigger if exists updateBidAuctionTime;
create trigger updateBidAuctionTime
after update on Bids
when (new.Time > (select Auction_Time from AuctionBaseTime))
begin
	select raise(rollback, "Bids Time can not be after AuctionBaseTime.Auction_Time");
end;


