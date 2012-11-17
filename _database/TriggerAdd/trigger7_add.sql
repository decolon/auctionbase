--Checks to make sure when you insert into Bids, the time is before AUction_Time
PRAGMA foreign_keys = ON;
drop trigger if exists insertBidTime;
create trigger insertBidTime
after insert on Bids
when (new.Time > (select Auction_Time from AuctionBaseTime))
begin
	select raise(rollback, "Bids Time can not be after AuctionBaseTime.Auction_Time");
end;


