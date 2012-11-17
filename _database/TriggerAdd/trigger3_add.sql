--Checks to make sure when you insert into Auction the user has a non null location and country in User table
PRAGMA foreign_keys = ON;
drop trigger if exists insertSellerLocation;
create trigger insertSellerLocation
after insert on Auction
when (new.UserID in(select UserID from User where UserID = new.UserID and Location is null and Country is null))
begin
	select raise(rollback, "Auction.UserID must have non null location and country");
end;

